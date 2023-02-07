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
                <b-navbar-item href="/admin-home">
                    Home
                </b-navbar-item>

                <b-navbar-dropdown label="Setting">
                    <b-navbar-item href="/learning-dev">
                        Learning Development
                    </b-navbar-item>
                    <b-navbar-item href="/specialization">
                        Specialization
                    </b-navbar-item>
                </b-navbar-dropdown>
            </template>

            <template #end>
                <b-navbar-item href="/users">
                    User
                </b-navbar-item>
                <b-navbar-item tag="div">
                    <div class="buttons">

                        <a class="button is-danger" @click="logout">
                            Log out
                        </a>
                    </div>
                </b-navbar-item>
            </template>
        </b-navbar>

    </div>


</template>

<script>
export default {
    data(){
        return{

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
        }
    },

    mounted(){
        this.loadUser();
    },

    computed: {
        userRole(){
            return this.user.role.toUpperCase();
        }
    }
}
</script>

<style scoped>


    .logo{
        padding: 0 30px 0 30px;
        height: 90px;
    }

    .burger-div{
        width: 20px;
        height: 3px;
        background-color: #696969;
        margin: 0 0 3px 0;
        margin-left: auto;
        border-radius: 10px;
    }

    .burger-button{
        display: flex;
        flex-direction: column;
        margin-left: auto;
    }

    .mynav{
        padding: 25px;
        border-bottom: 2px solid rgba(196, 196, 196, 0.53);
        display: flex;
    }

    .mynav-brand{
        font-weight: bold;
        font-size: 1.2em;
    }

  /* .hero{
        background-image: url("/img/bg-hero.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    } */


</style>
