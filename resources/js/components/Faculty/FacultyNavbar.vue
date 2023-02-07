<template>

    <div>

        <b-navbar>
            <template #brand>
                <b-navbar-item>
                    <h1 class="title is-4">TEACHER PANEL</h1>
                </b-navbar-item>
            </template>

            <template #start>

            </template>

            <template #end>

                <b-navbar-item href="/faculty/home">
                    Home
                </b-navbar-item>

                <b-navbar-item href="/faculty/personal-data-sheet">
                    Personal Data Sheet
                </b-navbar-item>

                <b-navbar-item href="/faculty/trainings-interventions">
                    Tranings / Interventions
                </b-navbar-item>


                <b-navbar-dropdown :label="showName">
                    <b-navbar-item @click="openModalResetPassword">
                        Change Password
                    </b-navbar-item>
                </b-navbar-dropdown>

                <b-navbar-item tag="div">

                    <div class="buttons">
                        <b-button label="LOGOUT" icon-left="logout" @click="logout">
                        </b-button>
                    </div>
                </b-navbar-item>
            </template>
        </b-navbar>

        <!--modal reset password-->
        <b-modal v-model="modalResetPassword" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <form @submit.prevent="resetPassword">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Change Password</p>
                        <button
                            type="button"
                            class="delete"
                            @click="modalResetPassword = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Old Password" label-position="on-border"
                                             :type="this.errors.old_password ? 'is-danger':''"
                                             :message="this.errors.old_password ? this.errors.old_password[0] : ''">
                                        <b-input type="password" v-model="fields.old_password" password-reveal
                                                 placeholder="Password" required>
                                        </b-input>
                                    </b-field>
                                    <b-field label="Password" label-position="on-border"
                                             :type="this.errors.password ? 'is-danger':''"
                                             :message="this.errors.password ? this.errors.password[0] : ''">
                                        <b-input type="password" v-model="fields.password" password-reveal
                                                 placeholder="Password" required>
                                        </b-input>
                                    </b-field>
                                    <b-field label="Confirm Password" label-position="on-border"
                                             :type="this.errors.password_confirmation ? 'is-danger':''"
                                             :message="this.errors.password_confirmation ? this.errors.password_confirmation[0] : ''">
                                        <b-input type="password" v-model="fields.password_confirmation"
                                                 password-reveal
                                                 placeholder="Confirm Password" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">

                        <b-button
                            type="is-primary" icon-left="lock-open-variant-outline" @click="resetPassword">Reset Password</b-button>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->


    </div> <!--root div -->

</template>

<script>
export default {
    props: ['propUser'],

    data(){
        return{
            user: null,
            modalResetPassword: false,
            errors: {},
            fields: {},
        }
    },

    methods:{
        initData: function(){
            if(this.propUser){
                this.user = JSON.parse(this.propUser);
            }

        },

        logout(){
            axios.post('/logout').then(()=>{
                window.location = '/';
            })
        },

        //CHANGE PASSWORD
        openModalResetPassword(dataId){
            this.modalResetPassword = true;
            this.fields = {};
            this.errors = {};
            this.global_id = dataId;
        },
        resetPassword(){
            axios.post('/reset-password', this.fields).then(res=>{

                if(res.data.status === 'changed'){
                    this.$buefy.dialog.alert({
                        title: 'PASSWORD CHANGED',
                        type: 'is-success',
                        message: 'Password changed successfully.',
                        confirmText: 'OK',
                        onConfirm: () => {
                            this.modalResetPassword = false;
                        }
                    });
                }

            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                }

            })
        },

    },

    mounted(){
        this.initData();
    },

    computed: {
        showName(){
            if(this.user){
                return this.user.fname.toUpperCase();
            }
            return '';
        },
        currentLogin(){
            return !!this.user;
        },


    }

}
</script>

<style>
    .navbar-item{
        font-weight: bold;
    }
</style>
