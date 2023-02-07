<template>
    <div>
        <b-navbar>
            <template #brand>
                <b-navbar-item>
                    <span v-if="userRole">{{ userRole }}</span>
                </b-navbar-item>
            </template>
            <template #start>
                
            </template>

            <template #end>
                <b-navbar-item href="/admin/home">
                    Home
                </b-navbar-item>
              
                <b-navbar-dropdown label="Settings">
                    <b-navbar-item href="/admin/job-types">
                        Job Type
                    </b-navbar-item>
                    <b-navbar-item href="/admin/categories">
                        Category
                    </b-navbar-item>
                    <b-navbar-item href="/admin/qualifications">
                        Qualification
                    </b-navbar-item>
                    <b-navbar-item href="/admin/skills">
                        Skills
                    </b-navbar-item>
                </b-navbar-dropdown>
                

                <b-navbar-dropdown label="Reports">
                    <b-navbar-item href="/hired-list">
                        Hired Llst
                    </b-navbar-item>
         
                </b-navbar-dropdown>


                <b-navbar-item href="/admin/users">
                    Users
                </b-navbar-item>
                
                <b-navbar-item tag="div">
                    <div class="buttons">
                        <b-button @click="logout" class="is-danger">
                            Log out
                        </b-button>
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
            open: false,
            overlay: false,
            fullheight: true,
            fullwidth: false,
            right: true,
            expandOnHover: true,
            reduce: false,
            mobile: "reduce",

            user: {
                role: '',
                lname: '',
                fname: '',
                mname: '',
            },
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
            return this.user.role.toUpperCase() + ' (' + this.user.lname.toUpperCase() + ', ' + this.user.fname.toUpperCase() + ')';

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
