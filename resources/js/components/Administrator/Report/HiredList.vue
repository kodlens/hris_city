<template>
    <div>
       
        <div class="print-filter">
            <div class="buttons">
                <a class="button" href="/admin/home">BACK</a>
            </div>
            <div class="columns">
                <div class="column">
                    <b-field>
                        <b-input type="text" v-model="search.company" placeholder="Company"></b-input>
                        <b-input type="text" v-model="search.employer" placeholder="Employer"></b-input>
                    </b-field>
                </div>

                <div class="column">
                    <b-field>
                        <b-checkbox v-model="allow_date">Use date filter</b-checkbox>
                        <b-datepicker v-model="date_hired" placeholder="Date Hired"></b-datepicker>
                    </b-field>
                </div>
                <div class="column">
                    <b-input type="text" v-model="search.barangay" placeholder="Barangay"></b-input>
                </div>

            </div>

            <div class="buttons">
                <b-button type="is-primary" label="Generate" @click="loadReportData"></b-button>
            </div>
        </div>
        <div class="printarea"></div>
            <div class="report-head">
                LIST OF HIRED EMPLOYEES
            </div>

            <div class="report-body">
                <table class="report-table" border="1">
                    <tr>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Date Hired</th>
                    </tr>
                    <tr v-for="(item, index) in data" :key="index">
                        <td>{{ item.emp_lname }}, {{  item.emp_fname }} {{ item.emp_mname }}</td>
                        <td>{{ item.emp_sex }}</td>
                        <td>{{ item.emp_contact_no }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.company }}</td>
                        <td>{{ item.date_hired }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div><!-- root-->
</template>

<script>

export default{
    props: ['propData'],
    data(){
        return {
            data: [],

            search: {
                company: '',
                employer: '',
                barangay: '',
                date_hired: null,
            },
            date_hired: null,
            allow_date: false
        }
    },

    methods: {
        initData(){
            //this.data = JSON.parse(this.propData)
        },


        loadReportData(){
            let params;
            if(this.allow_date == true){
                let ndate = new Date(this.date_hired);
                this.search.date_hired = ndate.getFullYear() + '-' + (ndate.getMonth() + 1) + '-' +ndate.getDate();

                params = [
                    `sort_by=${this.sortField}.${this.sortOrder}`,
                    `company=${this.search.company}`,
                    `employer=${this.search.employer}`,
                    `datehired=${this.search.date_hired}`,
                    `barangay=${this.search.barangay}`
                    
                ].join('&')
            }else{
                params = [
                    `sort_by=${this.sortField}.${this.sortOrder}`,
                    `company=${this.search.company}`,
                    `employer=${this.search.employer}`,
                    `barangay=${this.search.barangay}`,
                    `datehired=`
                ].join('&')
            }

            axios.get(`get-applicant-report?${params}`).then(res=>{
                this.data = res.data
            }).catch(err=>{
            
            })
        }
    },

    mounted(){
        this.initData()
    }
}
</script>