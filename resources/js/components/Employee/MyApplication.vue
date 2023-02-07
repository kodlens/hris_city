<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="box-container" v-for="(item, index) in myApplications" :key="index">
                        <div class="box">
                            <div class="application-info">
                                <div>
                                    <strong>Status</strong> 
                                    <b-tag type="is-success" v-if="item.is_accepted === 1">Accepted</b-tag>
                                    <b-tag type="is-info" v-if="item.is_accepted === 0">Applied</b-tag>
                                </div>

                                <div>
                                    <strong>Company:</strong> {{  item.job_post.company.company }}
                                </div>

                                <div>
                                    <strong>Email: </strong> {{  item.job_post.company.email }}
                                </div>
                                <div>
                                    <strong>Website: </strong> {{  item.job_post.company.website }}
                                </div>
                                <div>
                                    <strong>Address: </strong> 
                                    {{  item.job_post.company.street }}, {{  item.job_post.company.barangay.brgyDesc }}, 
                                    {{  item.job_post.company.city.citymunDesc }}
                                    {{  item.job_post.company.province.provDesc }}
                                </div>
                            </div>

                            <hr>
                            <div class="buttons" v-if="item.is_accepted === 1">
                                <button class="is-info button" @click="openModalRating(item)">Submit Rating</button>
                            </div>
                        </div>
                    </div><!--box-container-->
                </div>
            </div>
        </div><!--section -->


        <!--modal create-->
        <b-modal v-model="modalRating" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal
                 type = "is-link">

            <form @submit.prevent="submit">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Rating</p>
                        <button
                            type="button"
                            class="delete"
                            @click="modalRating = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">

                            <div class="columns">
                                <div class="column">
                                    <b-rate custom-text="Rate here" v-model="fields.rating"></b-rate>
                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <button
                            :class="btnClass"
                            label="Save"
                            type="is-success">Submit</button>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->


    </div><!--root div-->
</template>
<script>

export default{
    data(){
        return{
            modalRating: false,
            myApplications: [],

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

            fields: {},
            errors: {},

            job: {},
        }
    },

    methods: {
        clearFields(){
            this.fields = {
                company_id: 0,
                user_id: 0,
                job_post_id: 0,
                rating: 0,
            }
        },
        loadMyApplications(){
            axios.get('/employee/get-my-applications').then(res=>{
                this.myApplications = res.data;
            })
        },

        openModalRating(item){
            this.clearFields();
            this.modalRating = true;
            this.job = item;
        },

        submit(){
            this.fields.company_id = this.job.job_post.company_id;
            this.fields.user_id = this.job.user_id;
            this.fields.job_post_id = this.job.job_post_id;

            axios.post('/employee/submit-rating', this.fields).then(res=>{
                if(res.data.status === 'submitted'){
                    this.modalRating = false;
                    this.$buefy.dialog.alert({
                        title: 'RATED!',
                        type: 'is-success',
                        message: 'Rating submitted successfully.',
                    });
                    
                }
            }).catch(err=>{
                if(err.response.data.status === 'exist'){
                    this.$buefy.dialog.alert({
                        title: 'RATED!',
                        type: 'is-danger',
                        message: 'Already rated this job post.',
                    });
                }
                // if(err.response.status)
            })
        }
    },

    mounted(){
        this.loadMyApplications();
    }
}
</script>

<style scoped>

.application-info > div {
    margin: 15px 0;
}
</style>