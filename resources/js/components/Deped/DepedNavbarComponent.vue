<template>
    <div>
        <b-navbar>
            <template #brand>
                <b-navbar-item>
                    <img
                        src="/img/deped-logo.png"
                        alt="Lightweight UI components for Vue.js based on Bulma"
                    >
                </b-navbar-item>
            </template>
            <template #start>
                <b-navbar-item href="/deped/home">
                    Home
                </b-navbar-item>
                <b-navbar-item href="/deped/teacher-list">
                    Teacher List
                </b-navbar-item>


                <!-- <b-navbar-dropdown label="">
                    <b-navbar-item href="#">
                        About
                    </b-navbar-item>
                    <b-navbar-item href="#">
                        Contact
                    </b-navbar-item>
                </b-navbar-dropdown> -->
            </template>

            <template #end>
                <b-navbar-dropdown :label="userName">
                    <b-navbar-item @click="openModalResetPassword">
                        Change Password
                    </b-navbar-item>
                    <!-- <b-navbar-item href="#">
                        Contact
                    </b-navbar-item> -->
                </b-navbar-dropdown>



                <!-- <b-navbar-item class="navbar-notif">
                    <b-icon icon="earth">
                    </b-icon>
                    <div class="notif-counter">
                        4
                    </div>
                </b-navbar-item> -->

                <b-navbar-item tag="div">
                    <div class="buttons">
                        <a class="button is-outlined is-danger" @click="logout">
                            Log out
                        </a>
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


    </div><!-- root div -->


</template>

<script>
export default {
    data(){
        return{
            user: {
                username: '',
            },

            username: '',

            modalResetPassword: false,

            fields: {},
            errors: {},

        }
    },
    methods: {
        logout(){
            axios.post('/logout').then(()=>{
                window.location = '/';
            })
        },

        loadUser(){
            axios.get('/load-user').then(res=>{
                this.user = res.data;
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
        this.loadUser();
    },

    computed: {
        userRole(){
            return this.user.role.toUpperCase();
        },

        userName(){
            return this.user.username.toUpperCase()
        }
    }
}
</script>

<style scoped>
.navbar-notif{
    position: relative;
}
.notif-counter{
    background: red;
    padding: 5px;
    font-weight: bold;
    color:white;
    border-radius: 20px;
    font-size: .6em;
    position: absolute;
    top: 10px;
    left: 20px;
}

@media screen and (max-width: 1024px) {
    .notif-counter{
        position: absolute;
        top: 10px;
        left: 30px;

    }
}

</style>
