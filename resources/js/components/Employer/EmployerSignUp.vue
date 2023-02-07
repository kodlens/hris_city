<template>
    <section class="section">
        <div class="columns is-centered is-gapless">
            <div class="column is-4">
                <div class="left-container">
                    <div class="left-slogan">
                        Find the best candidate for your company by creating account.
                    </div>
                    <img class="model-img"
                        src="/img/model-register-employee.png">
                </div>
            </div>
            <div class="column is-6-desktop is-4-widescreen">
                <form @submit.prevent="submit">

                    <div class="reg-box">
                        <div class="section">
                            <div class="sign-up-header">
                                START HIRING CANDIDATES
                            </div>
                            <div class="sign-up-header">
                                CREATE AN ACCOUNT
                            </div>
                            <hr>
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Username"
                                            :type="this.errors.username ? 'is-danger':''"
                                            :message="this.errors.username ? this.errors.username[0] : ''">
                                        <b-input type="text" v-model="fields.username" icon="account"></b-input>
                                    </b-field>

                                    <b-field label="Password"
                                            :type="this.errors.password ? 'is-danger':''"
                                            :message="this.errors.password ? this.errors.password[0] : ''">
                                        <b-input type="password"  v-model="fields.password" icon="lock" password-reveal></b-input>
                                    </b-field>
                                    <b-field label="Re-type Password">
                                        <b-input type="password" icon="lock" v-model="fields.password_confirmation" password-reveal></b-input>
                                    </b-field>


                                    <b-field label="Email"
                                            :type="this.errors.email ? 'is-danger':''"
                                            :message="this.errors.email ? this.errors.email[0] : ''">
                                        <b-input type="email" v-model="fields.email" icon="email"></b-input>
                                    </b-field>
                                    <b-field label="Contact No."
                                            :type="this.errors.contact_no ? 'is-danger':''"
                                            :message="this.errors.contact_no ? this.errors.contact_no[0] : ''">
                                        <b-input type="text" icon="cellphone" v-model="fields.contact_no"></b-input>
                                    </b-field>


                                    <b-field label="Last Name"
                                            :type="this.errors.lname ? 'is-danger':''"
                                            :message="this.errors.lname ? this.errors.lname[0] : ''" >
                                        <b-input icon="account" placeholder="First Lastname" v-model="fields.lname" type="text"></b-input>
                                    </b-field>
                                    <b-field label="First Name"
                                            :type="this.errors.fname ? 'is-danger':''"
                                            :message="this.errors.fname ? this.errors.fname[0] : ''">
                                        <b-input icon="account" v-model="fields.fname" placeholder="First Name" type="text"></b-input>
                                    </b-field>

                                    <b-field label="Middle Name">
                                        <b-input v-model="fields.mname" type="text" icon="account" placeholder="Middle Name"></b-input>
                                    </b-field>

                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Suffix">
                                        <b-input type="text" v-model="fields.suffix" placeholder="Suffix"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Sex" expanded
                                             :type="this.errors.sex ? 'is-danger':''"
                                             :message="this.errors.sex ? this.errors.sex[0] : ''">
                                        <b-select placeholder="Sex" v-model="fields.sex" icon="gender-male-female-variant" expanded>
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Province" expanded
                                             :type="this.errors.province ? 'is-danger':''"
                                             :message="this.errors.province ? this.errors.province[0] : ''">
                                        <b-select v-model="fields.province" expanded placeholder="Province" icon="google-maps" @input="loadCity">
                                            <option v-for="(item, index) in provinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="City/Municipality" expanded
                                             :type="this.errors.city ? 'is-danger':''"
                                             :message="this.errors.city ? this.errors.city[0] : ''">
                                        <b-select expanded v-model="fields.city" placeholder="City" icon="google-maps" @input="loadBarangay">
                                            <option v-for="(item, index) in cities" :key="index" :value="item.citymunCode">{{ item.citymunDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Barangay" expanded
                                             :type="this.errors.barangay ? 'is-danger':''"
                                             :message="this.errors.barangay ? this.errors.barangay[0] : ''">
                                        <b-select v-model="fields.barangay" expanded placeholder="Barangay" icon="google-maps">
                                            <option v-for="(item, index) in barangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="House #. Street">
                                        <b-input type="text" icon="map-search-outline"  v-model="fields.street"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="buttons is-right">
                                <button class="button is-success">Register</button>
                            </div>

                        </div> <!--panel -body-->
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
            axios.get('/load-cities?prov=' + this.fields.province).then(res=>{
                this.cities = res.data;
            })
        },

        loadBarangay: function(){
            axios.get('/load-barangays?prov=' + this.fields.province + '&city_code='+this.fields.city).then(res=>{
                this.barangays = res.data;
            })
        },

        submit(){
            axios.post('/employer/signup', this.fields).then(res=>{
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
                }
            });
        },

    },
    mounted() {
        this.loadProvince();
    }
}
</script>

<style scoped>


    .panel > .panel-heading{
        background-color: #e0fcda;
        color:rgb(0, 0, 0);
    }

    .sign-up-header{
        font-weight: bold;
    }
    .reg-box{
        border: 1px solid green;
    }


    .left-container{
        height:100%;
        background-color: green;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .left-slogan{
        margin: 15px;
        font-weight: bold;
        color: white;
        font-size: 2em;;
        text-align: center;

    }

    .model-img{
        position: absolute;
        bottom: 0;
        right: 0;
    }


    @media only screen and (max-width: 740px) {
        .model-img{
           display: none;
        }
    }

    /*    dere lang kubia ang panel color*/
</style>
