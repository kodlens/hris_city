<template>
    <div>
       <form @submit.prevent="submit">
            <b-field label="Username" label-position="on-border"
                :type="this.errors.username ? 'is-danger' : ''"
                :message="this.errors.username ? this.errors.username[0] : ''">
                <b-input type="text" v-model="fields.username" placeholder="Username" />
            </b-field>

            <b-field label="Password" label-position="on-border">
                <b-input type="password" v-model="fields.password" password-reveal placeholder="Password" />
            </b-field>
            
            <div class="buttons my-5">
                <button class="button is-rounded is-fullwidth is-primary">
                    LOGIN
                </button>
            </div>

            <div>
                Not Registered? <a href="/sign-up">Tap/Click me to create an account.</a>
            </div>
       </form>
        
    </div>
</template>

<script>

export default {
    data() {
        return{
            fields: {
                username: null,
                password: null,
            },

            errors: {},
        }
    },

    methods: {
        submit: function () {
            axios
                .post("/login", this.fields)
                .then((res) => {
                    console.log(res.data);
                    if (res.data.role === "ADMINISTRATOR") {
                        window.location = "/admin-home";
                    }
                    if (res.data.role === "USER" || res.data.role === 'FACULTY') {
                        window.location = "/home";
                    }
                   
                    //window.location = '/dashboard';
                })
                .catch((err) => {
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors;
                    }
                });
        },
    },
}
</script>
