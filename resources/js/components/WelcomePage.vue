<template>
    <div>
        <div class="section">
            <div class="slogan animate__animated animate__fadeInDown">
                Hunt the best job today!
            </div>
            <div class="slogan animate__animated animate__fadeInDown">
                Hunt the best people for your job!
            </div>
        </div>


        <div class="section filter">
            <div class="job-search-container">
                <div class="columns">
                    <div class="column">
                        <b-field label-position="on-border" label="Job Title or Company Name">
                            <b-input class="search-text" v-model="search.key"
                                @keydown.native.enter="loadJobHiring"
                                type="input" icon-right="magnify" placeholder="Job Title, Company name.."></b-input>
                        </b-field>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <b-field label-position="on-border" label="Job Type" expanded>
                            <b-select v-model="search.jobtype" expanded>
                                <option selected value="">--NONE--</option>
                                <option v-for="(item, index) in jobTypes"  :key="index" :value="item.jobtype">{{ item.jobtype }}</option>
                            </b-select>
                        </b-field>
                    </div>

                    <div class="column">
                        <b-field label-position="on-border" label="Category" expanded>
                            <b-select v-model="search.category" expanded>
                                <option selected value="">--NONE--</option>
                                <option v-for="(item, index) in categories"  :key="index" :value="item.category">{{ item.category }}</option>
                            </b-select>
                        </b-field>
                    </div>
                    <div class="column is-2">
                        <div class="buttons is-centered">
                            <button class="button is-primary is-fullwidth" @click="loadJobHiring">Search</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="result-container">
            <div class="w-card-container" v-for="(item, index) in jobs" :key="index">
                <div class="w-card">
                    <div class="w-card-header">
                        
                        <div class="w-card-header-title">
                            {{ item.title }}
                        </div>

                        <div class="company-rate">
                            Company Name: {{ item.company.company }}
                        </div>

                        <div class="company-rate">
                            Company rate: <b-rate 
                                show-score 
                                spaced
                                disabled 
                                v-model="item.company_rate"></b-rate>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="w-tag-container">
                        <div class="tag-category">
                            {{ item.category.category }}
                        </div>
                        <div class="tag-jobtype">
                            {{ item.jobtype.jobtype }}
                        </div>
                    </div>
                    <div class="w-card-body">
                        <div class="content" v-html="item.job_desc">
                        </div>
                    </div>
                    
                    <hr>
                    <div class="w-card-footer">

                        <b-taglist>
                            <b-tag v-for="(i, ix) in item.skills" :key="ix" type="is-info">{{ i.job_post_skill }}</b-tag>
                        </b-taglist>

                        <div class="is-flex">
                            <div class="mr-5">
                                <span>JOB TYPE: </span>
                                {{ item.jobtype.jobtype }}
                            </div>
                            <div>
                                <b-icon icon="currency-php"></b-icon>
                                <span>
                                    {{ item.from_salary }} - {{ item.to_salary }}
                                </span>
                                
                            </div>
                        </div>
                        
                        <div>
                            <b-icon icon="office-building-marker"></b-icon>
                            <span>{{ item.province.provDesc }}, {{ item.city.citymunDesc }}, {{ item.barangay.brgyDesc }}</span>
                        </div>

                        <div class="buttons mt-4">
                            <b-button label="Apply Now" tag="a" :href="`/apply-now/${item.job_post_id}`" type="is-success"></b-button>
                        </div>
                    </div>
                </div><!-- w-card -->
            </div> <!-- card container--> 
            <div class="no-result" v-if="jobs.length < 1">
                No result found.
            </div>
        </div> <!--result container -->


        <div class="section">
            <div class="t-box-container">
                <div class="t-box-applicant">
                    <div class="t-box-title">Applicant (Aplikante)</div>
                    <div style="display:flex;">
                        <div>
                            <div class="t-box-applicant-title">Looking for a job?</div>
                            <div class="t-box-applicant-subtitle">Nangita ka ug trabaho?</div>
                        </div>
                        <div>
                            <button @click="applyNow" class="applicant-button"><span>Apply now!</span></button>
                        </div>
                    </div>
                </div>

                <div class="t-box-applicant">
                    <div class="t-box-title">Employer (Amo)</div>
                    <div style="display: flex;">
                        <div>
                            <div class="t-box-applicant-title">Are you hiring?</div>
                            <div class="t-box-applicant-subtitle">Naghire ba ka?</div>
                        </div>
                        <div>
                            <button class="applicant-button" @click="signup"><span>Register now!</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- <div class="section">
            <div>
                <h1 class="title" style="text-align: center;">Browse Your Desire Category</h1>
            </div>

            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="category-container">
                        <div class="category-box" v-for="(item, index) in categories" :key="index">
                            <div class="category-content">
                                <div class="category-icon">
                                    <b-icon size="is-large" icon="account"></b-icon>
                                </div>
                                <div class="category-desc">
                                    {{ item.category }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->




    </div> <!--root div-->
</template>

<script>
export default {
   
    data(){
        return{
            locale: undefined,
            isModalActive: false,

            search: {
                jobtype: '',
                category: '',
                key: ''
            },
            categories: [],
            jobTypes: [],
            jobs: [],

        }

    },

    methods: {
        signup: function(){
            window.location = '/employer/signup'
        },

        loadJobHiring(){
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `key=${this.search.key}`,
                `jobtype=${this.search.jobtype}`,
                `category=${this.search.category}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            axios.get(`/get-jobs-hiring?${params}`).then(res=>{
                this.jobs = res.data
            })
        },

        initData(){
           
        },
        applyNow: function(){
            window.location = '/sign-up';
        },

        viewHiring(hiringData){
            console.log(hiringData)
        }

    },

    mounted() {
        this.initData();
        this.loadJobHiring();
    },



}
</script>

<style src="../../css/welcome.css">
</style>
