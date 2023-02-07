<template>
    <div>

        <div class="columns is-centered mt-5">
            <div class="column is-6">
                <div class="box">
                    <div class="box-text mb-5">New Seminar / Trainings</div>

                    <div>
                        <div class="columns">
                            <div class="column">
                                <b-field label="Title" label-position="on-border">
                                    <b-input type="input" placeholder="Title" v-model="fields.title">
                                    </b-input>
                                </b-field>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <b-field label="Skills" label-position="on-border">
                                    <b-input type="input" placeholder="Skills" v-model="fields.skills">
                                    </b-input>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="Seminar Date" label-position="on-border">
                                    <b-datepicker placeholder="Seminar Date" :min-date="minDate" v-model="fields.seminar_date">
                                    </b-datepicker>
                                </b-field>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <b-field label="Learning Development" label-position="on-border"
                                    expanded>
                                    <b-select v-model="fields.ld_type" expanded>
                                        <option v-for="(item, index) in ld_types" :key="index"
                                            :value="item.ld_type">{{ item.ld_type }}</option>
                                    </b-select>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="Conducted/Sponsored By" label-position="on-border">
                                    <b-input type="input" placeholder="Conducted/Sponsored By"
                                        v-model="fields.conducted_by">
                                    </b-input>
                                </b-field>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <b-field label="CPD Units" label-position="on-border">
                                    <b-input type="input" placeholder="CPD Units"
                                        v-model="fields.cpd_units">
                                    </b-input>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="No. of hours" label-position="on-border">
                                    <b-numberinput type="number" placeholder="No. of hours"
                                        :controls="false"
                                        v-model="fields.no_hours">
                                    </b-numberinput>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Specialization" label-position="on-border">
                                    <b-select v-model="fields.specialization" placeholder="Specialization">
                                        <option v-for="(item, index) in specializations" :key="index"
                                            :value="item.specialization">{{ item.specialization }}</option>
                                    </b-select>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Description" label-position="on-border">
                                    <b-input type="textarea" v-model="fields.description" placeholder="Description">
                                    </b-input>
                                </b-field>
                            </div>
                        </div>


                        <b-field class="file is-primary" :class="{'has-name': !!file}">
                            <b-upload v-model="file" class="file-label">
                                <span class="file-cta">
                                    <b-icon class="file-icon" icon="upload"></b-icon>
                                    <span class="file-label">Click to upload</span>
                                </span>
                                <span class="file-name" v-if="file">
                                    {{ file.name }}
                                </span>
                            </b-upload>
                        </b-field>

                        <div class="buttons is-right">
                            <b-button type="is-primary is-outlined" label="Post Training" @click="submit"></b-button>
                        </div>

                    </div>
                </div>




            </div> <!-- col -->
        </div>
    </div>
</template>

<script>

export default{
    data(){
        return {
            file: null,
            desc: '',

            fields: {},

            seminar_id: 0,

            seminars: [],
            specializations: [],
            ld_types: [],

            minDate: new Date()
        }
    },

    methods: {

        initData(){

        },

        clear(){
            this.fil = null;
            this.desc = '';
        },


        loadLearningDevelopmentTypes(){
            axios.get('/get-open-learning-dev-types').then(res=>{
                this.ld_types = res.data
                console.log(this.ld_types);
            })
        },
        loadSpecializations(){
            axios.get('/get-open-specializations').then(res=>{
                this.specializations = res.data
            })
        },


        submit(){
            let ndate = new Date(this.fields.seminar_date);

            let newDate = ndate.getFullYear() + '-' + (ndate.getMonth() + 1) + '-' + ndate.getDate();

            let formData = new FormData();


            formData.append('title', this.fields.title);
            formData.append('seminar_date', newDate);
            formData.append('ld_type', this.fields.ld_type);
            formData.append('skills', this.fields.skills);
            formData.append('conducted_by', this.fields.conducted_by);
            formData.append('cpd_units', this.fields.cpd_units);
            formData.append('no_hours', this.fields.no_hours);
            formData.append('specialization', this.fields.specialization);
            formData.append('file', this.file);
            formData.append('description', this.fields.description); //optional

            if(this.seminar_id > 0){
                axios.post('/hrld/seminar-posts-update/' + this.seminar_id, formData).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: "Updated!",
                            message: 'Seminar post successfully update.',
                            type: 'is-success',
                            onConfirm: ()=>  {
                                //this.loadSeminars()
                                this.clearFields()

                            }
                        });
                    }
                }).catch(err=>{

                })
            }else{
                axios.post('/hrld/seminar-posts-store', formData).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: "Posted!",
                            message: 'Seminar successfully posted.',
                            type: 'is-success',
                            onConfirm: ()=>  {
                                //this.loadSeminars()
                                this.clearFields()
                            }
                        });
                    }
                }).catch(err=>{

                })
            }

        },

        clearFields(){
            this.seminar_id = 0
            this.fields = {}
            this.file = null
        },



        // updatePost(seminarPostId){
        //     this.seminar_id = seminarPostId
        //     this.fields = {};
        //
        //     axios.get('/hrld/get-seminar-posts/' + seminarPostId).then(res=>{
        //         this.fields = {
        //             title: res.data.title,
        //             skills: res.data.skills,
        //             seminar_date: new Date(res.data.seminar_date),
        //             ld_type: res.data.ld_type,
        //             conducted_by: res.data.conducted_by,
        //             cpd_units: res.data.cpd_units,
        //             no_hours: parseInt(res.data.no_hours),
        //             specialization: res.data.specialization,
        //             description: res.data.description
        //         }
        //     })
        // }
    },

    mounted(){
        //this.loadSeminars()
        this.loadLearningDevelopmentTypes()
        this.loadSpecializations()
    }
}
</script>

<style scoped>
    .box-post{
        margin: 10px 0;
        border-top: 0px;

    }

    .post-img-container{
        height: 300px;
        overflow: hidden;
        display: flex;
        justify-content: center;
    }
    .posted-text{
        font-weight: bold;
        font-style: .8em;
        color: gray;
    }
    .post-img{
        height: 400px;
    }

    .box-post-heading{
        display: flex;
        padding: 10px;
    }
    .post-action{
        margin-left: auto;
    }

    .post-desc{
        border-top: 1px solid gray;
        margin: 10px;
        padding: 10px 0
    }
</style>
