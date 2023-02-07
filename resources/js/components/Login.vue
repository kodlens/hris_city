<template>
    <div class="login-wrapper">
        <div class="login">

            <form @submit.prevent="submit">
                <div class="box">
                    <div class="title is-4 is-centered">
                        LOGIN TO TRABAHUNT
                    </div>
                    <hr class="hr-line">

                    <div class="panel-body">
                        <b-field class="login-input" label="Username" label-position="on-border"
                            :type="this.errors.username ? 'is-danger':''"
                            :message="this.errors.username ? this.errors.username[0] : ''">
                            <b-input type="text" icon="account" rounded v-model="fields.username" placeholder="Username" />
                        </b-field>

                        <b-field label="Password" label-position="on-border">
                            <b-input type="password" rounded icon="lock" v-model="fields.password" password-reveal placeholder="Password" />
                        </b-field>

                        <div class="buttons is-centered mt-4">
                            <button class="button is-primary is-rounded">LOGIN</button>

                        </div>
                        <div style="text-align: center;">
                            <a href="/sign-up">Register here</a>
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
                if(res.data.role === 'ADMINISTRATOR' || res.data.role === 'STAFF'){
                    window.location = '/admin/home';
                }

                if(res.data.role === 'USER' || res.data.role === 'EMPLOYEE'){
                    window.location = '/';
                }

                if(res.data.role === 'EMPLOYER'){
                    window.location = '/employer/dashboard';
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
        padding: 50px 25px 50px 25px;
        border: 1px solid rgb(223, 223, 223);
        border: 1px solid green;
    }

    .hr-line{
        background-color: green;
    }

    .login-input{
        margin-bottom: 25px;
    }


</style>
