<template>
    <div>
        <div class="w-container">
            <div class="pending-text">
                This account is pending approval.
            </div>
            <div class="subtitle">
                Your account is currently under review. You shouldmhear back from us quickly, but in some cases, it could
                take up to 2-3 business days.
            </div>
        </div>
    </div>
</template>

<script>

export default{
    data(){
        return {
        }
    },

    methods: {

    },

    mounted(){

    }
}
</script>

<style scoped>
    .w-container{
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .pending-text{
        font-weight: bold;
        font-size: 1.8em;
    }

</style>