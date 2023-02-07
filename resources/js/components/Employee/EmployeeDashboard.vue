<template>
    <div>
        <div class="section">
            <div class="feeds-container">
                <div class="feeds-title">NEWS FEED</div>
                <div v-if="jobs.length < 1">No related job...</div>
                <div class="card-container" v-for="(item, index) in jobs" :key="index">
                    <div class="card">
                        <div class="card-content">
                            <div class="w-header-title">
                                <div class="image is-64x64">
                                    <img class="is-round" src="/storage/company/sample.jpg">
                                </div>
                                <div class="w-logo-side">
                                    <div class="job-title">{{ item.title }}</div>
                                    <div class="company-name">{{ item.company.company }}</div>
                                </div>
                            </div>

                            <div class="content">
                                {{ item.job_desc }}
                            </div>

                            <div>
                                <div class="w-second-content">
                                    <div class="w-title">Location:</div>
                                    <div class="w-name">{{ item.company.province.provDesc }}, {{ item.company.city.citymunDesc }}</div>
                                </div>
                                <div class="w-second-content">
                                    <div class="w-title">Email:</div>
                                    <div class="w-name">{{ item.company.email }}</div>
                                </div>
                                <div class="w-second-content">
                                    <div class="w-title">Rating:</div>
                                    <div class="w-name"></div>
                                </div>
                            </div>
                        </div> <!-- card-content -->
                        <div class="card-footer">
                            <a :href="`/apply-now/${item.job_post_id}`" class="button card-footer-item">APPLY NOW</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: ['propUser'],

    data(){
        return{
            search: {
                categories: [],
            },
            jobs: [],

            user: {},
            categories: [],
        }
    },
    methods: {

        initData(){
            this.user = JSON.parse(this.propUser)
        },

        getRecommendedJobs(){

            this.user.categories.forEach(job => {
                this.categories.push(job.category.category)
            })

            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `categories=${encodeURIComponent(JSON.stringify(this.categories))}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            axios.get(`/get-recommended-jobs?${params}`).then(res=>{
                this.jobs = res.data;
                console.log(this.jobs)
            })
        }
    },

    mounted() {
        this.initData()
        this.getRecommendedJobs()
    }
}
</script>

<style scoped>

    .feeds-container{
        display: flex;
        flex-direction: column;
        max-width: 700px;
        margin: auto;
    }

    .feeds-title{
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-container{
        margin: 10px 0;
        border-top: 2px solid green;
    }

    .w-header-title{
        display: flex;
    }
    .w-logo-side{
        display: flex;
        flex-direction: column;
    }
    .job-title{
        margin: 0px 10px;
        font-weight: bold;
    }
    .company-name{
        font-weight: bold;
        color: gray;
        margin: 0px 10px;
        font-size: .8em;
    }

    .w-second-content{
        display: flex;
        flex-direction: row;
    }
    .w-title{
        font-weight: bold;
        color: gray;
    }
    .w-name{
        margin-left: auto;
    }


</style>
