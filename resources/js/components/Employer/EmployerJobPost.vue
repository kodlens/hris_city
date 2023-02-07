<template>
    <div>
        <div class="section">

            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="box">
                        <div class="has-text-weight-bold">
                            POST JOB
                        </div>
                        <div style="font-style: italic; margin: 25px; color: #e3e3e3;">
                            Post a job now...
                        </div>
                        <hr>
                        <div class="mt-5">

                            <div class="buttons is-right mt-5">
                                <b-button class="button is-primary" @click="jobPostModal(0)">
                                    NEW POST
                                    &nbsp;
                                    &nbsp;
                                    <b-icon icon="content-save-outline"></b-icon>
                                </b-button>
                            </div>
                        </div>
                    </div> <!--box-->
                </div>
            </div>

        </div> <!--section -->

        <div class="section">

            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="box-post" v-for="(item, index) in jobPosts" :key="index">
                        <div class="box-post-heading">
                            <div class="has-text-weight-bold">{{ item.title }}</div>
                            <div class="post-publish" v-if="item.active">Publish</div>
                            <div class="post-hide" v-else>Hidden</div>

                            <div class="box-post-heading-item-left">
                                <b-dropdown aria-role="list">
                                    <template #trigger="{ active }">
                                        <div class="dots">...</div>
                                    </template>

                                    <b-dropdown-item aria-role="listitem" :href="`/employer/applicants/${item.job_post_id}`">Applicants</b-dropdown-item>
                                    <b-dropdown-item aria-role="listitem" @click="jobPostModal(item.job_post_id)">Update</b-dropdown-item>
                                    <b-dropdown-item aria-role="listitem" @click="confirmDelete(item.job_post_id)">Delete</b-dropdown-item>
                                    
                                    <b-dropdown-item aria-role="listitem"
                                        v-if="item.active === 1"
                                        @click="hidePost(item.job_post_id)">Hide Post</b-dropdown-item>
                                    <b-dropdown-item 
                                        aria-role="listitem" 
                                        v-if="item.active === 0"
                                        @click="publishPost(item.job_post_id)">Publish Post</b-dropdown-item>
                                 
                                </b-dropdown>
                            </div>
                        </div>
                       
                        <div class="box-time">
                            {{ item.created_at | formatDateTime }}
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
                        <div class="box-post-body content" v-html="item.job_desc">
                        </div>

                        <div style="margin-left: 15px;">
                            <div style="font-weight: bold;">
                                Skill(s)
                            </div>
                            <b-taglist>
                                    <b-tag v-for="(i, ix) in item.skills" :key="ix" type="is-info">{{ i.job_post_skill }}</b-tag>
                            </b-taglist>                    
                        </div>
                        <hr>
                        <div class="box-post-footer">
                            <div class="is-flex">
                                <div class="mr-5">
                                    <span>JOB TYPE: </span>
                                    {{ item.jobtype.jobtype }}
                                </div>
                                <div>
                                    <b-icon icon="currency-php"></b-icon><span>{{ item.from_salary }} - {{ item.to_salary }} </span>
                                    {{ item.salary }}
                                </div>
                            </div>
                            
                            <div>
                                <b-icon icon="office-building-marker"></b-icon>
                                <span>{{ item.province.provDesc }}, {{ item.city.citymunDesc }}</span>
                            </div>
                        </div>
                    </div>


                    <b-pagination
                        :total="total"
                        v-model="current"
                        :per-page="perPage"
                        :icon-prev="prevIcon"
                        :icon-next="nextIcon"
                        aria-next-label="Next page"
                        aria-previous-label="Previous page"
                        aria-page-label="Page"
                        aria-current-label="Current page">
                    </b-pagination>

                </div>
            </div> <!-- col centered -->
        </div><!--section-->


        <b-modal v-model="isModalActive" has-modal-card
                 trap-focus scroll="keep" aria-role="dialog" aria-modal>
            <div class="modal-card card-width">
                <header class="modal-card-head">
                    <p class="modal-card-title">JOB POST INFORMATION</p>
                    <button type="button" class="delete"
                            @click="isModalActive = false"/>
                </header>

                <section class="modal-card-body">
                    <div>
                        <div class="mt-5">
                            <div class="columns">
                                <div class="column">
                                    <b-field label="TITLE">
                                        <b-input type="text" v-model="fields.title" placeholder="Title"></b-input>
                                    </b-field>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Job Description"
                                        :type="this.errors.job_desc ? 'is-danger':''"
                                        :message="this.errors.job_desc ? this.errors.job_desc[0] : ''">
                                        <quill-editor
                                            ref="myQuillEditor"
                                            v-model="fields.job_desc"
                                            :options="editorOption"
                                        />
                                        </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                    <div class="column">
                                        <b-field label="Minimum Experience"
                                            :type="this.errors.minimum_experience ? 'is-danger':''"
                                            :message="this.errors.minimum_experience ? this.errors.minimum_experience[0] : ''">
                                            <b-select v-model="fields.minimum_experience" expanded>
                                                <option value="Below 1 Year">Below 1 Year</option>
                                                <option value="1 - 3 Years">1 - 3 Years</option>
                                                <option value="3 - 5 Years">3 - 5 Years</option>
                                                <option value="5 - 10 Years">5 - 10 Years</option>
                                                <option value="Above 10 Years">Above 10 Years</option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Minimum Qualification"
                                            :type="this.errors.minimum_qualification ? 'is-danger':''"
                                            :message="this.errors.minimum_qualification ? this.errors.minimum_qualification[0] : ''">
                                            <b-select v-model="fields.minimum_qualification">
                                                <option v-for="(item, index) in qualifications" :key="index" :value="item.qualification">{{ item.qualification }}</option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Category" expanded>
                                        <b-select v-model="fields.category_id" expanded placeholder="Category">
                                            <option v-for="(item, index) in categories" :key="index" :value="item.category_id">{{ item.category }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Job Type" expanded>
                                        <b-select v-model="fields.jobtype_id" expanded placeholder="Job Type">
                                            <option v-for="(item, index) in jobTypes" :key="index" :value="item.jobtype_id">{{ item.jobtype }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div> <!--cols-->

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Salary (PESO)">
                                        <b-numberinput v-model="fields.from_salary"
                                            placeholder="From" :controls="false"></b-numberinput>
                                        <b-numberinput v-model="fields.to_salary"
                                            placeholder="To" :controls="false"></b-numberinput>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Skill(s)">
                                        <b-taginput
                                            v-model="fields.skills"
                                            :data="filteredTags"
                                            autocomplete
                                            field="skill"
                                            @remove="removeLedaTag"
                                            :open-on-focus="true"
                                            icon="label"
                                            type="is-warning"
                                            placeholder="Add a skill"
                                            @typing="getFilteredTagSkills">
                                            <template v-slot="props">
                                                {{props.option.skill}}
                                            </template>
                                            <template #empty>
                                                There are no items
                                            </template>
                                        </b-taginput>
                                    </b-field>
                                </div>
                            </div>


                            <!-- ADDRESS -->
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Province" label-position="on-border" expanded
                                             :type="this.errors.province ? 'is-danger':''"
                                             :message="this.errors.province ? this.errors.province[0] : ''">
                                        <b-select v-model="fields.province" @input="loadCity" expanded>
                                            <option v-for="(item, index) in provinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="City" label-position="on-border" expanded
                                             :type="this.errors.city ? 'is-danger':''"
                                             :message="this.errors.city ? this.errors.city[0] : ''">
                                        <b-select v-model="fields.city" @input="loadBarangay" expanded>
                                            <option v-for="(item, index) in cities" :key="index" :value="item.citymunCode">{{ item.citymunDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Barangay" label-position="on-border" expanded
                                             :type="this.errors.barangay ? 'is-danger':''"
                                             :message="this.errors.barangay ? this.errors.barangay[0] : ''">
                                        <b-select v-model="fields.barangay" expanded>
                                            <option v-for="(item, index) in barangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Street" label-position="on-border">
                                        <b-input v-model="fields.street"
                                                 placeholder="Street">
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>


                        </div>

                    </div>
                </section>

                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="isModalActive=false"></b-button>
                    <b-button
                        type="is-primary"
                        :label="id > 0 ? 'Update' : 'Post'"
                        icon-right="content-save-outline"
                        @click="submit"></b-button>
                </footer>
            </div>
        </b-modal>


    </div>
</template>

<script>
import templateBuilder from '@babel/template';
import { assertExpression } from '@babel/types';


export default {
    props: ['propCompanyId', 'propJobTypes', 'propCategories', 'propQualifications'],

    data() {
        return {
            categories: [],
            jobTypes: [],

            id: 0,

            fields: {},
            errors: {},

            companyId: null,

            jobPosts: [],
            qualifications: [],

            isModalActive: false,


            //pagination
            total: 0,
            current: 1,
            page: 1,
            perPage: 5,
            //rangeBefore: 3,
            //rangeAfter: 1,
            //order: '',
            //size: '',
            //isSimple: false,
           // isRounded: false,
            //hasInput: false,
            prevIcon: 'chevron-left',
            nextIcon: 'chevron-right',
            //inputPosition: '',
            //inputDebounce: '',

            sortField: 'job_post_id',
            sortOrder: 'desc',

            editorOption: {
                // Some Quill options...
            },

            dataSkills: [],
            filteredTags: [],

            //address
            provinces: [],
            cities: [],
            barangays: [],

        }
    },

    methods: {

        clearFields(){
            this.fields = {
                job_post_id: 0,
                title: '',
                job_desc: '',
                minimum_experience: '',
                minimum_qualification: '',
                category_id: 0,
                jobtype_id: 0,
                from_salary: 0,
                to_salary: 0,
                province: '',
                city: '',
                barangay: '',
                street: '',
            };
        },
        loadCompanies(){
            axios.get('/employer/get-my-companies').then(res=>{
                this.companies = res.data;
            })
        },

        loadJobPosts(){
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `cid=${this.companyId}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            //this.loading = true
            axios.get(`/employer/get-job-posts?${params}`)
                .then(({ data }) => {
                    this.jobPosts = [];
                    let currentTotal = data.total
                    if (data.total / this.perPage > 1000) {
                        currentTotal = this.perPage * 1000
                    }

                    this.total = currentTotal
                    data.data.forEach((item) => {
                        //item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
                        this.jobPosts.push(item)
                    })
                    //this.loading = false
                    console.log(this.jobPosts)
                })
                .catch((error) => {
                    this.jobPosts = []
                    this.total = 0
                    this.loading = false
                    throw error
                })
        },

        submit(){
            if(this.id > 0){
                axios.put('/employer/company-job-update/' + this.fields.job_post_id, this.fields).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: "SAVED!",
                            message: 'Job post updated successfully.',
                            type: 'is-success',
                            onConfirm: ()=>  {
                                //window.location = '/employer/company-job-post/' +this.companyId
                                this.loadJobPosts()
                                this.isModalActive = false
                            }
                        });
                    }
                })
            }else{
                console.log('store')
                axios.post('/employer/company-job-post/' + this.companyId, this.fields).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: "SAVED!",
                            message: 'Job post successfully',
                            type: 'is-success',
                            onConfirm: ()=> {
                                this.clearFields()
                                this.loadJobPosts()
                                this.isModalActive = false
                            }
                        });
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                });
            }


        },

        //alert box ask for deletion
        confirmDelete(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this post? This action cannot be undone.',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => this.deleteSubmit(delete_id)
            });
        },
        //execute delete after confirming
        deleteSubmit(delete_id) {
            axios.delete('/employer/company-job-post-delete/' + delete_id).then(res => {
                this.loadJobPosts();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },

        initData(){
            this.jobTypes = this.propJobTypes;
            this.categories = this.propCategories;
            this.qualifications = JSON.parse(this.propQualifications);

            console.log(this.propCompanyId);
            this.companyId = this.propCompanyId;

        },

        

        jobPostModal(jobPostId){
            
            this.fields.company_id = this.companyId;

            if(jobPostId > 0){
                this.clearFields()
                this.getData(jobPostId)
                this.id = jobPostId
            }

            this.isModalActive = true;
        },

        getData: function(jobPostId){
            axios.get('/employer/get-job-post/' + jobPostId).then(res=>{
                let tempData = res.data;
                console.log(tempData)
                //this.fields = res.data
                this.fields.job_post_id = res.data.job_post_id;
                this.fields.title = res.data.title;
                this.fields.job_desc = res.data.job_desc;
                this.fields.minimum_experience = res.data.minimum_experience;
                this.fields.minimum_qualification = res.data.minimum_qualification;
                this.fields.category_id = res.data.category_id;
                this.fields.jobtype_id = res.data.jobtype_id;
                this.fields.from_salary = parseFloat(res.data.from_salary);
                this.fields.to_salary = parseFloat(res.data.to_salary);

                let a = [];
                res.data.skills.forEach(element => {
                    a.push({
                        'job_post_id': element.job_post_id,
                        'skill': element.job_post_skill
                    })
                });
                this.fields.skills = a
                
                this.fields.province = res.data.province.provCode;
                //load cities
                axios.get('/load-cities?prov=' + this.fields.province).then(res=>{
                    //load barangay
                    this.cities = res.data;
                    this.fields.city = tempData.city.citymunCode
                    axios.get('/load-barangays?prov=' + this.fields.province + '&city_code='+this.fields.city).then(res=>{
                        this.barangays = res.data;
                        console.log(tempData)
                        this.fields.barangay = tempData.barangay.brgyCode
                        this.fields.street = tempData.street;
                    });
                });

            })
        },




        /* QUILL METHODS*/
        onEditorBlur(quill) {
            console.log('editor blur!', quill)
        },
        onEditorFocus(quill) {
            console.log('editor focus!', quill)
        },
        onEditorReady(quill) {
            console.log('editor ready!', quill)
        },
        onEditorChange({ quill, html, text }) {
            console.log('editor change!', quill, html, text)
            this.content = html
        },
        /* QUILL METHODS*/


        loadSkills: function(){
            axios.get('/get-open-skills').then(res=>{
                this.dataSkills = res.data;
            })
        },
        getFilteredTagSkills(text) {
            this.filteredTags = this.dataSkills.filter((option) => {
                return option.skill
                    .toString()
                    .toLowerCase()
                    .indexOf(text.toLowerCase()) >= 0
            })
        },
        removeLedaTag: function(data){
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this skill? This action cannot be undone.',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => {
                    axios.delete('/employer/job-post-skill-delete/' + data.skill + '/' + data.job_post_id).then(res=>{
                        this.$buefy.toast.open({
                            message: 'Skill deleted successfully,',
                            type: 'is-success'
                        })
                    })
                }
            });

        },





        // address
        loadProvince: function(){
            axios.get('/load-provinces').then(res=>{
                this.provinces = res.data;
            })
        },
        loadCity: function(){
            axios.get('/load-cities?prov=' + this.fields.province).then(res=>{
                this.cities = res.data;
            })
        },
        loadBarangay: function(){
            axios.get('/load-barangays?prov=' + this.fields.province + '&city_code='+this.fields.city).then(res=>{
                this.barangays = res.data;
            })
        },


        hidePost(postId){
            axios.post('/employer/job-post-hide/' + postId).then(res=>{
                this.$buefy.toast.open({
                    message: 'Post hide in feeds',
                    type: 'is-success'
                })
                this.loadJobPosts()
            })
        },

        publishPost(postId){
            axios.post('/employer/job-post-publish/' + postId).then(res=>{
                this.$buefy.toast.open({
                    message: 'Post publish in feeds',
                    type: 'is-success'
                })

                this.loadJobPosts()
            })
        },

    },

    mounted(){
        this.loadProvince();
        this.initData();
        this.loadJobPosts();
        this.loadCompanies();
        this.loadSkills();
    },

    computed: {
        editor() {
            return this.$refs.myQuillEditor.quill
        }
    }
}
</script>
<style scoped>
    .post-heading{
        margin-bottom: 10px;
        border-bottom: 1px solid gray;
    }

    .box-post{
        border: 1px solid gray;
        margin: 15px 0;
    }

    .box-post-heading{
        margin: 10px 10px 0 15px;
        display: flex;
    }
    .box-time{
        margin: 10px 0 0 15px;
        color: gray;
        font-size: .8em;
    }

    .box-post-heading-item-left{
        margin-left: auto;
    }

    .box-post-body{
        padding: 15px;
    }

    .box-post-footer{
        padding: 15px;
    }

    .dots{
        font-weight: bold;
        font-size: 1.8em;
        cursor: pointer;
    }

    .post-publish{
        padding: 5px;
        background-color: green;
        color: white;
        font-weight: bold;
        font-size: .8em;
        margin: 0 0 0 15px;
        text-align: center;
    }

    .post-hide{
        padding: 5px;
        background-color: red;
        color: white;
        font-weight: bold;
        font-size: .8em;
        margin: 0 0 0 15px;
        text-align: center;
    }
</style>
