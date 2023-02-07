<template>
    <div>

        <div class="print-form">
            <div class="buttons is-right">
                <b-button
                    class="mt-5"
                    label="Print"
                    @click="print"
                    icon-right="printer"
                    type="is-primary"
                ></b-button>
            </div>

            <div v-if="data.seminar" class="print-body">
                <div class="report-header">
                    <div class="img-logo-deped">
                        <img src="/img/deped-logo.png"/>
                    </div>
                    <div class="header-text">
                        <div>Republic of the Philippines</div>
                        <div>Department of Education</div>
                    </div>
                    <div class="img-logo-oz">
                        <img src="/img/oszamis_logo.png" />
                    </div>
                </div>


                <div class="table-title mt-5">Seminar Title: {{ data.seminar_title }}</div>
                <div class="table-title">Date of Seminar: {{ data.seminar.seminar_date }}</div>
                <div class="table-title">Approved List of Candidates: {{ data.seminar_date }}</div>

                <table class="w-table">
                    <tr>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Specialization</th>
                        <th>No of Seminars</th>
                    </tr>
                    <tr v-for="(item, index) in data.recommended_teacher_lists" :key="index">
                        <td>{{ item.lname }}, {{ item.fname }} {{ item.mname }}</td>
                        <td>{{ item.sex }}</td>
                        <td>{{ item.specialization }}</td>
                        <td style="text-align: center;">{{ item.no_seminars }}</td>
                    </tr>
                </table>

                <div class="signature">
                    <div class="columns">
                        <div class="column">
                            <div class="prepared-by">
                                <div class="w-prepared">Prepared By</div>
                                <div class="w-line"></div>
                                <div class="designation">HRLD Personnel</div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="approved-by">
                                <div class="w-prepared">Approved By</div>
                                <div class="w-line"></div>
                                <div class="designation">School Division Superintendent</div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>

</template>


<script>

export default{
    props: ['propData'],
    data(){
        return{
            data: {},
        }
    },

     methods: {
         initData(){
            this.data = JSON.parse(this.propData)
             console.log(this.data)
         },

         print(){
             window.print()
         }
     },

    mounted() {
        this.initData()
    }


}
</script>

<style scoped>
    table{
        margin-left: 20px;
    }

    .w-table tr th{
        padding: 5px 10px;
    }
    .w-table tr td{
        padding: 5px 10px;
    }
    .table-title{
        font-weight: bold;
        font-size: 1.2em;
    }


    .report-header{
        display:flex;
        justify-content: center;
    }
    .img-logo-deped > img{
        height: 60px;
    }
    .img-logo-oz > img {
        height: 80px;
    }

    .header-text{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin: 5px 15px;
        font-weight: bold;
    }

    .w-line{
        height: 1px;
       border: 1px solid black;
    }

    .signature{
        margin: 100px 0 0 0;
    }
    .prepared-by{
        width: 200px;
    }

    .approved-by{
        width: 200px;
    }

    .w-prepared{
        font-weight: bold;
        margin-bottom: 50px;
    }
    .designation{
        text-align:center;
        font-weight: bold;
    }
</style>
