<template>
    <div>
        <div class="filter-container">
            <div>
                <b-field expanded>
                    <b-input type="text" expanded
                        placeholder="Search Lastname"
                        v-model="search.lname"></b-input>

                        <b-select
                            v-model="specialization"
                                placeholder="Select Seminar">
                                <option v-for="(item, ix) in seminars" :key="ix"
                                    :value="item">{{ item.title }}</option>
                        </b-select>


                    <!-- <b-select
                        expanded
                            placeholder="Seminars"
                            v-model="specialization"
                            @input="generateList">
                        <option value="">--NONE--</option>
                        <option v-for="(i, ix) in comboSeminars" :key="ix"
                            :value="i">{{ i.title }}</option>
                    </b-select> -->
                    <p class="control">
                        <b-button class="expanded" type="is-primary" label="..." @click="getTeacherList"></b-button>
                    </p>
                </b-field>
                <b-field>

                </b-field>
            </div>
        </div>


        <!--modal create-->
        <b-modal v-model="modalTeacher" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>


            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Remarks</p>
                    <button
                        type="button"
                        class="delete"
                        @click="modalTeacher = false"/>
                </header>
                <form @submit.prevent="submit">
                    <section class="modal-card-body">

                        <div class="">
                            <div class="column">

                                <b-field label="Remarks">
                                    <b-input type="text"
                                        v-model="fields.remarks">
                                    </b-input>
                                </b-field>
                            </div>

                        </div> <!-- div class-->
                    </section>
                    <footer class="modal-card-foot">
                        <button
                            class="button is-success">Submit</button>
                    </footer>
                </form>
            </div>
        </b-modal>
        <!--close modal-->


        <div class="print-area">
            <div>
                <div>List of Teachers</div>
                <table class="table is-fullwidth is-narrow">
                    <tr>
                        <td></td>
                        <td>Name</td>
                        <td>Sex</td>
                        <td>Specialization/Skill</td>
                        <td>No of. Seminars</td>
                        <td>Remarks</td>
                    </tr>
                    <tr v-for="(item, index) in data" :key="index">
                        <td>
                            <b-checkbox
                                v-model="item.select"
                            ></b-checkbox>
                        </td>
                        <td>{{  item.lname }}, {{  item.fname }} {{ item.mname }} {{  item.suffix }}</td>
                        <td>{{ item.sex }}</td>
                        <td>{{ item.specialization }}</td>
                        <td>{{ item.no_seminars }}</td>
                        <td>{{ item.remarks }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="filter-container">
            <div class="buttons is-right">
                <b-button label="Forward List"
                          icon-right="arrow-right"
                          @click="openModalSubmitList"></b-button>
            </div>
        </div>

    </div>
</template>

<script>

export default{
    data(){
        return {
            rawdata: [],
            data: [],

            specialization: null,

            fields: {
                seminar_post_id: 0,
                seminar_title: '',
                teachers: []
            },

            search: {
                lname: '',
                specialization: '',
            },

            modalTeacher: false,
            seminars: [],
            request_teacher: [],
        }
    },

    methods: {

        generateList(){

            const params = [
                `lname=${this.search.lname}`,
                `specialization=${this.specialization.specialization}`,
            ].join('&')



            axios.get(`/generate-list?${params}`).then(res=>{
                //this.rawData = res.data

                res.data.forEach(el=>{
                    this.data.push({
                        civil_status: el.civil_status,
                        fname: el.fname,
                        lname: el.lname,
                        mname: el.mname,
                        no_seminars: el.no_seminars,
                        role: el.role,
                        sex: el.sex,
                        specialization: el.specialization,
                        suffix: el.suffix,
                        user_id: el.user_id,
                        remarks: 'Generated'
                    });
                })


                this.request_teacher.forEach(el =>{
                    this.data.push({
                        civil_status: '',
                        fname: el.fname,
                        lname: el.lname,
                        mname: el.mname,
                        no_seminars: '',
                        role: '',
                        sex: el.sex,
                        specialization: el.specialization,
                        suffix:'',
                        user_id: el.teacher_id,
                        remarks: 'Request'

                    });
                })


            }).catch(err=>{

            })
        },


        getTeacherList(){
            this.data = [];
            this.request_teacher = [];
            axios.get(`/get-request-teacher/${this.specialization.seminar_post_id}`).then(res=>{
                this.request_teacher = res.data
                this.generateList()

            }).catch(err=>{

            })
        },


        loadSeminars(){
            axios.get('/cid/get-seminar-specialization-list').then(res=>{
                this.seminars = res.data

            })
        },

        openModalSubmitList(){
            this.modalTeacher = true
        },

        submit(){

            this.fields.teachers = [];
            this.fields.seminar_post_id = this.specialization.seminar_post_id;
            this.fields.seminar_title = this.specialization.title;

            this.data.forEach(el=>{
                if(el.select){
                    //if check, push to fields
                    this.fields.teachers.push({
                        user_id: el.user_id,
                        lname: el.lname,
                        fname: el.fname,
                        mname: el.mname,
                        sex: el.sex,
                        specialization: el.specialization,
                        no_seminars: el.no_seminars,
                    });
                }
            })

            axios.post('/cid/submit-teachers-list', this.fields).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'Saved!',
                        type: 'is-success',
                        message: 'Successfully saved.'
                    });
                }
                this.modalTeacher = false
                this.fields.seminar_post_id = 0;
                this.fields.seminar_title = '';
                this.fields.teachers = [];

                this.data = [];
                this.request_teacher = [];

                this.generateList()

            })
        },

        changeValue(i){
            console.log(this.specialization)
        }
    },

    mounted(){
        this.loadSeminars()
    }
}
</script>

<style scoped>


    @media print {
        /*.myDivToPrint {*/
        /*    background-color: white;*/
        /*    height: 100%;*/
        /*    width: 100%;*/
        /*    position: fixed;*/
        /*    top: 0;*/
        /*    left: 0;*/
        /*    margin: 0;*/
        /*    padding: 15px;*/
        /*    font-size: 14px;*/
        /*    line-height: 18px;*/
        /*}*/

        .myDivToPrint{
            margin: 0;
            color: #000;
            background-color: #fff;
            font-size: 14px;
            height: 100%;

        }
        .nprint{
            display: none;
        }
        header, footer, aside, nav, form, iframe, .menu, .hero, .adslot {
            display: none;
        }

        .buttons{
            display: none;
        }


        /* // if print display none elements */
        html body{
            background-color: white;
        }

        .footer-container{
            display: none;
        }

        .filter-container{
           display: none;
        }

    }

    .print-area{
        max-width: 816px;
        margin: 30px auto 0;
        background: white;
    }
    .filter-container{
        max-width: 816px;
        margin: 30px auto;
        background-color: white;
        padding: 25px;
    }

    .print-area{
        padding: 20px;
    }


</style>
