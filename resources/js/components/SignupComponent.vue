<template>
    <section class="section">
        <div class="columns is-centered">
            <div class="column is-6">
               
                <div class="box">

                    <div class="box-heading">
                        Create your account here...
                    </div>

                    <div class="columns">
                        <div class="column">
                            <b-field label="Username" label-position="on-border"
                                        :type="this.errors.username ? 'is-danger':''"
                                        :message="this.errors.username ? this.errors.username[0] : ''">
                                <b-input type="text" v-model="fields.username" icon="account" placeholder="Username"></b-input>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="Agency No. (Id No.)" label-position="on-border"
                                        :type="this.errors.agency_idno ? 'is-danger':''"
                                        :message="this.errors.agency_idno ? this.errors.agency_idno[0] : ''">
                                <b-input type="text" v-model="fields.agency_idno" icon="id-card" placeholder="Agency No."></b-input>
                            </b-field>
                        </div>
                    </div>


                    <div class="columns">
                        <div class="column">
                            <b-field label="Password" label-position="on-border"
                                        :type="this.errors.password ? 'is-danger':''"
                                        :message="this.errors.password ? this.errors.password[0] : ''">
                                <b-input type="password"  v-model="fields.password" icon="lock" placeholder="Password" password-reveal></b-input>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="Re-type Password" label-position="on-border">
                                <b-input type="password" icon="lock" v-model="fields.password_confirmation" placeholder="Password" password-reveal></b-input>
                            </b-field>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <b-field label="Email" label-position="on-border"
                                        :type="this.errors.email ? 'is-danger':''"
                                        :message="this.errors.email ? this.errors.email[0] : ''">
                                <b-input type="email" v-model="fields.email" placeholder="Email" icon="email"></b-input>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="Contact No." label-position="on-border"
                                        :type="this.errors.contact_no ? 'is-danger':''"
                                        :message="this.errors.contact_no ? this.errors.contact_no[0] : ''">
                                <b-input type="text" v-model="fields.contact_no" icon="cellphone" placeholder="Contact No."></b-input>
                            </b-field>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <b-field label="Last Name" label-position="on-border"
                                        :type="this.errors.lname ? 'is-danger':''"
                                        :message="this.errors.lname ? this.errors.lname[0] : ''" >
                                <b-input icon="account" placeholder="Last Name" v-model="fields.lname" type="text"></b-input>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="First Name" label-position="on-border"
                                        :type="this.errors.fname ? 'is-danger':''"
                                        :message="this.errors.fname ? this.errors.fname[0] : ''">
                                <b-input icon="account" v-model="fields.fname" placeholder="First Name" type="text"></b-input>
                            </b-field>
                        </div>
                    </div>


                    <div class="columns">
                        <div class="column">
                            <b-field label="Middle Name" label-position="on-border">
                                <b-input icon="account" v-model="fields.mname" type="text" placeholder="Middle Name"></b-input>
                            </b-field>
                        </div>

                        <div class="column">
                            <b-field label="Extension" label-position="on-border">
                                <b-input type="text" v-model="fields.extension" 
                                    icon="account"
                                    placeholder="Extension"></b-input>
                            </b-field>
                        </div>

                        <div class="column">
                            <b-field label="Sex" expanded label-position="on-border"
                                        :type="this.errors.sex ? 'is-danger':''"
                                        :message="this.errors.sex ? this.errors.sex[0] : ''">
                                <b-select placeholder="Sex" v-model="fields.sex" icon="human-non-binary" expanded>
                                    <option value="MALE">MALE</option>
                                    <option value="FEMALE">FEMALE</option>
                                </b-select>
                            </b-field>
                        </div>
                    </div>


                    <h2><span class="has-text-weight-bold">EMPLOYMENT INFORMATION</span></h2>
                    <b-field label="Employment Role" expanded label-position="on-border"
                                :type="this.errors.role ? 'is-danger':''"
                                :message="this.errors.role ? this.errors.role[0] : ''">
                        <b-select placeholder="Employment Role" v-model="fields.role" icon="account-supervisor-outline" required expanded>
                            <option value="STAFF">STAFF</option>
                            <option value="FACULTY">FACULTY (FOR TEACHER)</option>
                        </b-select>
                    </b-field>

                    <h2><span class="has-text-weight-bold">RESIDENTIAL ADDRESS</span></h2>
                    <div class="columns">
                        <div class="column">
                            <b-field label="Province" expanded label-position="on-border"
                                        :type="this.errors.res_province ? 'is-danger':''"
                                        :message="this.errors.res_province ? this.errors.res_province[0] : ''">
                                <b-select v-model="fields.res_province" expanded placeholder="Province" 
                                    icon="map-marker" @input="loadCity">
                                    <option v-for="(item, index) in provinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                                </b-select>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="City/Municipality" expanded label-position="on-border"
                                        :type="this.errors.res_city ? 'is-danger':''"
                                        :message="this.errors.res_city ? this.errors.res_city[0] : ''">
                                <b-select expanded v-model="fields.res_city"
                                    icon="map-marker" placeholder="City" @input="loadBarangay">
                                    <option v-for="(item, index) in cities" :key="index" :value="item.citymunCode">{{ item.citymunDesc }}</option>
                                </b-select>
                            </b-field>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <b-field label="Barangay" expanded label-position="on-border"
                                        :type="this.errors.res_barangay ? 'is-danger':''"
                                        :message="this.errors.res_barangay ? this.errors.res_barangay[0] : ''">
                                <b-select v-model="fields.res_barangay" expanded 
                                    icon="map-marker" placeholder="Barangay">
                                    <option v-for="(item, index) in barangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                                </b-select>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="Street" label-position="on-border">
                                <b-input type="text" v-model="fields.res_street"
                                    icon="google-street-view"></b-input>
                            </b-field>
                        </div>
                    </div>

                    <div class="buttons is-right">
                        <b-button class="button is-primary is-outlined is-rounded has-text-weight-bold"
                            icon-right="content-save-check-outline" @click="submit">REGISTER</b-button>
                    </div>


                </div> <!--panel-->

                
            </div><!--column-->
        </div><!--cols-->
    </section>
</template>

<script>
export default {

    data(){
        return{

            fields: {},
            errors: {},

            provinces: [],
            cities: [],
            barangays: [],
            specializations: [],
        }
    },
    methods: {
        //ADDRESS
        loadProvince: function(){
            axios.get('/load-provinces').then(res=>{
                this.provinces = res.data;
            })
        },
        loadCity: function(){
            axios.get('/load-cities?prov=' + this.fields.res_province).then(res=>{
                this.cities = res.data;
            })
        },

        loadBarangay: function(){
            axios.get('/load-barangays?prov=' + this.fields.res_province + '&city_code='+this.fields.res_city).then(res=>{
                this.barangays = res.data;
            })
        },

        submit(){
            axios.post('/sign-up', this.fields).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: "SAVED!",
                        message: 'Register successfully',
                        type: 'is-success',
                        onConfirm: ()=>  window.location = '/'
                    });
                }

            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                }else{
                    alert('An error occured.');
                }
            });
        },

        loadSpecializations(){
            axios.get('/get-open-specializations').then(res=>{
                this.specializations = res.data
            })
        },

    },
    mounted() {
        this.loadProvince();
        //this.loadSpecializations()

    }
}
</script>

<style scoped>

.box-heading{
    font-weight: bold;
    font-size: 1.4em;
    margin: 15px auto;
    text-align: center;
}




/*    dere lang kubia ang panel color*/
</style>
