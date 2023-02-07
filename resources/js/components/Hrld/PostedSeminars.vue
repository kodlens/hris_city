<template>
    <div>

        <div class="columns is-centered">
            <div class="column is-6-desktop">


                <div class="box box-post" v-for="(seminar, index) in seminars" :key="index">
                    <div class="box-post-heading">
                        <div class="posted-text">Posted: {{ seminar.date_posted }}</div>
                        <div class="post-action">
                            <b-dropdown aria-role="list">
                                <template #trigger="{ active }">
                                    <b-button
                                        label="..."
                                        class="is-small"
                                        type="is-light"
                                        :icon-right="active ? 'menu-up' : 'menu-down'" />
                                </template>
<!--                                <b-dropdown-item aria-role="listitem" @click="updatePost(seminar.seminar_post_id)">Update</b-dropdown-item>-->
                                <b-dropdown-item aria-role="listitem" @click="deletePost(seminar.seminar_post_id)">Delete</b-dropdown-item>
                            </b-dropdown>
                        </div>
                    </div>
                    <div class="post-desc">
                        <div class="columns">
                            <div class="column">
                                <div class="has-text-weight-bold">Title: {{ seminar.title }}</div>
                            </div>
                            <div class="column">
                                <div class="has-text-weight-bold">Skills: {{ seminar.skills }}</div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="has-text-weight-bold">Seminar Date: {{ seminar.seminar_date  }}</div>
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
                        <div class="columns">
                            <div class="column">
                                {{ seminar.description }}
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
</template>

<script>
export default{
    data(){
        return{
            seminars: [],

        }
    },

    methods: {
        loadSeminars(){
            axios.get('/hrld/get-seminars').then(res=>{
                this.seminars = res.data
            })
        },

        deletePost(seminarPostId){
            axios.delete('/hrld/seminar-posts/' + seminarPostId).then(res=>{
                if(res.data.status === 'deleted'){
                    this.$buefy.toast.open({
                        message: 'Post deleted successfully.',
                        type: 'is-success'
                    })
                    this.loadSeminars()
                }
            })
        },
    },
    mounted(){
        this.loadSeminars()
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
        font-style: 0.8em;
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
