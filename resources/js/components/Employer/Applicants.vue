<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-6">

                    <div class="box-container" v-for="(applicant, index) in applicants" :key="index">
                        <div class="box">
                            <div class="applicant-info">

                                <div>

                                </div>

                                <b-tag v-if="applicant.is_accepted === 1" type="is-success">Accepted</b-tag>

                                <div>
                                    <strong>Date Applied: </strong>{{ applicant.created_at | formatDateTime }}
                                </div>

                                <div>
                                    <strong>Rate: </strong>
                                    <b-rate 
                                        v-model="applicant.user_total_rating"
                                        disabled show-score spaced
                                    >
                                    </b-rate>
                                    <b-button
                                        v-if="applicant.is_end_contract === 1" 
                                        label="Rate" @click="openRateModal(applicant)">
                                    </b-button>
                                </div>

                                <div>
                                    <strong>Name:</strong> {{ applicant.applicant.lname }}, {{ applicant.applicant.fname }} {{ applicant.applicant.mname }}
                                </div>
                                <div>
                                    <strong>Address:</strong> {{ applicant.applicant.street }}, {{ applicant.applicant.barangay.brgyDesc }} {{ applicant.applicant.city.citymunDesc }} {{ applicant.applicant.province.provDesc }}
                                </div>

                                <div>
                                    <strong>Contact No.: </strong> {{  applicant.applicant.contact_no }}
                                </div>

                                <div>
                                    <strong>Email.: </strong> {{  applicant.applicant.email }}
                                </div>
                                <div>
                                    <strong>Message:</strong> 
                                        <div style="margin: 5px 5px 5px 60px;">{{ applicant.pitch }}</div>
                                </div>
                                <div>
                                    <strong>Resume: </strong>
                                        <a class="is-small button"
                                            v-if="applicant.resume_path"
                                            :href="`/storage/applications/${applicant.resume_path}`">View</a>
                                </div>
                            </div> <!--applicant info -->
                            <div class="buttons mt-5">
                                <button v-if="applicant.is_accepted === 0" class="button is-primary" @click="acceptApplicant(applicant.applicant_id)">Accept</button>
                                <!-- <button v-if="applicant.is_accepted === 1" class="button is-danger" @click="cancelAccept(applicant.applicant_id)">Cancel</button> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!--section -->
         <!--modal create-->
         <b-modal v-model="rateModal" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal
                 type = "is-link">

            <form @submit.prevent="submitRate">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Rating</p>
                        <button
                            type="button"
                            class="delete"
                            @click="rateModal = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">

                            <div class="columns">
                                <div class="column">
                                    <b-rate 
                                        custom-text="Rate here" 
                                        v-model="fields.rating">
                                    </b-rate>
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

        
    </div><!--root div -->
</template>
<script>
export default{
    props: ['propJobPostId'],
    data(){
        return {
            job_post_id: 0,
            applicants: [],

            rateModal: false,
            fields: {},

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

            applicant: {},
        }
    },

    methods: {
        initData(){
            this.job_post_id = parseFloat(this.propJobPostId)
        },

        getApplicants(){
            axios.get('/employer/get-applicants/' + this.job_post_id).then(res=>{
                this.applicants = res.data
                //console.log(this.applicants);
            })
        },

        acceptApplicant(appId){
            this.$buefy.dialog.confirm({
                title: 'Accept?',
                type: 'is-info',
                message: 'Are you sure you want to accept this applicant?',
                cancelText: 'Cancel',
                confirmText: 'Accept',
                onConfirm: () => {
                    this.acceptNow(appId)
                }
            });
        },
        acceptNow(appId){
            axios.post('/employer/accept-applicant/' + appId).then(res=>{
                if(res.data.status === 'accepted'){
                    this.$buefy.dialog.alert({
                        title: 'Accepted',
                        type: 'is-success',
                        message: 'Accepted successfully.',
                        confirmText: 'Accept',
                    });

                    this.getApplicants();
                }
            })
        },

        cancelAccept(appId){
            this.$buefy.dialog.confirm({
                title: 'Cancel?',
                type: 'is-info',
                message: 'Are you sure you want to cancel?',
                cancelText: 'Cancel',
                confirmText: 'Yes',
                onConfirm: () => {
                    this.cancelAcceptNow(appId)
                }
            });
        },
        cancelAcceptNow(appId){
            axios.post('/employer/cancel-applicant/' + appId).then(res=>{
                if(res.data.status === 'canceled'){
                    this.$buefy.dialog.alert({
                        title: 'Success',
                        type: 'is-success',
                        message: 'Canceled successfully.',
                    });
                    this.getApplicants();
                }
            })
        },

        openRateModal(row){

            this.clearFields();
            this.rateModal = true;
            this.applicant = row;
        },

        submitRate(){
            this.fields.user_id = this.applicant.user_id;
            this.fields.job_post_id = this.applicant.job_post_id;
            this.fields.applicant_id = this.applicant.applicant_id;

            axios.post('/employer/rate-employee', this.fields).then(res=>{
                this.rateModal = false;
                if(res.data.status === 'submitted'){
                    this.$buefy.dialog.alert({
                        title: 'Success',
                        type: 'is-success',
                        message: 'Submitted successfully.',
                    });
                }
            }).catch(err=>{
                if(err.response.data.status === 'exist'){
                    this.rateModal = false;

                    this.$buefy.dialog.alert({
                        title: 'Exist!',
                        type: 'is-danger',
                        message: 'Already rated.',
                    });
                }
            })
        },

        clearFields(){
            this.fields = {
                user_id: 0,
                rating: 0,
                job_post_id: 0,
            };
        }
    },

    mounted(){
        this.initData();
        this.getApplicants();
    }

}
</script>

<style scoped>

    .box-container{
        margin: 15px 0;
    }

    .applicant-info > div{
        margin: 15px 0;
    }

</style>>