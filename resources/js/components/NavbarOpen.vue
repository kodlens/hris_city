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
                <b-navbar-item v-if="user.role === 'EMPLOYER'" href="/employer/dashboard">
                    Home
                </b-navbar-item>
                <b-navbar-item v-if="user.role === 'EMPLOYEE'" href="/">
                    Home
                </b-navbar-item>


                <b-navbar-item tag="div">
                    <div class="buttons">
                        <b-button @click="logout" class="is-danger" icon-right="logout">
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


</style>
