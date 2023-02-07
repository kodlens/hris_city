<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-6">
                    <div class="box box-post" v-for="(seminar, index) in serminars" :key="index">
                        <div class="box-post-heading">
                            <div class="posted-text mb-4">Posted: {{ seminar.date_posted }}</div>
                            <div class="post-action">

                            </div>
                        </div>
                        <div class="post-desc">
                            <div class="columns">
                                <div class="column">
                                    <div class="has-text-weight-bold">Title: {{ seminar.title }}</div>
                                </div>
                                <div class="column">
                                    <div class="has-text-weight-bold">Skill: {{ seminar.skills }}</div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="has-text-weight-bold">Serminar Date: {{ seminar.seminar_date  }}</div>
                                </div>
                                <div class="column">
                                    <div class="has-text-weight-bold">Learning Development: {{ seminar.ld_type }}</div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="has-text-weight-bold">Conducted: {{ seminar.conducted_by  }}</div>
                                </div>
                                <div class="column">
                                    <div class="has-text-weight-bold">CPD Units: {{ seminar.cpd_units }}</div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="has-text-weight-bold">Specialization: {{ seminar.specialization  }}</div>
                                </div>
                                <div class="column">
                                    <div class="has-text-weight-bold">No of Hours: {{ seminar.no_hours }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="post-img-container" v-if="seminar.img_path">
                            <img :src="`/storage/seminars/${seminar.img_path}`" class="post-img" />
                        </div>

<!--                        <div class="divider"></div>-->

<!--                        <div class="recommended-teacher-container">-->
<!--                            <div>Recommended Teacher</div>-->
<!--                            <div v-for="(teacher, ix) in data" :key="ix">-->
<!--                                <div>{{ (ix+1) }}. {{ teacher.lname }}, {{ teacher.fname }} {{ teacher.mname }}</div>-->
<!--                            </div>-->
<!--                        </div>-->

                    </div> <!-- loop-->
                </div>
            </div>

        </div>

    </div>
</template>

<script>
export default{

    data(){
        return{
            serminars:[],
            data:[],

        }
    },

    methods: {
        loadSeminars(){
            axios.get('/hrld/get-seminars').then(res=>{
                this.serminars = res.data
            }).catch(err=>{

            })
        },

        // generateList(){
        //     const params = [
        //         `lname=${this.search.lname}`,
        //         `specialization=${this.specialization.specialization}`,
        //     ].join('&')
        //
        //     axios.get(`/generate-list?${params}`).then(res=>{
        //         //this.recommended_list = res.data
        //
        //         res.data.forEach(el=>{
        //             this.data.push({
        //                 civil_status: el.civil_status,
        //                 fname: el.fname,
        //                 lname: el.lname,
        //                 mname: el.mname,
        //                 no_seminars: el.no_seminars,
        //                 role: el.role,
        //                 sex: el.sex,
        //                 specialization: el.specialization,
        //                 suffix: el.suffix,
        //                 user_id: el.user_id,
        //                 remarks: 'Generated'
        //             });
        //         })
        //
        //     }).catch(err=>{
        //
        //     })
        // },


    },

    mounted(){
        this.loadSeminars()
        //this.generateList()
    }
}

</script>

<style scoped>
    .home-hero{
        height: 100vh;
    }


    .divider{
        margin: 20px;
        height: 2px;
        background-color: blue;
    }

    .recommended-teacher-container{
        margin: 20px;
    }
</style>
