<template>
    <div>
        <div class="section">

            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="box top-border-green">
                        <div class="form-section-title">
                            Company Information
                        </div>

                        <div>
                            <form @submit.prevent="submit">
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Company Name"
                                            :type="this.errors.company ? 'is-danger':''"
                                            :message="this.errors.company ? this.errors.company[0] : ''">
                                            <b-input type="text" placeholder="Company Name" v-model="fields.company"  required></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Trade Name"
                                            :type="this.errors.trade_name ? 'is-danger':''"
                                            :message="this.errors.trade_name ? this.errors.trade_name[0] : ''">
                                            <b-input type="text" placeholder="Trade Name" v-model="fields.trade_name" ></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Accronym/Abbreviation"
                                            :type="this.errors.accronym ? 'is-danger':''"
                                            :message="this.errors.accronym ? this.errors.accronym[0] : ''">
                                            <b-input type="text" placeholder="Accronym/Abbreviation" 
                                                v-model="fields.accronym" 
                                            ></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Company Overview"
                                            :type="this.errors.overview ? 'is-danger':''"
                                            :message="this.errors.overview ? this.errors.overview[0] : ''">
                                            <b-input type="textarea" placeholder="Company Overview" v-model="fields.overview" required></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Main/Branch"
                                            expanded
                                            :type="this.errors.main_branch ? 'is-danger':''"
                                            :message="this.errors.main_branch ? this.errors.main_branch[0] : ''">
                                            <b-select placeholder="Main/Branch"
                                                expanded 
                                                v-model="fields.main_branch" required>
                                                <option value="MAIN">MAIN</option>
                                                <option value="BRANCH">BRANCH</option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Employer Type"
                                            expanded
                                            :type="this.errors.employer_type ? 'is-danger':''"
                                            :message="this.errors.employer_type ? this.errors.employer_type[0] : ''">
                                            <b-select placeholder="Employer Type"
                                                expanded 
                                                v-model="fields.employer_type" required>
                                                <option v-for="(item, index) in employer_types" 
                                                    :key="index" 
                                                    :value="`${item.public_private} - ${item.employer_type}`">
                                                    {{ item.public_private}} - {{  item.employer_type }}
                                                </option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Work Force"
                                            expanded
                                            :type="this.errors.total_work_force ? 'is-danger':''"
                                            :message="this.errors.total_work_force ? this.errors.total_work_force[0] : ''">
                                            <b-select placeholder="Employer Type"
                                                expanded 
                                                v-model="fields.total_work_force" required>

                                                <option value="Micro (1-9)">Micro (1-9)</option>
                                                <option value="Small (10-99)">Small (10-99)</option>
                                                <option value="Medium (100-199)">Medium (100-199)</option>
                                                <option value="Medium (200-Up)">Medium (200-Up)</option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Industry">
                                            <b-input type="text" 
                                                placeholder="Industry" 
                                                v-model="fields.industry"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Benefits/Others">
                                            <b-input type="text" 
                                                placeholder="Benefits/Others" 
                                                v-model="fields.benefits_others"></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Tax Identification No."
                                            :type="this.errors.tin ? 'is-danger':''"
                                            :message="this.errors.tin ? this.errors.tin[0] : ''">
                                            <b-input type="text" placeholder="TIN" 
                                                v-model="fields.tin"></b-input>
                                        </b-field>
                                    </div>
                                </div>


                                <hr>
                                <div class="form-section-title">
                                    Contact Information
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Name of Owner/President(Fullname)"
                                            :type="this.errors.owner ? 'is-danger':''"
                                            :message="this.errors.owner ? this.errors.owner[0] : ''">
                                            <b-input type="text" placeholder="Name of Owner/President(Fullname)" v-model="fields.owner" required></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Contact Person"
                                            :type="this.errors.contact_person ? 'is-danger':''"
                                            :message="this.errors.contact_person ? this.errors.contact_person[0] : ''">
                                            <b-input type="text" 
                                                placeholder="Contact Person" 
                                                v-model="fields.contact_person"></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Position"
                                            :type="this.errors.contact_position ? 'is-danger':''"
                                            :message="this.errors.contact_position ? this.errors.contact_position[0] : ''">
                                            <b-input type="text" 
                                                placeholder="Position" 
                                                v-model="fields.contact_position"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Contact No.">
                                            <b-input type="text" placeholder="Contact No." v-model="fields.phone_contact"></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="FB">
                                            <b-input type="text" placeholder="FB" v-model="fields.fb_contact"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Twitter">
                                            <b-input type="text" placeholder="Twitter" v-model="fields.twitter_contact"></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Instagram">
                                            <b-input type="text" placeholder="Instagram" v-model="fields.insta_contact"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Viber">
                                            <b-input type="text" placeholder="Viber" v-model="fields.viber_contact"></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="WhatsApp">
                                            <b-input type="text" placeholder="WhatsApp" v-model="fields.whatsapp_contact"></b-input>
                                        </b-field>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Email"
                                            :type="this.errors.email ? 'is-danger':''"
                                            :message="this.errors.email ? this.errors.email[0] : ''">
                                            <b-input type="email" placeholder="Email" v-model="fields.email" required></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-section-title">
                                    Address Information
                                </div>

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


                                <div class="buttons">
                                    <button class="button is-primary">SAVE COMPANY</button>
                                </div>

                            </form>
                        </div><!--div form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: ['propId'],

    data() {
        return{
            fields: {
                company_size: 0
            },
            errors: {},

            //address variables
            provinces: [],
            cities: [],
            barangays: [],
            street: '',
        
            id: 0,

            employer_types: [],

        }
    },

    methods: {
        
        //handle addressess
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

        loadEmployerTypes(){
            axios.get('/employer/get-employer-types').then(res=>{
                this.employer_types = res.data;
            })
        },


        submit: function(){
            if(this.id > 0){
                axios.put('/employer/company-add-edit/'+ this.id, this.fields).then(res=>{
                    if(res.data.status === 'updated'){
                            this.$buefy.dialog.alert({
                                title: 'UPDATED!',
                                message: 'Successfully updated.',
                                type: 'is-success',
                                onConfirm: () => {
                                window.location = '/employer/dashboard';
                                }
                            })
                        }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })
            }else{
                axios.post('/employer/company-add-edit', this.fields).then(res=>{
                    if(res.data.status === 'saved'){
                            this.$buefy.dialog.alert({
                                title: 'SAVED!',
                                message: 'Successfully saved.',
                                type: 'is-success',
                                onConfirm: () => {
                                window.location = '/employer/dashboard';
                                }
                            })
                        }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })
            }
            
        },

        initData(){
            this.id = parseInt(this.propId);
            this.loadEmployerTypes()
            if(this.id > 0){
                this.getData();
            }
        },
        clearFields(){
            this.fields = {
                company_size: 0
            };
        },
        
        getData(){
            this.clearFields();
          
            //nested axios for getting the address 1 by 1 or request by request
            axios.get('/employer/company-show/'+ this.id).then(res=>{
                this.fields = res.data;
             
                let tempData = res.data;

                console.log(res.data)
                //load city first
                axios.get('/load-cities?prov=' + this.fields.province).then(res=>{
                    //load barangay
                    this.cities = res.data;
                    axios.get('/load-barangays?prov=' + this.fields.province + '&city_code='+this.fields.city).then(res=>{
                        this.barangays = res.data;
                        this.fields = tempData;
                    });
                });
            });
        },

    },

    mounted(){
        this.$nextTick(function () {
            // Code that will run only after the
            // entire view has been rendered
            this.initData();
            this.loadProvince();
        })
        
    }
}
</script>


<style scoped>
    .form-section-title{
        font-weight: bold;
        margin-bottom: 15px;
        font-style: italic;
    }

</style>