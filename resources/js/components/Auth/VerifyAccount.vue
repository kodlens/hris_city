<template>
    <div>
        <div class="section">

            <div class="columns is-centered">

                <div class="column is-6">
                    <div class="box">
                        <div class="box-header">Verify Email Address</div>

                        <div class="box-body">

                            <b-notification
                                v-model="notif"
                                type="is-success" 
                                aria-close-label="Close notification">
                                A fresh verification link has been sent to your email address.
                            </b-notification>
                            
                           
                            <div>Before proceeding, please check your email for a verification link.</div>
                            <div>If you did not receive the email, click request button.</div>
                           
                            <div class="buttons is-right mt-5">
                                <button :class="btnClass" @click="requestVerification">Request</button>.
                            </div>

                        </div>
                    </div>
                </div>
                
            </div> <!--cols-->


        </div>
    </div>
</template>

<script>
export default {

    data(){
        return{

            btnClass:{
                'button': true,
                'is-primary': true,
                'is-loading': false,
            },

            notif: false
        }
    },

    methods: {
        requestVerification(){
            this.btnClass['is-loading'] = true
            axios.post('/email/resend').then(res=>{
                console.log(res);

                this.btnClass['is-loading'] = false
                this.notif = true

            }).catch(err=>{

                this.btnClass['is-loading'] = false

                this.$buefy.dialog.alert({
                    title: 'Error!',
                    type: 'is-danger',
                    message: err
                });
            })
        }
    },

    mounted(){

    }
}
</script>