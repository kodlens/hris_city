<template>
    <section class="section">
        <div class="columns is-centered">
            <div class="column is-8-desktop is-10-tablet">


                <div class="box">
                    <div class="box-heading">
                        PERSONAL DATA SHEET
                    </div>

                    <b-steps
                        v-model="activeStep"
                        :animated="isAnimated"
                        :rounded="isRounded"
                        :has-navigation="hasNavigation"
                        :icon-prev="prevIcon"
                        :icon-next="nextIcon"
                        :label-position="labelPosition"
                        :mobile-mode="mobileMode">
                        <b-step-item step="1" label="Account" :clickable="isStepsClickable">

                            <div class="separator">
                                PERSONAL INFORMATION
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Surname" label-position="on-border"
                                                :type="this.errors.surname ? 'is-danger':''"
                                                :message="this.errors.surname ? this.errors.surname[0] : ''">
                                        <b-input type="text" v-model="fields.surname" icon="account"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="First Name" label-position="on-border"
                                            :type="this.errors.fname ? 'is-danger':''"
                                            :message="this.errors.fname ? this.errors.fname[0] : ''">
                                        <b-input type="text" v-model="fields.fname" placeholder="First Name" icon="account"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-8">
                                    <b-field label="Middle Name" label-position="on-border"
                                            :type="this.errors.mname ? 'is-danger':''"
                                            :message="this.errors.mname ? this.errors.mname[0] : ''">
                                        <b-input type="text" v-model="fields.mname" placeholder="Middle Name" icon="account"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Suffix" label-position="on-border"
                                            :type="this.errors.suffix ? 'is-danger':''"
                                            :message="this.errors.suffix ? this.errors.suffix[0] : ''">
                                        <b-input type="text" v-model="fields.suffix" placeholder="Suffix" icon="account"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">

                                <div class="column">
                                    <b-field label-position="on-border" label="Birthdate"
                                             :type="this.errors.date_birth ? 'is-danger':''"
                                             :message="this.errors.date_birth ? this.errors.date_birth[0] : ''">
                                        <b-datepicker editable icon="calendar" v-model="fields.date_birth" placeholder="Birthdate"></b-datepicker>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label-position="on-border" label="Place of Birth"
                                             :type="this.errors.place_birth ? 'is-danger':''"
                                             :message="this.errors.place_birth ? this.errors.place_birth[0] : ''">
                                        <b-input icon="map-marker-radius" v-model="fields.place_birth" placeholder="Place of Birth"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
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
                                <div class="column">
                                    <b-field label="Civil Status" expanded label-position="on-border"
                                             :type="this.errors.civil_status ? 'is-danger':''"
                                             :message="this.errors.civil_status ? this.errors.civil_status[0] : ''">
                                        <b-select placeholder="Civil Status" v-model="fields.civil_status" icon="human-non-binary" expanded>
                                            <option v-for="(item, index) in civilStatuses" :key="index" :value="item.civil_status">
                                                {{ item.civil_status }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="School Assigned" expanded label-position="on-border"
                                             :type="this.errors.school_assigned ? 'is-danger':''"
                                             :message="this.errors.school_assigned ? this.errors.school_assigned[0] : ''">
                                        <b-input placeholder="School Assigned"
                                                 typeof="text"
                                                 v-model="fields.school_assigned"
                                                 icon="account" expanded>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label-position="on-border" label="Height(m)"
                                             :type="this.errors.height ? 'is-danger':''"
                                             :message="this.errors.height ? this.errors.height[0] : ''">
                                        <b-input icon="human-male-height-variant" v-model="fields.height" placeholder="Height(m)"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label-position="on-border" label="Weight(kg)"
                                             :type="this.errors.weight ? 'is-danger':''"
                                             :message="this.errors.weight ? this.errors.weight[0] : ''">
                                        <b-input icon="weight" v-model="fields.weight" placeholder="Weight(kg)"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Blood Type" expanded label-position="on-border"
                                             :type="this.errors.blood_type ? 'is-danger':''"
                                             :message="this.errors.blood_type ? this.errors.blood_type[0] : ''">
                                        <b-select placeholder="Blood Type" v-model="fields.blood_type" icon="water" expanded>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="GSIS" label-position="on-border">
                                        <b-input type="text" placeholder="GSIS" v-model="fields.gsis"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="PAGIBIG" label-position="on-border">
                                        <b-input type="text" placeholder="PAGIBIG" v-model="fields.pagibig"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="PhilHealth" label-position="on-border">
                                        <b-input type="text" placeholder="PhilHealth" v-model="fields.philhealth"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="SSS No." label-position="on-border">
                                        <b-input type="text" placeholder="SSS No." v-model="fields.sss"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="TIN" label-position="on-border">
                                        <b-input type="text" placeholder="TIN" v-model="fields.tin"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Agency No. (Id No.)" label-position="on-border"
                                         :type="this.errors.agency_idno ? 'is-danger':''"
                                         :message="this.errors.agency_idno ? this.errors.agency_idno[0] : ''">
                                        <b-input type="text" placeholder="Agency No." v-model="fields.agency_idno"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Citizenship" expanded label-position="on-border"
                                             :type="this.errors.citizenship ? 'is-danger':''"
                                             :message="this.errors.citizenship ? this.errors.citizenship[0] : ''">
                                        <b-select placeholder="Citizenship" v-model="fields.citizenship" icon="account-switch" expanded>
                                            <option v-for="(item, index) in citizenships" :key="index" :value="item.citizenship">
                                                {{ item.citizenship }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <!-- RESIDENTIAL ADDRESS-->
                            <h2><span>RESIDENTIAL ADDRESS</span></h2>
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Province" expanded label-position="on-border"
                                             :type="this.errors.res_province ? 'is-danger':''"
                                             :message="this.errors.res_province ? this.errors.res_province[0] : ''">
                                        <b-select v-model="fields.res_province" expanded placeholder="Province" @input="loadResCity">
                                            <option v-for="(item, index) in resProvinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="City/Municipality" expanded label-position="on-border"
                                             :type="this.errors.res_city ? 'is-danger':''"
                                             :message="this.errors.res_city ? this.errors.res_city[0] : ''">
                                        <b-select expanded v-model="fields.res_city" placeholder="City" @input="loadResBarangay">
                                            <option v-for="(item, index) in resCities" :key="index" :value="item.citymunCode">{{ item.citymunDesc }}</option>
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
                                            <option v-for="(item, index) in resBarangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Street" label-position="on-border">
                                        <b-input type="text" v-model="fields.res_street"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="House/Block No" label-position="on-border">
                                        <b-input type="text" v-model="fields.res_houseno_blockno"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Zip Code" label-position="on-border">
                                        <b-input type="text" v-model="fields.res_zipcode"></b-input>
                                    </b-field>
                                </div>
                            </div>


                            <!-- PERMANENT ADDRESS-->
                            <h2><span>PERMANENT ADDRESS</span></h2>
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Province" expanded label-position="on-border"
                                             :type="this.errors.per_province ? 'is-danger':''"
                                             :message="this.errors.per_province ? this.errors.per_province[0] : ''">
                                        <b-select v-model="fields.per_province" expanded placeholder="Province" @input="loadPerCity">
                                            <option v-for="(item, index) in perProvinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="City/Municipality" expanded label-position="on-border"
                                             :type="this.errors.per_city ? 'is-danger':''"
                                             :message="this.errors.per_city ? this.errors.per_city[0] : ''">
                                        <b-select expanded v-model="fields.per_city" placeholder="City" @input="loadPerBarangay">
                                            <option v-for="(item, index) in perCities" :key="index" :value="item.citymunCode">{{ item.citymunDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Barangay" expanded label-position="on-border"
                                             :type="this.errors.per_barangay ? 'is-danger':''"
                                             :message="this.errors.per_barangay ? this.errors.per_barangay[0] : ''">
                                        <b-select v-model="fields.per_barangay" expanded placeholder="Barangay">
                                            <option v-for="(item, index) in perBarangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Street" label-position="on-border">
                                        <b-input type="text" v-model="fields.per_street"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="House/Block No" label-position="on-border">
                                        <b-input type="text" v-model="fields.per_houseno_blockno"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Zip Code" label-position="on-border">
                                        <b-input type="text" v-model="fields.per_zipcode"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Tel No."
                                             :type="this.errors.tel_no ? 'is-danger':''"
                                             :message="this.errors.tel_no ? this.errors.tel_no[0] : ''">
                                        <b-input type="text" v-model="fields.tel_no" icon="email" placeholder="Tel No."></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Contact No."
                                             :type="this.errors.contact_no ? 'is-danger':''"
                                             :message="this.errors.contact_no ? this.errors.contact_no[0] : ''">
                                        <b-input type="text" v-model="fields.contact_no" icon=""></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Email"
                                             :type="this.errors.email ? 'is-danger':''"
                                             :message="this.errors.email ? this.errors.email[0] : ''">
                                        <b-input type="email" v-model="fields.email" icon="email"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="separator">
                                FAMILY BACKGROUND
                            </div>

                            <div class="columns" v-if="fields.civil_status === 'MARRIED'">
                                <div class="column">
                                    <b-field label="Spouse Surname" label-position="on-border"
                                         :type="this.errors.spouse_surname ? 'is-danger':''"
                                         :message="this.errors.spouse_surname ? this.errors.spouse_surname[0] : ''">
                                        <b-input type="text" v-model="fields.spouse_surname" placeholder="Spouse Surname" icon="account"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Spouse First Name" label-position="on-border"
                                         :type="this.errors.spouse_fname ? 'is-danger':''"
                                         :message="this.errors.spouse_fname ? this.errors.spouse_fname[0] : ''">
                                        <b-input type="text" v-model="fields.spouse_fname" placeholder="Spouse First Name" icon="account"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns" v-if="fields.civil_status === 'MARRIED'">
                                <div class="column is-8">
                                    <b-field label="Spouse Middle Name" label-position="on-border"
                                             :type="this.errors.spouse_mname ? 'is-danger':''"
                                             :message="this.errors.spouse_mname ? this.errors.spouse_mname[0] : ''">
                                        <b-input type="text" v-model="fields.spouse_mname" placeholder="Spouse Middle Name" icon="account"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Spouse Suffix" label-position="on-border"
                                             :type="this.errors.spouse_suffix ? 'is-danger':''"
                                             :message="this.errors.spouse_suffix ? this.errors.spouse_suffix[0] : ''">
                                        <b-input type="text" v-model="fields.spouse_suffix" placeholder="Spouse Suffix" icon="account"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Employer/Business Name" label-position="on-border"
                                             :type="this.errors.business_name ? 'is-danger':''"
                                             :message="this.errors.business_name ? this.errors.business_name[0] : ''">
                                        <b-input type="text" v-model="fields.business_name" placeholder="Employer/Business Name" icon="account"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Business Address" label-position="on-border"
                                             :type="this.errors.business_address ? 'is-danger':''"
                                             :message="this.errors.business_address ? this.errors.business_address[0] : ''">
                                        <b-input type="text" v-model="fields.business_address" placeholder="Business Address" icon="account"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Contact No." label-position="on-border"
                                             :type="this.errors.business_contact_no ? 'is-danger':''"
                                             :message="this.errors.business_contact_no ? this.errors.business_contact_no[0] : ''">
                                        <b-input type="text" v-model="fields.business_contact_no" placeholder="Contact No." icon="account"></b-input>
                                    </b-field>
                                </div>
                            </div>


                            <!--FATHER INFORMATION-->
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Father Surname" label-position="on-border"
                                             :type="this.errors.father_surname ? 'is-danger':''"
                                             :message="this.errors.father_surname ? this.errors.father_surname[0] : ''">
                                        <b-input type="text" v-model="fields.father_surname" placeholder="Father Surname" icon="account"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Father First Name" label-position="on-border"
                                             :type="this.errors.father_fname ? 'is-danger':''"
                                             :message="this.errors.father_fname ? this.errors.father_fname[0] : ''">
                                        <b-input type="text" v-model="fields.father_fname" placeholder="Father First Name" icon="account"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-8">
                                    <b-field label="Father Middle Name" label-position="on-border"
                                             :type="this.errors.father_mname ? 'is-danger':''"
                                             :message="this.errors.father_mname ? this.errors.father_mname[0] : ''">
                                        <b-input type="text" v-model="fields.father_mname" placeholder="Father Middle Name" icon="account"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Father Suffix" label-position="on-border"
                                             :type="this.errors.father_suffix ? 'is-danger':''"
                                             :message="this.errors.father_suffix ? this.errors.father_suffix[0] : ''">
                                        <b-input type="text" v-model="fields.father_suffix" placeholder="Father Suffix" icon="account"></b-input>
                                    </b-field>
                                </div>
                            </div>


                            <!--MOTHER INFORMATION-->
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Mother Maiden Name" label-position="on-border"
                                             :type="this.errors.mother_maiden_name ? 'is-danger':''"
                                             :message="this.errors.mother_maiden_name ? this.errors.mother_maiden_name[0] : ''">
                                        <b-input type="text" v-model="fields.mother_maiden_name" placeholder="Mothers Maiden Name" icon="account"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Mother First Name" label-position="on-border"
                                             :type="this.errors.mother_fname ? 'is-danger':''"
                                             :message="this.errors.mother_fname ? this.errors.mother_fname[0] : ''">
                                        <b-input type="text" v-model="fields.mother_fname" placeholder="Mother First Name" icon="account"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-8">
                                    <b-field label="Mother Middle Name" label-position="on-border"
                                             :type="this.errors.mother_mname ? 'is-danger':''"
                                             :message="this.errors.mother_mname ? this.errors.mother_mname[0] : ''">
                                        <b-input type="text" v-model="fields.mother_mname" placeholder="Mother Middle Name" icon="account"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Mother Suffix" label-position="on-border"
                                             :type="this.errors.mother_suffix ? 'is-danger':''"
                                             :message="this.errors.mother_suffix ? this.errors.mother_suffix[0] : ''">
                                        <b-input type="text" v-model="fields.mother_suffix" placeholder="Father Suffix" icon="account"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <h2><span>CHILDREN</span></h2>
                            <div class="table-form-container" v-for="(item, k) in this.fields.children" :key="`child${k}`">
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Fullname" label-position="on-border">
                                            <b-input type="text" v-model="item.fullname" placeholder="Fullname" required></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Date of Birth (mm/dd/yyyy)" label-position="on-border">
                                            <b-datepicker editable v-model="item.date_birth"
                                                          placeholder="Date Birth" required> </b-datepicker>
                                            
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <div class="buttons is-right">
                                            <b-button @click="removeChild(k)" v-show="k || ( !k && fields.children.length > 0)" 
                                                type="is-danger" icon-left="delete"
                                                class="is-small"></b-button>
                                        </div>
                                    </div>
                                </div><!--cols-->
                            </div>
                            <div class="buttons">
                                <b-button @click="addChild" type="is-success mb-4 mt-4" class="is-small" icon-left="plus">ADD</b-button>
                            </div>



                            <div class="separator">
                                EDUCATIONAL BACKGROUND
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="table-form-container" v-for="(item, k) in fields.educational_backgrounds" :key="`ed${k}`">
                                        <div class="columns">
                                            <div class="column">
                                                <b-field label="Level" expanded label-position="on-border">
                                                    <b-select v-model="item.level" placeholder="Level" required expanded>
                                                        <option value="ELEMENTARY">ELEMENTARY</option>
                                                        <option value="SECONDARY">SECONDARY</option>
                                                        <option value="VOCATIONAL/TRADE COURSE">VOCATIONAL/TRADE COURSE</option>
                                                        <option value="COLLEGE">COLLEGE</option>
                                                        <option value="GRADUATE STUDIES">GRADUATE STUDIES</option>
                                                    </b-select>
                                                </b-field>
                                            </div>
                                           <div class="column">
                                                <b-field label="Name of School" label-position="on-border">
                                                    <b-input type="text" v-model="item.name_of_school" placeholder="Name of School" required></b-input>
                                                </b-field>
                                           </div>
                                        </div><!--cols-->
                                        <div class="columns">
                                            <div class="column is-8">
                                                <b-field label="Degree" label-position="on-border">
                                                    <b-input type="text" v-model="item.degree" placeholder="Degree" required></b-input>
                                                </b-field>
                                            </div>
                                            <div class="column is-4">
                                                <b-field label="Period of Attendance From/To" label-position="on-border">
                                                    <b-input type="text" v-model="item.period_att_from" placeholder="From"></b-input>
                                                    <b-input type="text" v-model="item.period_att_to" placeholder="To"></b-input>
                                                </b-field>
                                            </div>
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <b-field label="Heighest Unit Earned" label-position="on-border">
                                                    <b-input type="text" v-model="item.highest_level_unit" placeholder="Unit Earned"></b-input>
                                                </b-field>
                                            </div>
                                            <div class="column">
                                                <b-field label="Year Graudated" label-position="on-border">
                                                    <b-input type="text" v-model="item.year_graduated" placeholder="Year Graduated"></b-input>
                                                </b-field>
                                            </div>
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <b-field label="Scholarship" expanded label-position="on-border">
                                                    <b-input type="text" v-model="item.scholarship" placeholder="Scholarship"></b-input>
                                                </b-field>
                                            </div>
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <div class="buttons is-right">
                                                    <b-button @click="removeEducationalBackground(k)" 
                                                        v-show="k || ( !k && fields.educational_backgrounds.length > 0)"
                                                        class="is-small"
                                                        type="is-danger" icon-left="delete"></b-button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="buttons">
                                        <b-button @click="addEducationalBackground" type="is-success mb-4 mt-4" class="is-small" icon-left="plus">ADD</b-button>
                                    </div>
                                </div><!--column parent-->
                            </div> <!--columns -->


                        </b-step-item>

                        <b-step-item step="2" label="CSE" :clickable="isStepsClickable" :type="{'is-success': isProfileSuccess}">
                            <div class="separator">Civil Sevice Eligibility</div>
                            <div class="columns">
                                <div class="column">
                                    <div class="table-form-container" v-for="(item, k) in this.fields.eligibilities" :key="`eligible${k}`">
                                        <div class="columns">
                                            <div class="column">
                                                <b-field label="Fullname" label-position="on-border">
                                                    <b-input type="text" v-model="item.career_exam" placeholder="Career Exam" required></b-input>
                                                </b-field>
                                            </div>
                                            <div class="column is-4">
                                                <b-field label="Rating" label-position="on-border">
                                                    <b-numberinput controls-alignment="right"
                                                        type="text"
                                                        step="0.01"
                                                        v-model="item.rating"></b-numberinput>
                                                </b-field>
                                            </div>
                                        </div><!--cols-->
                                        <div class="columns">
                                            <div class="column">
                                                <b-field label="Date of Exam (mm/dd/yyyy)" label-position="on-border">
                                                    <b-datepicker editable v-model="item.date_exam"
                                                                  placeholder="Date of Exam" required> </b-datepicker>
                                                </b-field>
                                            </div>
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <b-field label="Place of Examination" label-position="on-border">
                                                    <b-input type="text" v-model="item.place_exam" placeholder="Place of Examination"></b-input>
                                                </b-field>
                                            </div>
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <b-field label="License No." label-position="on-border">
                                                    <b-input type="text" v-model="item.license_no" placeholder="License No."></b-input>
                                                </b-field>
                                            </div>
                                            <div class="column">
                                                <b-field label="License Validity" expanded label-position="on-border">
                                                    <b-input type="text" expanded v-model="item.license_validity" placeholder="License Validity"></b-input>
                                                </b-field>
                                            </div>
                                        </div>

                                        <div class="buttons is-right">
                                            <b-button @click="removeEligibility(k)" 
                                                v-show="k || ( !k && fields.eligibilities.length > 0)"
                                                class="is-small"
                                                type="is-danger" 
                                                icon-left="delete"></b-button>
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <b-button @click="addEligibility" type="is-success mb-4 mt-4" class="is-small" icon-left="plus">ADD</b-button>
                                    </div>
                                </div><!--column parent-->
                            </div> <!--columns -->


                            <div class="separator">Work Experience</div>
                            <div class="columns">
                                <div class="column">
                                    <div class="table-form-container" v-for="(item, k) in fields.work_experiences" :key="`work${k}`">
                                        <div class="columns">
                                            <div class="column">
                                                <b-field label="Experience From/To" label-position="on-border">
                                                    <b-datepicker editable v-model="item.work_ex_from"
                                                                  placeholder="From" required> </b-datepicker>
                                                    <b-datepicker editable v-model="item.work_ex_to"
                                                                  placeholder="To" required> </b-datepicker>
                                                </b-field>
                                            </div>
                                            <div class="column">
                                                <b-field label="Position/Title" label-position="on-border">
                                                    <b-input type="text" v-model="item.position_title" placeholder="Position/Title"></b-input>
                                                </b-field>
                                            </div>
                                        </div><!--cols-->
                                        <div class="columns">
                                            <div class="column">
                                                <b-field label="Department Agency" label-position="on-border">
                                                    <b-input type="text" v-model="item.department_agency" placeholder="Department Agency"></b-input>
                                                </b-field>
                                            </div>
                                            <div class="column is-4">
                                                <b-field label="Salary" label-position="on-border">
                                                    <b-input type="text" v-model="item.salary" placeholder="Salary"></b-input>
                                                </b-field>
                                            </div>
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <b-field label="Pay Grade" label-position="on-border">
                                                    <b-input type="text" v-model="item.pay_grade" placeholder="Pay Grade"></b-input>
                                                </b-field>
                                            </div>
                                            <div class="column">
                                                <b-field label="Status Appointment" expanded label-position="on-border">
                                                    <b-input type="text" expanded v-model="item.status_appointment" placeholder="Status Appointment"></b-input>
                                                </b-field>
                                            </div>
                                            <div class="column">
                                                <b-field label="Gov't Service" expanded label-position="on-border">
                                                    <b-select  expanded v-model="item.is_govt" placeholder="Gov't Service">
                                                        <option value="1">YES</option>
                                                        <option value="0">NO</option>
                                                    </b-select>
                                                </b-field>
                                            </div>
                                        </div>

                                        <div class="buttons is-right">
                                            <b-button @click="removeWorkExperience(k)" 
                                                v-show="k || ( !k && fields.work_experiences.length > 0)"
                                                type="is-danger"
                                                class="is-small"
                                                icon-left="delete"></b-button>
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <b-button @click="addWorkExperience" type="is-success mb-4 mt-4" class="is-small" icon-left="plus">ADD</b-button>
                                    </div>
                                </div><!--column parent-->
                            </div> <!--columns -->

                        </b-step-item>

                        <b-step-item step="3" label="Voluntary Work" :clickable="isStepsClickable">
                            <div class="separator">
                                Voluntary Work or Involvment in Civic / Non-Gov't / People / Voluntary Org
                            </div>
                            <div class="table-form-container" v-for="(item, k) in fields.voluntary_works" :key="`voluntary${k}`">
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Name & Address of Organization" label-position="on-border">
                                            <b-input type="text" v-model="item.name_address_org" placeholder="Name & Address of Organization"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Inclusive Dates" label-position="on-border">
                                            <b-input type="text" v-model="item.work_from" placeholder="From"></b-input>
                                            <b-input type="text" v-model="item.work_to" placeholder="To"></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="No. of hours" label-position="on-border">
                                            <b-input type="text" v-model="item.no_hours" placeholder="No. of hours"></b-input>
                                        </b-field>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Position/Nature of Work" expanded label-position="on-border">
                                            <b-input type="text" v-model="item.nature_work" expanded placeholder="Position/Nature of Works"></b-input>
                                        </b-field>
                                    </div>
                                </div>
                                <div class="buttons is-right">
                                    <b-button @click="removeVoluntaryWork(k)" 
                                        v-show="k || ( !k && fields.work_experiences.length > 0)"
                                        type="is-danger"
                                        class="is-small"
                                        icon-left="delete"></b-button>
                                </div>
                            </div>

                            <div class="buttons">
                                <b-button @click="addVoluntaryWork" type="is-success mb-4 mt-4" class="is-small" icon-left="plus">ADD</b-button>
                            </div>

                            <!-- Learning Dev -->
                            <div class="separator">
                                Learning and Development Inventions / Trainings / Programs Attended
                            </div>

                            <div class="table-form-container" v-for="(item, index) in fields.learning_developments" :key="`ld${index}`">
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Title of Learning Development (Write Full)" label-position="on-border">
                                            <b-input type="text" v-model="item.title_learning_dev" placeholder="Title of Learning Development (Write Full)"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Inclusive Dates (Attendance)" label-position="on-border">
                                            <b-datepicker v-model="item.date_from" editable placeholder="From"></b-datepicker>
                                            <b-datepicker v-model="item.date_to" editable placeholder="To"></b-datepicker>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="No. of hours" label-position="on-border">
                                            <b-input type="text" v-model="item.no_hours" placeholder="No. of hours"></b-input>
                                        </b-field>
                                    </div>
                                </div>
                                <div class="columns">

                                    <div class="column">
                                        <b-field label="Type Learning Development" label-position="on-border">
                                            <b-input type="text" v-model="item.type_ld"
                                                placeholder="Type Learning Development">
                                            </b-input>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Conducted / Sponsored By" expanded label-position="on-border">
                                            <b-input type="text" v-model="item.sponsored_by" expanded placeholder="Conducted / Sponsored By"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="buttons is-right">
                                    <b-button @click="removeLearningDevelopment(index)" 
                                        v-show="index || ( !index && fields.learning_developments.length > 0)"
                                        class="is-small"
                                        type="is-danger"
                                        icon-left="delete">
                                    </b-button>
                                </div>
                            </div>

                            <div class="buttons">
                                <b-button @click="addLearningDevelopment" 
                                    type="is-success mb-4 mt-4" 
                                    class="is-small" icon-left="plus">ADD</b-button>
                            </div>


                            <!-- OTHER -->
                            <div class="separator">
                                Other Information
                            </div>

                            <div class="table-form-container" v-for="(item, k) in fields.other_informations" :key="`info${k}`">
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Specialization" label-position="on-border">
                                            <b-input type="text" v-model="item.skill_hobbies"
                                                placeholder="Special Skill & Hobbies">
                                            </b-input>
                                        </b-field>

<!--                                        <b-field label="" label-position="on-border">-->
<!--                                            <b-input type="text" v-model="item.skill_hobbies" placeholder="Special Skill & Hobbies (Write Full)"></b-input>-->
<!--                                        </b-field>-->
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Non-Academic Distinctions / Recognition (Write Full)" label-position="on-border">
                                            <b-input type="text" v-model="item.non_academic_distinction" placeholder="Non-Academic Distinctions / Recognition (Write Full)"></b-input>
                                        </b-field>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <b-field expanded label="Membership in Association / Organization (Write Full)" label-position="on-border">
                                            <b-input type="text" expanded v-model="item.member_association" placeholder="Membership in Association / Organization (Write Full)"></b-input>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="buttons is-right">
                                    <b-button @click="removeOtherInformation(k)" 
                                        v-show="k || ( !k && fields.other_informations.length > 0)"
                                        class="is-small"
                                        type="is-danger"
                                        icon-left="delete"></b-button>
                                </div>
                            </div>
                            <div class="buttons">
                                <b-button @click="addOtherInformation" type="is-success mb-4 mt-4" class="is-small" icon-left="plus">ADD</b-button>
                            </div>
                        </b-step-item>

                        <b-step-item step="4" label="Other" :clickable="isStepsClickable">

                            <div class="columns">
                                <div class="column">
                                    <div>
                                        Are you related by consanguinity or affinity to the appointing or recommending authority, or to the chief of bureau or office or to the person who has immediate supervision over you in the Office, Bureau or Department where you will be apppointed,
                                    </div>
                                </div>
                                <div class="column is-4">
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    a. within the third degree?
                                </div>
                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1" name="related_with_third_degree" v-model="fields.related_with_third_degree">Yes</b-radio>
                                        <b-radio native-value="0" name="related_with_third_degree" v-model="fields.related_with_third_degree">No</b-radio>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    b. within the fourth degree (for Local Government Unit - Career Employees
                                </div>
                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1" name="related_with_fourth_degree" v-model="fields.related_with_fourth_degree">Yes</b-radio>
                                        <b-radio native-value="0" name="related_with_fourth_degree" v-model="fields.related_with_fourth_degree">No</b-radio>
                                    </b-field>
                                    <b-field label="If YES, details" label-position="on-border">
                                        <b-input type="text" v-model="fields.related_with_fourth_degree_yes" placeholder="Details"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="divider-gray"></div>

                            <div class="columns">
                                <div class="column">
                                    Have you ever been found guilty of any administrative offense?
                                </div>

                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1"
                                            name="is_guilty_administrative_offense"
                                            v-model="fields.is_guilty_administrative_offense">Yes</b-radio>
                                        <b-radio native-value="0"
                                            name="is_guilty_administrative_offense"
                                            v-model="fields.is_guilty_administrative_offense">No</b-radio>
                                    </b-field>
                                    <b-field label="If YES, details" label-position="on-border">
                                        <b-input type="text" v-model="fields.is_guilty_administrative_offense_yes" placeholder="Details"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    Have you been criminally charged before any court?
                                </div>

                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1"
                                            name="is_criminally_charge"
                                            v-model="fields.is_criminally_charge">Yes</b-radio>
                                        <b-radio native-value="0"
                                            name="is_criminally_charge"
                                            v-model="fields.is_criminally_charge">No</b-radio>
                                    </b-field>
                                    <b-field label="If YES, details" label-position="on-border">
                                        <b-input type="text" v-model="fields.is_criminally_charge_yes" placeholder="Details"></b-input>
                                    </b-field>
                                    <b-field label="Date Filed" label-position="on-border">
                                        <b-input type="text" v-model="fields.date_filed" placeholder="Date FIled"></b-input>
                                    </b-field>
                                    <b-field label="Status of the case" label-position="on-border">
                                        <b-input type="text" v-model="fields.case_status" placeholder="Status of the case"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="divider-gray"></div>

                            <div class="columns">
                                <div class="column">
                                    Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?
                                </div>
                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1"
                                            name="is_convicted"
                                            v-model="fields.is_convicted">Yes</b-radio>
                                        <b-radio native-value="0"
                                            name="is_convicted"
                                            v-model="fields.is_convicted">No</b-radio>
                                    </b-field>
                                    <b-field label="If YES, details" label-position="on-border">
                                        <b-input type="text" v-model="fields.is_convicted_yes" placeholder="Details"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="divider-gray"></div>

                            <div class="columns">
                                <div class="column">
                                    Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?
                                </div>
                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1"
                                            name="is_separated"
                                            v-model="fields.is_separated">Yes</b-radio>
                                        <b-radio native-value="0"
                                            name="is_separated"
                                            v-model="fields.is_separated">No</b-radio>
                                    </b-field>
                                    <b-field label="If YES, details" label-position="on-border">
                                        <b-input type="text" v-model="fields.is_separated_yes_details" placeholder="Details"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="divider-gray"></div>

                            <div class="columns">
                                <div class="column">
                                    Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?
                                </div>

                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1"
                                            name="is_candidate_election"
                                            v-model="fields.is_candidate_election">Yes</b-radio>
                                        <b-radio native-value="0"
                                            name="is_candidate_election"
                                            v-model="fields.is_candidate_election">No</b-radio>
                                    </b-field>
                                    <b-field label="If YES, details" label-position="on-border">
                                        <b-input type="text" v-model="fields.is_candiadte_election_yes" placeholder="Details"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?
                                </div>
                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1"
                                            name="is_resigned"
                                            v-model="fields.is_resigned">Yes</b-radio>
                                        <b-radio native-value="0"
                                            name="is_resigned"
                                            v-model="fields.is_resigned">No</b-radio>
                                    </b-field>
                                    <b-field label="If YES, details" label-position="on-border">
                                        <b-input type="text" v-model="fields.is_resigned_yes" placeholder="Details"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="divider-gray"></div>

                            <div class="columns">
                                <div class="column">
                                    Have you acquired the status of an immigrant or permanent resident of another country?
                                </div>
                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1"
                                            name="is_immigrant"
                                            v-model="fields.is_immigrant">Yes</b-radio>
                                        <b-radio native-value="0"
                                            name="is_immigrant"
                                            v-model="fields.is_immigrant">No</b-radio>
                                    </b-field>
                                    <b-field label="If YES, details(country)" label-position="on-border">
                                        <b-input type="text" v-model="fields.is_immigrant_yes" placeholder="Details"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="divider-gray"></div>

                            <div class="columns">
                                <div class="column">
                                    Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:
                                </div>
                                <div class="column is-4"></div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    Are you a member of any indigenous group?
                                </div>
                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1"
                                            name="is_indigenous"
                                            v-model="fields.is_indigenous">Yes</b-radio>
                                        <b-radio native-value="0"
                                            name="is_indigenous"
                                            v-model="fields.is_indigenous">No</b-radio>
                                    </b-field>
                                    <b-field label="If YES, details" label-position="on-border">
                                        <b-input type="text" v-model="fields.is_indigenous_yes" placeholder="Details"></b-input>
                                    </b-field>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    Are you a person with disability?
                                </div>
                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1"
                                            name="is_disable"
                                            v-model="fields.is_disable">Yes</b-radio>
                                        <b-radio native-value="0"
                                            name="is_disable"
                                            v-model="fields.is_disable">No</b-radio>
                                    </b-field>
                                    <b-field label="If YES, ID No." label-position="on-border">
                                        <b-input type="text" v-model="fields.is_disable_id_no" placeholder="Details"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    Are you a solo parent?
                                </div>
                                <div class="column is-4">
                                    <b-field>
                                        <b-radio native-value="1"
                                            name="is_solo_parent"
                                            v-model="fields.is_solo_parent">Yes</b-radio>
                                        <b-radio native-value="0"
                                            name="is_solo_parent"
                                            v-model="fields.is_solo_parent">No</b-radio>
                                    </b-field>
                                    <b-field label="If YES, ID No." label-position="on-border">
                                        <b-input type="text" v-model="fields.is_solo_parent_yes" placeholder="Details"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="divider-gray"></div>
                        </b-step-item>


                        <template
                            v-if="customNavigation"
                            #navigation="{previous, next}">
                            <b-button
                                outlined
                                type="is-danger"
                                icon-pack="fas"
                                icon-left="backward"
                                :disabled="previous.disabled"
                                @click.prevent="previous.action">
                                Previous
                            </b-button>
                            <b-button
                                outlined
                                type="is-success"
                                icon-pack="fas"
                                icon-right="forward"
                                :disabled="next.disabled"
                                @click.prevent="next.action">
                                Next
                            </b-button>
                        </template>
                    </b-steps>

                    <div class="columns mt-5">
                        <div class="column">
                            <div class="buttons is-left">
                                <b-button @click="printMe" class="button is-primary is-outlined"
                                    icon-left="printer">Print</b-button>
                            </div>
                        </div>
                        <div class="column">
                            <div class="buttons is-right">
                                <b-button @click="submit" class="button is-primary">Update Information</b-button>
                            </div>
                        </div>
                    </div>
                    

                </div> <!--panel-->


            </div><!--column-->
        </div><!--cols-->
    </section>
</template>

<script>
export default {

    props: ['propCivils', 'propCitizenships', 'propData'],

    data(){
        return{
            user: {},

            activeStep: 0,

            showSocial: false,
            isAnimated: true,
            isRounded: true,
            isStepsClickable: true,

            hasNavigation: true,
            customNavigation: false,
            isProfileSuccess: false,

            prevIcon: 'chevron-left',
            nextIcon: 'chevron-right',
            labelPosition: 'bottom',
            mobileMode: 'minimalist',

            fields: {
                civil_status: '',
                educational_backgrounds: [],
                children: [],
                eligibilities: [],
                work_experiences: [],
                voluntary_works: [],
                learning_developments: [],
                other_informations: [],
            },


            errors: {},

            civilStatuses: [],
            citizenships: [],

            resProvinces: [],
            resCities: [],
            resBarangays: [],

            perProvinces: [],
            perCities: [],
            perBarangays: [],

            learning_developments: [],
            specializations: [],
        }
    },
    methods: {
        //ADDRESS
        loadProvince: function(){
            axios.get('/load-provinces').then(res=>{
                this.resProvinces = res.data;
                this.perProvinces = res.data;

                this.initData();
            })
        },
        loadResCity: function(){
            axios.get('/load-cities?prov=' + this.fields.res_province).then(res=>{
                this.resCities = res.data;
            })
        },

        loadResBarangay: function(){
            axios.get('/load-barangays?prov=' + this.fields.res_province + '&city_code='+this.fields.res_city).then(res=>{
                this.resBarangays = res.data;
            })
        },
        loadPerCity: function(){
            axios.get('/load-cities?prov=' + this.fields.per_province).then(res=>{
                this.perCities = res.data;
            })
        },

        loadPerBarangay: function(){
            axios.get('/load-barangays?prov=' + this.fields.per_province + '&city_code='+this.fields.per_city).then(res=>{
                this.perBarangays = res.data;
            })
        },

        initData(){

            this.civilStatuses = JSON.parse(this.propCivils);
            this.citizenships = JSON.parse(this.propCitizenships);


            this.user = JSON.parse(this.propData);
            //console.log(this.user)

            this.fields.surname = this.user.lname;
            this.fields.fname = this.user.fname;
            this.fields.mname = this.user.mname;
            this.fields.suffix = this.user.suffix;
            this.fields.sex = this.user.sex;
            this.fields.school_assigned = this.user.school_assigned;
            this.fields.date_birth = new Date(this.user.date_birth);
            this.fields.place_birth = this.user.place_birth;
            this.fields.civil_status = this.user.civil_status;
            this.fields.height = this.user.height;
            this.fields.weight = this.user.weight;
            this.fields.blood_type = this.user.blood_type;
            this.fields.gsis = this.user.gsis;
            this.fields.pagibig = this.user.pagibig;
            this.fields.philhealth = this.user.philhealth;
            this.fields.sss = this.user.sss;
            this.fields.tin = this.user.tin;
            this.fields.agency_idno = this.user.agency_idno;
            this.fields.citizenship = this.user.citizenship;

            //spouse
            this.fields.spouse_surname = this.user.spouse_surname;
            this.fields.spouse_fname = this.user.spouse_fname;
            this.fields.spouse_mname = this.user.spouse_mname;
            this.fields.spouse_suffix = this.user.spouse_suffix;
            //businees
            this.fields.business_name = this.user.business_name;
            this.fields.business_address = this.user.business_address;
            this.fields.business_contact_no = this.user.business_contact_no;

            //father
            this.fields.father_surname = this.user.father_surname;
            this.fields.father_fname = this.user.father_fname;
            this.fields.father_mname = this.user.father_mname;
            this.fields.father_suffix = this.user.father_suffix;

            //mother
            this.fields.mother_maiden_name = this.user.mother_maiden_name;
            this.fields.mother_fname = this.user.mother_fname;
            this.fields.mother_mname = this.user.mother_mname;
            this.fields.mother_suffix = this.user.mother_suffix;


            //nested axios for getting the address 1 by 1 or request by request
            //load city first
            //residential address
            axios.get('/load-cities?prov=' + this.user.res_province).then(res=>{
                //load barangay
                this.fields.res_province = this.user.res_province;
                this.resCities = res.data;
                this.fields.res_city = this.user.res_city;
                axios.get('/load-barangays?prov=' + this.user.res_province + '&city_code='+this.user.res_city).then(res=>{
                    this.resBarangays = res.data;
                    this.fields.res_barangay = this.user.res_barangay;
                    this.fields.res_street = this.user.res_street;
                    this.fields.res_houseno_blockno = this.user.res_houseno_blockno;
                    this.fields.res_zipcode = this.user.res_zipcode;
                });
            });

            //permanent address
            axios.get('/load-cities?prov=' + this.user.per_province).then(res=>{
                //load barangay
                this.fields.per_province = this.user.per_province;
                this.perCities = res.data;
                this.fields.per_city = this.user.per_city;
                axios.get('/load-barangays?prov=' + this.user.per_province + '&city_code='+this.user.per_city).then(res=>{
                    this.perBarangays = res.data;
                    this.fields.per_barangay = this.user.per_barangay;
                    this.fields.per_street = this.user.per_street;
                    this.fields.per_houseno_blockno = this.user.per_houseno_blockno;
                    this.fields.per_zipcode = this.user.per_zipcode;
                });
            });

            this.fields.tel_no = this.user.tel_no;
            this.fields.contact_no = this.user.contact_no;
            this.fields.email = this.user.email;




            this.user.children.forEach(child=>{
                this.fields.children.push({
                    child_id: child.child_id,
                    user_id: child.user_id,
                    fullname: child.fullname,
                    date_birth: new Date(child.child_bdate)
                });
            })
            this.user.educational_backgrounds.forEach(ed=>{
                this.fields.educational_backgrounds.push({
                    ed_bg_id: ed.ed_bg_id,
                    level: ed.level,
                    name_of_school: ed.name_of_school,
                    degree: ed.degree,
                    period_att_from: ed.period_att_from,
                    period_att_to: ed.period_att_to,
                    highest_level_unit: ed.highest_level_unit,
                    year_graduated: ed.year_graduated,
                    scholarship: ed.scholarship
                });
            })

            this.user.eligibilities.forEach(el=>{
                this.fields.eligibilities.push({
                    cse_id: el.cse_id,
                    user_id: el.user_id,
                    career_exam: el.career_exam,
                    rating: parseFloat(el.rating),
                    date_exam: new Date(el.date_exam),
                    place_exam: el.place_exam,
                    license_no: el.license_no,
                    license_validity: el.license_validity,
                });
            })
            this.user.work_experiences.forEach(work=>{
                this.fields.work_experiences.push({
                    work_ex_id: work.work_ex_id,
                    work_ex_from: new Date(work.work_ex_from),
                    work_ex_to: new Date(work.work_ex_to),
                    position_title: work.position_title,
                    department_agency: work.department_agency,
                    salary: work.salary,
                    pay_grade: work.pay_grade,
                    status_appointment: work.status_appointment,
                    is_govt: work.is_govt
                });
            })
            this.user.voluntary_works.forEach(v => {
                this.fields.voluntary_works.push({
                    voluntary_work_id: v.voluntary_work_id,
                    name_address_org: v.name_address_org,
                    work_from: v.work_from,
                    work_to: v.work_to,
                    no_hours: v.no_hours,
                    nature_work: v.nature_work,
                });
            })
            this.user.learning_developments.forEach(learning => {
                this.fields.learning_developments.push({
                    learning_dev_id: learning.learning_dev_id,
                    title_learning_dev: learning.title_learning_dev,
                    date_from: new Date(learning.date_from),
                    date_to: new Date(learning.date_to),
                    no_hours: learning.no_hours,
                    type_ld: learning.type_ld,
                    sponsored_by: learning.sponsored_by,
                });
            })

            this.user.other_informations.forEach(info => {
                this.fields.other_informations.push({
                    other_info_id: info.other_info_id,
                    skill_hobbies: info.skill_hobbies,
                    non_academic_distinction: info.non_academic_distinction,
                    member_association: info.member_association,
                });
            })

            //page 4 PDS
            this.fields.related_with_third_degree = this.user.related_with_third_degree;
            this.fields.related_with_fourth_degree = this.user.related_with_fourth_degree;
            this.fields.related_with_fourth_degree_yes = this.user.related_with_fourth_degree_yes;
            this.fields.is_guilty_administrative_offense = this.user.is_guilty_administrative_offense;
            this.fields.is_guilty_administrative_offense_yes = this.user.is_guilty_administrative_offense_yes;
            this.fields.is_criminally_charge = this.user.is_criminally_charge;
            this.fields.is_criminally_charge_yes = this.user.is_criminally_charge_yes;
            this.fields.date_filed = this.user.date_filed;
            this.fields.case_status = this.user.case_status;
            this.fields.is_convicted = this.user.is_convicted;
            this.fields.is_convicted_yes = this.user.is_convicted_yes;
            this.fields.is_separated = this.user.is_separated;
            this.fields.is_separated_yes_details = this.user.is_separated_yes_details;
            this.fields.is_candidate_election = this.user.is_candidate_election;
            this.fields.is_candiadte_election_yes = this.user.is_candiadte_election_yes;
            this.fields.is_resigned = this.user.is_resigned;
            this.fields.is_resigned = this.user.is_resigned;
            this.fields.is_resigned_yes = this.user.is_resigned_yes;
            this.fields.is_immigrant_yes = this.user.is_immigrant_yes;
            this.fields.is_indigenous = this.user.is_indigenous;
            this.fields.is_indigenous_yes = this.user.is_indigenous_yes;
            this.fields.is_disable = this.user.is_disable;
            this.fields.is_disable_id_no = this.user.is_disable_id_no;
            this.fields.is_solo_parent = this.user.is_solo_parent;
            this.fields.is_solo_parent_yes = this.user.is_solo_parent_yes;

        },

        submit(){

            //formData.append('fields', this.fields);
            axios.post('/personal-data-sheet-update/' + this.user.user_id, this.fields).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: "UPDATED!",
                        message: 'Profile updated successfully',
                        type: 'is-success',
                        onConfirm: ()=>  window.location = '/faculty/personal-data-sheet'
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


        addChild() {
            this.fields.children.push({
                child_id: 0,
                user_id: 0,
                fullname: '',
                date_birth: null,
            });
        },
        removeChild(index){
            //alert(index);
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to delete this information?',

                onConfirm: ()=>{
                    let childId = this.fields.children[index].child_id;

                    if(childId > 0){
                        axios.delete('/faculty/children/' + childId).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.toast.open({
                                    message: `Child deleted successfully.`,
                                    type: 'is-primary'
                                })
                            }
                        });
                    }

                    this.fields.children.splice(index, 1);
                }
            });
        },

        addEducationalBackground() {
            this.fields.educational_backgrounds.push({
                ed_bg_id: 0,
                level: '',
                name_of_school: '',
                degree: '',
                period_att_from: '',
                period_att_to: '',
                highest_level_unit: '',
                year_graduated: '',
                scholarship: ''
            });
        },
        removeEducationalBackground(index){
            //alert(index);
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to delete this information?',

                onConfirm: ()=>{
                    let id = this.fields.educational_backgrounds[index].ed_bg_id;

                    if(id > 0){
                        axios.delete('/educational-backgrounds/' + id).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.toast.open({
                                    message: `Educational background deleted successfully.`,
                                    type: 'is-primary'
                                })
                            }
                        });
                    }

                    this.fields.educational_backgrounds.splice(index, 1);
                }
            });
        },

        addEligibility() {
            this.fields.eligibilities.push({
                cse_id: 0,
                user_id: 0,
                career_exam: '',
                rating: 0,
                date_exam: null,
                place_exam: '',
                license_no: '',
                license_validity: '',
            });
        },
        removeEligibility(index){
            //alert(index);
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to delete this information?',

                onConfirm: ()=>{
                    let cse_id = this.fields.eligibilities[index].cse_id;

                    if(cse_id > 0){
                        axios.delete('/eligibilities/' + cse_id).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.toast.open({
                                    message: `Eligibility deleted successfully.`,
                                    type: 'is-primary'
                                })
                            }
                        });
                    }

                    this.fields.eligibilities.splice(index, 1);
                }
            });
        },


        addWorkExperience() {
            this.fields.work_experiences.push({
                work_ex_id: 0,
                work_ex_from: null,
                work_ex_to: null,
                position_title: '',
                department_agency: '',
                salary: '',
                pay_grade: '',
                status_appointment: '',
                is_govt: 0,
            });
        },
        removeWorkExperience(index){
            //alert(index);
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to delete this information?',

                onConfirm: ()=>{
                    let work_ex_id = this.fields.work_experiences[index].cse_id;

                    if(work_ex_id > 0){
                        axios.delete('/work-experiences/' + work_ex_id).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.toast.open({
                                    message: `Work experience deleted successfully.`,
                                    type: 'is-primary'
                                })
                            }
                        });
                    }

                    this.fields.work_experiences.splice(index, 1);
                }
            });
        },


        addVoluntaryWork() {
            this.fields.voluntary_works.push({
                voluntary_work_id: 0,
                name_address_org: '',
                work_from: '',
                work_to: '',
                no_hours: '',
                nature_work: '',
            });
        },
        removeVoluntaryWork(index){
            //alert(index);
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to delete this information?',

                onConfirm: ()=>{
                    let id = this.fields.voluntary_works[index].voluntary_work_id;

                    if(id > 0){
                        axios.delete('/voluntary-works/' + id).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.toast.open({
                                    message: `Deleted successfully.`,
                                    type: 'is-primary'
                                })
                            }
                        });
                    }

                    this.fields.voluntary_works.splice(index, 1);
                }
            });
        },


        addLearningDevelopment() {
            this.fields.learning_developments.push({
                learning_dev_id: 0,
                title_learning_dev: '',
                date_from: new Date(),
                date_to: new Date(),
                no_hours: 0,
                type_ld: '',
                sponsored_by: '',
                attach_file: null
            });

        },
        removeLearningDevelopment(index){
            //alert(index);
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to delete this information?',

                onConfirm: ()=>{
                    let id = this.fields.learning_developments[index].learning_dev_id;

                    if(id > 0){
                        axios.delete('/learning-developments/' + id).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.toast.open({
                                    message: `Deleted successfully.`,
                                    type: 'is-primary'
                                })
                            }
                        });
                    }

                    this.fields.learning_developments.splice(index, 1);
                }
            });
        },


        addOtherInformation() {
            this.fields.other_informations.push({
                other_info_id: 0,
                skill_hobbies: '',
                non_academic_distinction: '',
                member_association: '',
            });

        },
        removeOtherInformation(index){
            //alert(index);
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to delete this information?',

                onConfirm: ()=>{
                    let id = this.fields.other_informations[index].other_info_id;

                    if(id > 0){
                        axios.delete('/other-informations/' + id).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.toast.open({
                                    message: `Deleted successfully.`,
                                    type: 'is-primary'
                                })
                            }
                        });
                    }

                    this.fields.other_informations.splice(index, 1);
                }
            });
        },


        //Load
        // loadLearningDevelopments(){
        //     axios.get('/get-open-learning-dev-types').then(res=>{
        //         this.learning_developments = res.data
        //     })
        // },
        // loadSpecializations(){
        //     axios.get('/get-open-specializations').then(res=>{
        //         this.specializations = res.data
        //     })
        // },

    },
    mounted() {
        //this.initData();
        this.loadProvince();
        //this.loadLearningDevelopments()
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
