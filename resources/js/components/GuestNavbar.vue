<template>
    <b-navbar>
        <template #brand>
            <b-navbar-item>
                <h1 class="ml-5" style="font-weight: bolder; font-size: 2em;">HRIS</h1>
            </b-navbar-item>
        </template>

        <template #start>


        </template>

        <template #end>
           
            <!-- <b-navbar-item href="/about">
                ABOUT
            </b-navbar-item> -->
            <b-navbar-item href="/my-appointment" v-if="currentLogin">
                MY APPOINTMENT
            </b-navbar-item>
            <b-navbar-item tag="div">
               
            </b-navbar-item>
        </template>
    </b-navbar>

</template>

<script>
export default {
    props: ['propUser'],

    data(){
        return{
            user: null,
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
        }
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
        }
    }

}
</script>

<style>
    .navbar-item{
        font-weight: bold;
    }
</style>
