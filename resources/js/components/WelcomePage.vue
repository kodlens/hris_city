<template>
    <div>
        <div class="my-hero-container">
            <div class="hero-text">
                <h1 style="font-size:50px">LEARNING DEVELOPMENT SYSTEM</h1>
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

    .my-hero-container{
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("/img/banner.jpg");
        /* background-image: url("/img/banner.jpg"); */
        height: 100vh;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    .hero-text {
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
    }


    @media only screen and (max-width: 1024px) {

    }

    @media only screen and (max-width: 768px) {
        .main-text-container{
            top: 230px;
            width: 100%;
            margin: 0;
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

    }





</style>
