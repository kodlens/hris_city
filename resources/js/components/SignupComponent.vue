<template>
    <section class="section">
        <div class="columns is-centered">
            <div class="column is-6">
                <form @submit.prevent="submit">

                    <div class="box">
                        <div class="box-heading">
                            REGISTER AN ACCOUNT HERE
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
                                    <b-input type="text" v-model="fields.agency_idno" icon="account" placeholder="Agency No."></b-input>
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
                                    <b-input type="text" v-model="fields.contact_no" icon=""></b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Last Name" label-position="on-border"
                                            :type="this.errors.lname ? 'is-danger':''"
                                            :message="this.errors.lname ? this.errors.lname[0] : ''" >
                                    <b-input icon="account" placeholder="First Lastname" v-model="fields.lname" type="text"></b-input>
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
                                    <b-input v-model="fields.mname" type="text" placeholder="Middle Name"></b-input>
                                </b-field>
                            </div>

                            <div class="column">
                                <b-field label="Suffix" label-position="on-border">
                                    <b-input type="text" v-model="fields.suffix" placeholder="Suffix"></b-input>
                                </b-field>
                            </div>

                            <div class="column">
                                <b-field label="Sex" expanded label-position="on-border"
                                            :type="this.errors.sex ? 'is-danger':''"
                                            :message="this.errors.sex ? this.errors.sex[0] : ''">
                                    <b-select placeholder="Sex" v-model="fields.sex" icon="account" expanded>
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                    </b-select>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="School Assigned" label-position="on-border"
                                         :type="this.errors.school_assigned ? 'is-danger':''"
                                         :message="this.errors.school_assigned ? this.errors.school_assigned[0] : ''">
                                    <b-input type="text"
                                             required
                                             v-model="fields.school_assigned"
                                             placeholder="School Assigned"></b-input>
                                </b-field>
                            </div>
                        </div>

<!--                        <div class="columns">-->
<!--                            <div class="column">-->
<!--                                <b-field label="Special Skill & Hobbies" label-position="on-border">-->
<!--                                    <b-select v-model="fields.skill_hobbies"-->
<!--                                              placeholder="TSpecial Skill & Hobbies"-->
<!--                                              expanded>-->
<!--                                        <option v-for="(i, ix) in specializations" :key="ix"-->
<!--                                                :value="i.specialization">-->
<!--                                            {{ i.specialization }}-->
<!--                                        </option>-->
<!--                                    </b-select>-->
<!--                                </b-field>-->
<!--                            </div>-->
<!--                        </div>-->

                        <h2><span>RESIDENTIAL ADDRESS</span></h2>
                        <div class="columns">
                            <div class="column">
                                <b-field label="Province" expanded label-position="on-border"
                                            :type="this.errors.res_province ? 'is-danger':''"
                                            :message="this.errors.res_province ? this.errors.res_province[0] : ''">
                                    <b-select v-model="fields.res_province" expanded placeholder="Province" @input="loadCity">
                                        <option v-for="(item, index) in provinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                                    </b-select>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="City/Municipality" expanded label-position="on-border"
                                            :type="this.errors.res_city ? 'is-danger':''"
                                            :message="this.errors.res_city ? this.errors.res_city[0] : ''">
                                    <b-select expanded v-model="fields.res_city" placeholder="City" @input="loadBarangay">
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
                                    <b-select v-model="fields.res_barangay" expanded placeholder="Barangay">
                                        <option v-for="(item, index) in barangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                                    </b-select>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="Street" label-position="on-border">
                                    <b-input type="text" v-model="fields.res_street"></b-input>
                                </b-field>
                            </div>
                        </div>

                        <div class="buttons is-right">
                            <button class="button is-primary">Register</button>
                        </div>


                    </div> <!--panel-->

                </form>
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
