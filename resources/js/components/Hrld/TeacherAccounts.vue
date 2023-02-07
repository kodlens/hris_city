<template>
    <div>
        <div class="section no-print">
            <div class="columns is-centered">
                <div class="column is-12-desktop is-12-tablet">
                    <div class="box">

                        <div class="is-flex mb-2" style="font-size: 20px; font-weight: bold;">LIST OF TEACHERS</div>

                        <div class="level">
                            <div class="level-left">
                                <b-field label="Page">
                                    <b-select v-model="perPage" @input="setPerPage">
                                        <option value="5">5 per page</option>
                                        <option value="10">10 per page</option>
                                        <option value="15">15 per page</option>
                                        <option value="20">20 per page</option>
                                    </b-select>
                                </b-field>
                            </div>

                            <div class="level-right">
                                <div class="level-item">
                                    <b-field label="Search">
                                        <b-input type="text"
                                                 v-model="search.lname" placeholder="Search Lastname"
                                                 @keyup.native.enter="loadAsyncData"/>
                                        <p class="control">
                                             <b-tooltip label="Search" type="is-success">
                                            <b-button type="is-primary" icon-right="magnify" @click="loadAsyncData"/>
                                             </b-tooltip>
                                        </p>
                                    </b-field>
                                </div>
                            </div>
                        </div>



                        <b-table
                            :data="data"
                            :loading="loading"
                            paginated
                            detailed
                            backend-pagination
                            :total="total"
                            :pagination-rounded="true"
                            :per-page="perPage"
                            @page-change="onPageChange"
                            aria-next-label="Next page"
                            aria-previous-label="Previous page"
                            aria-page-label="Page"
                            aria-current-label="Current page"
                            backend-sorting
                            :default-sort-direction="defaultSortDirection"
                            @sort="onSort">

                            <b-table-column field="agency_idno" label="Agency No." sortable v-slot="props">
                                {{ props.row.agency_idno }}
                            </b-table-column>

                            <b-table-column field="lname" label="Name" sortable v-slot="props">
                                {{ props.row.lname }}, {{ props.row.fname }} {{ props.row.mname }}
                            </b-table-column>

                            <b-table-column field="sex" label="Sex" v-slot="props">
                                {{ props.row.sex }}
                            </b-table-column>

                            <b-table-column field="school_assigned" label="School Assigned" v-slot="props">
                                {{ props.row.school_assigned }}
                            </b-table-column>

                            <b-table-column field="contact_no" label="Contact No." v-slot="props">
                                {{ props.row.contact_no }}
                            </b-table-column>

                            <b-table-column field="email" label="Email" v-slot="props">
                                {{ props.row.email }}
                            </b-table-column>

                            <b-table-column field="province" label="Residential" v-slot="props">
                                {{ props.row.residential_province.provDesc }}, {{ props.row.residential_city.citymunDesc }}
                            </b-table-column>

                            <b-table-column field="is_verified" label="Verified" centered v-slot="props">
                                <span class="verified" v-if="props.row.is_verified === 1">Verified</span>
                                <span class="unverified" v-else>Unverified</span>
                            </b-table-column>

                            <b-table-column label="Action" v-slot="props">
                                <div class="is-flex">
                                    <b-tooltip label="Approve Account" type="is-primary" v-if="props.row.is_verified === 0">
                                        <b-button class="button is-small mr-1" tag="a" icon-right="thumb-up-outline" @click="confirmApprove(props.row.user_id)"></b-button>
                                    </b-tooltip>
                                    <b-tooltip label="PDS" type="is-info">
                                        <b-button class="button is-small mr-1" 
                                            icon-right="printer" @click="printMe(props.row)"></b-button>
                                    </b-tooltip>
                                </div>
                            </b-table-column>


                            <template slot="detail" slot-scope="props">
                                <tr>
                                    <th>Title</th>
                                    <th>Attach File</th>
                                    <th>No Hours</th>
                                    <th>Inclusion Date</th>
                                    <th>Sponsored By</th>
                                </tr>
                                <tr v-for="(item, index) in props.row.learning_developments" :key="index">
                                    <td>{{ item.title_learning_dev }}</td>
                                    <td class="has-text-centered">
                                        <div class="m-1" v-for="(img, ix) in item.certificates"
                                            :key="ix">
                                            <b-button
                                                :label="`Image[${ix + 1}]`"
                                                 class="is-small is-primary button"
                                                @click="openCertificate(img.certificate)"
                                            >
                                            </b-button>
                                        </div>
                                    </td>
                                    <td class="has-text-centered">{{ item.no_hours }}</td>
                                    <td class="has-text-centered">{{ item.date_from }} - {{ item.date_to }}</td>
                                    <td class="has-text-centered">{{ item.sponsored_by }}</td>
                                </tr>
                            </template>


                        </b-table>



                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->


        <!--modal create-->
        <b-modal v-model="modalAttachment" has-modal-card
            trap-focus
            :width="640"
            aria-role="dialog"
            aria-label="Modal"
            aria-modal>


            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Rating</p>
                    <button
                        type="button"
                        class="delete"
                        @click="modalAttachment = false"/>
                </header>
                <section class="modal-card-body">
                    <div class="">

                        <div class="column">

                            <img :src="`/storage/certificates/${filePath}`" />
                        </div>

                    </div> <!-- div class-->
                </section>
                <footer class="modal-card-foot">
                    <button
                        @click="modalAttachment = false"
                        class="button is-primary">Close</button>
                </footer>
            </div>
        </b-modal>
        <!--close modal-->


        <div class="pds">
            <div class="text-title">
                I. PERSONAL INFORMATION
            </div>

            <div class="w-table">
                <table>
                    <tr>
                        <td colspan="3">Surname:
                            {{ pds.lname }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Given Name:
                            {{  pds.fname }}
                        </td>
                        <td>
                            Extension(Suffix): 
                            {{  pds.suffix }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Middle Name:
                            {{  pds.mname }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            Date of birth:
                            {{  pds.date_birth }}
                        </td>
                        <td>
                            Citizenship:
                            {{  pds.citizenship }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            Place of birth:
                            {{  pds.place_birth }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            Sex:
                            {{  pds.sex }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Civil Status:
                            {{  pds.civil_status }}
                        </td>
                        <td style="text-align: center;" colspan="2">
                            <b>Residential Address:</b>
                            {{  pds.civil_status }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Height:
                            {{  pds.height }}
                        </td>
                        <td>
                            House/Block No:
                            {{  pds.res_houseno_blockno }}
                        </td>
                        <td>
                            Street:
                            {{  pds.res_street }}
                        </td>
                    </tr>

                    <!-- residential address -->
                    <tr v-if="pds.residential_barangay">
                        <td>
                            Weight:
                            {{  pds.weight }}
                        </td>
                        <td>
                           Barangay:
                            {{  pds.residential_barangay.brgyDesc }}
                        </td>
                        <td>
                           City:
                            {{  pds.residential_city.citymunDesc }}
                        </td>
                    </tr>

                    <tr v-if="pds.residential_province">
                        <td>
                            Blood Type:
                            {{  pds.blood_type }}
                        </td>
                        <td>
                            Province:
                            {{ pds.residential_province.provDesc }}
                        </td>
                        <td>
                            Zipcode:
                            {{ pds.res_zipcode }}
                        </td>
                    </tr>


                    <tr>
                        <td>
                            GSIS ID No.:
                            {{  pds.gsis }}
                        </td>
                        <td style="text-align: center;" colspan="2">
                            <b>Permanent Address:</b>
                            {{  pds.civil_status }}
                        </td>
                    </tr>
                    <!-- permanent address -->
                    <tr v-if="pds.permanent_barangay">
                        <td>
                            PAGIBIG ID No.:
                            {{  pds.pagibig }}
                        </td>
                        <td>
                           Barangay:
                            {{  pds.permanent_barangay.brgyDesc }}
                        </td>
                        <td>
                           City:
                            {{  pds.permanent_city.citymunDesc }}
                        </td>
                    </tr>

                    <tr v-if="pds.permanent_province">
                        <td>
                            Philhealth No.:
                            {{  pds.philhealth }}
                        </td>
                        <td>
                            Province:
                            {{ pds.permanent_province.provDesc }}
                        </td>
                        <td>
                            Zipcode:
                            {{ pds.per_zipcode }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            SSS No.:
                            {{ pds.sss }}
                        </td>
                        <td>
                            Telephone No.:
                            {{ pds.tel_no }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            TIN:
                            {{ pds.tin }}
                        </td>
                        <td>
                            Mobile No.:
                            {{ pds.contact_no }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Agency Employee No.:
                            {{ pds.agency_idno }}
                        </td>
                        <td>
                            Email Address:
                            {{ pds.email }}
                        </td>
                    </tr>

                </table>
                <div class="text-title">
                    II. FAMILY BACKGROUND
                </div>
                <table class="w-table">
                    <tr>
                        <td colspan="2">
                            Spouse's Surname:
                            {{ pds.spouse_surname }}
                        </td>

                        <td>
                            <b>Name of Children</b>
                        </td>
                        <td>
                            <b>Date of Birth</b>
                        </td>
                       
                    </tr>
                    <tr>
                        <td>
                            First Name:
                            {{ pds.spoue_fname }}
                        </td>
                        <td>
                            Extension:
                            {{ pds.spouse_suffix }}
                        </td>

                        <!--name of children-->
                        <td>
                            
                        </td>

                        <td>
                            
                        </td>
                        <!-- <td>
                            <span v-if="pds.children.length > 0">
                                {{ pds.pds.children[0].child_bdate }}
                            </span>
                        </td> -->
                       
                    </tr>
                    <tr>
                        <td colspan="2">
                            Middle Name:
                            {{ pds.spoue_fname }}
                        </td>
                       
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            Occupation:
                            {{ pds.spouse_occupation }}
                        </td>
                        <td></td>
                        <td></td>
                   
                    </tr>

                    <tr>
                        <td colspan="2">
                            Employer Business Name:
                            {{ pds.business_name }}
                        </td>
                        <td></td>
                        <td></td>
                    
                    </tr>

                    <tr>
                        <td colspan="2">
                            Business Address:
                            {{ pds.business_address }}
                        </td>
                        <td></td>
                        <td></td>
                        
                    </tr>

                    <tr>
                        <td colspan="2">
                            Telephone No.:
                            {{ pds.business_contact_no }}
                        </td>
                        <td></td>
                        <td></td>
                       
                    </tr>


                    <tr>
                        <td colspan="2">
                            Father Surname:
                            {{ pds.father_surname }}
                        </td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>
                            First Name:
                            {{ pds.father_fname }}
                        </td>
                        <td>
                            Extension:
                            {{ pds.spouse_suffix }}
                        </td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            Middle Name:
                            {{ pds.father_mname }}
                        </td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            Mother Maiden Surname:
                            {{ pds.mother_maiden_name }}
                        </td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            First Name:
                            {{ pds.mother_fname }}
                        </td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            Middle Name:
                            {{ pds.mother_mname }}
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

                <div class="text-title">
                    III. EDUCATIONAL BACKGROUND
                </div>
                <table class="w-table">
                    <tr>
                        <td>LEVEL</td>
                        <td style="font-size: .8em;">NAME OF SCHOOL</td>
                        <td style="font-size: .8em;">BASIC EDUCATION/DEGREE/COURSE</td>
                        <td style="font-size: .8em;" colspan="2">PERIOD OF ATTENDANCE</td>
                        <td style="font-size: .8em;">HEIGHEST LEVEL EARNED</td>
                        <td style="font-size: .8em;">YEAR GRADUATED</td>
                        <td style="font-size: .8em;">SCHOLARSHIP/ACADEMIC HONORS</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>From</td>
                        <td>To</td>

                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                </table>
                    
           
            </div>
        </div>

    </div>
</template>

<script>

export default{
    data() {
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'user_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 10,
            defaultSortDirection: 'asc',

            search: {
                lname: '',
            },

            modalAttachment: false,

            filePath: '',

            pds: {},


            errors: {},
            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },


        }

    },

    methods: {
        /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `lname=${this.search.lname}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/hrld/get-teacher-accounts?${params}`)
                .then(({ data }) => {
                    this.data = [];
                    let currentTotal = data.total
                    if (data.total / this.perPage > 1000) {
                        currentTotal = this.perPage * 1000
                    }

                    this.total = currentTotal
                    data.data.forEach((item) => {
                        //item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
                        this.data.push(item)
                    })
                    this.loading = false
                })
                .catch((error) => {
                    this.data = []
                    this.total = 0
                    this.loading = false
                    throw error
                })
        },
        /*
        * Handle page-change event
        */
        onPageChange(page) {
            this.page = page
            this.loadAsyncData()
        },

        onSort(field, order) {
            this.sortField = field
            this.sortOrder = order
            this.loadAsyncData()
        },

        setPerPage(){
            this.loadAsyncData()
        },


        //alert box ask for deletion
        confirmApprove(userid) {
            this.$buefy.dialog.confirm({
                title: 'Approve Account?',
                type: 'is-primary',
                message: 'Are you sure you want to approve this teacher?',
                cancelText: 'Cancel',
                confirmText: 'Approve?',
                onConfirm: () => this.approvedSubmit(userid)
            });
        },
        //execute delete after confirming
        approvedSubmit(userid) {
            axios.post('/hrld/teacher-approve-account/' + userid).then(res => {
                this.loadAsyncData();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },

        openCertificate(cert){
            this.filePath = cert;
            this.modalAttachment = true;
        },

        printMe(data){
            this.pds = data
            let delayInMilliseconds = 1000; //1 second

            setTimeout(function() {
            //your code to be executed after 1 second
                window.print()
            }, delayInMilliseconds);
           
           
        }



    },

    mounted() {
        //this.loadOffices();
        this.loadAsyncData();

    }
}
</script>


<style scoped>
    .verified{
        padding: 5px;
        color: white;
        background-color: green;
        font-weight: bold;
        font-size: .8em;
    }
    .unverified{
        padding: 5px;
        color: white;
        background-color: red;
        font-weight: bold;
        font-size: .8em;
    }

   




</style>
