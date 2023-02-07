<template>
    <div>
        <div class="home-container">
            
            <div class="box box-width">
                <div class="w-head-title">
                    WELCOME ADMINISTRATOR
                </div>
                <div class="w-content">
                    {{ info.user }}
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
	data(){
		return{
            info: {},

		}
	},

	methods:{


	},

    mounted() {
        
    }
}
</script>

<style scoped>

    .box-width{
        max-width: 600px;
    }
    .home-container{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .w-head-title{
        font-weight: bold;
        text-align: center;
    }
    .w-content{
        text-align: center;
        font-weight: bold;
        font-size: 2em;
    }
</style>
