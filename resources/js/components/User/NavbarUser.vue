<template>
    <div>

        <b-navbar>
            <template #brand>
                <b-navbar-item>
                    <img src="/img/trablogo.png" />
                </b-navbar-item>
               
            </template>

            <template #start>
            </template>

            <template #end>
                <b-navbar-item href="/">
                    Home
                </b-navbar-item>

                <b-navbar-item href="/employee/profile">
                    {{ showName }}
                </b-navbar-item>

                <b-navbar-item tag="div">
                    <div class="buttons">
                        <b-button label="LOGOUT" icon-left="logout" @click="logout">
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
            user: null,
        }
    },
    methods: {
        logout(){
            axios.post('/logout').then(()=>{
                window.location = '/';
            })
        },

        loadUser(){
            axios.get('/get-logged-user').then(res=>{
                this.user = res.data;
            })
        }
    },

    mounted() {
        this.loadUser()
    },

    computed: {
        showName: function(){
            if(this.user){
                return this.user.fname.toUpperCase();
            }
            return '';
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
    border-bottom: 2px solid rgba(22, 69, 28, 0.53);
    display: flex;
}

.mynav-brand{
    font-weight: bold;
    font-size: 1.2em;
}



</style>
