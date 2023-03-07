<template>
    <div>
       
        <div class="w-hero">

        </div>

        <div class="welcome-card-container">
            <div class="welcome-card">
                <div style="font-weight: bold; font-size: 5em;">TEL MS</div>
                <p class="subtitle">A Multiplatform Employee Leave Management System for the LGU of Tangub City</p>
            </div>

            <div class="welcome-card">
                <div>
                    <div class="subtitle has-text-weight-bold mb-5 is-size-4">
                        <blockquote>
                            Setup your account and manage your own information in an easy way.
                        </blockquote>
                    </div>
                </div>
                <div class="welcome-buttons">
                  
                    <!-- <b-button class="w-button is-outlined is-info" tag="a" href="/sign-up">
                        <span style="font-weight: bold;">SIGN UP</span>
                    </b-button>
                    <b-button class="w-button is-outlined is-primary" tag="a" href="/login">
                        <span style="font-weight: bold;">LOGIN</span>
                    </b-button> -->
                </div>
            </div>
        </div>


    </div> <!--root div-->
</template>

<script>
export default {
    props: ['propUser'],
    data(){
        return{
            locale: undefined,
            isModalActive: false,
        }

    },

    methods: {

    },

    mounted() {


    },


}
</script>

<style scoped>

    .w-hero{
        height: 500px;
        background:  #f17c2e;
    }

    .welcome-card-container{
        display: flex;
        margin-top: -250px;
        gap: 10px;
        justify-content: center;
    }

    .welcome-card{
        background: white;
        padding: 20px;
        height: 500px;
        max-width: 600px;
    }

    .welcome-buttons{
        display: flex;
        box-sizing: border-box;
    }

    .welcome-buttons > .w-button{
          width: 100%;
        margin: 5px;
    }

    @media only screen and (max-width: 1024px) {

    }

    @media only screen and (max-width: 768px) {
        .main-text-container{
            top: 230px;
            width: 100%;
            margin: 0;
        }


         .welcome-card-container{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .welcome-card{
            margin: 15px;
        }

    }

    @media only screen and (max-width: 480px) {
        .main-text-container{
            padding: 15px;
        }
        .main-title{
            font-size: 1.2em;
        }

        .main-subtitle{
            font-size: .8em;
        }

        .welcome-card{
            background: white;
            padding: 20px;
            height: 500px;
            margin: 15px;
        }

    }





</style>
