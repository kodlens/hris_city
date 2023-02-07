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
                                    <div class="has-text-weight-bold">Skill: {{ seminar.skill }}</div>
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
                    </div>
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

        }
    },

    methods: {
        loadSeminars(){
            axios.get('/hrld/get-seminars').then(res=>{
                this.serminars = res.data
            }).catch(err=>{

            })
        },
    },

    mounted(){
        this.loadSeminars()
    }
}

</script>

<style scoped>
.home-hero{
    height: 100vh;
}
</style>
