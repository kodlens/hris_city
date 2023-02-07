<template>
    <div class="login-wrapper">
        <div class="login">

            <form @submit.prevent="submit">
                <div class="card">
                    <div class="title is-4">
                        Sign In
                        <b-icon icon="login" class="is-large"></b-icon>
                    </div>
                    <hr>

                    <div class="panel-body">
                        <b-field label="Username" label-position="on-border"
                            :type="this.errors.username ? 'is-danger':''"
                            :message="this.errors.username ? this.errors.username[0] : ''">
                            <b-input type="text" v-model="fields.username" placeholder="Username" />
                        </b-field>

                        <b-field label="Password" label-position="on-border">
                            <b-input type="password" v-model="fields.password" password-reveal placeholder="Password" />
                        </b-field>

                        <div class="buttons">
                            <button class="button is-rounded is-fullwidth is-primary">LOGIN</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</template>

<script>

export default {
    data(){
        return {
            fields: {
                username: null,
                password: null,
            },

            errors: {},
        }
    },

    methods: {
        submit: function(){
            axios.post('/login', this.fields).then(res=>{
                console.log(res.data)
                if(res.data.role === 'ADMINISTRATOR'){
                    window.location = '/admin-home';
                }
                if(res.data.role === 'FACULTY'){
                    window.location = '/faculty/home';
                }
                if(res.data.role === 'HRLD'){
                    window.location = '/hrld/home';
                }
                if(res.data.role === 'CID'){
                    window.location = '/cid/home';
                }
                if(res.data.role === 'DEPED OFFICIAL'){
                    window.location = '/deped/home';
                }
               //window.location = '/dashboard';
            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                }
            });
        }
    }
}
</script>


<style scoped>
    .login-wrapper{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login{
        width: 500px;
    }

    .box{
        border: 1px solid rgb(223, 223, 223);
    }

    .card {
        background: rgb(255, 255, 255);
        border-radius: 0.4em;
        box-shadow: 0.3em 0.3em 0.7em #00000015;
        transition: border 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: rgb(250, 250, 250) 0.2em solid;
        padding: 25px;
    }

    .card:hover {
        border: #006fff 0.2em solid;
    }




</style>
