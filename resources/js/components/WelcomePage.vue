<template>
    <div>


        

    </div> <!--root div-->
</template>

<script>
export default {
    
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
