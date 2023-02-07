<template>
    <div>
        <ejs-pdfviewer id="pdfViewer" :serviceUrl="serviceUrl" :documentPath="documentPath"> </ejs-pdfviewer>
    </div>
</template>

<script>

export default{
    props: ['propApplicantId'],

    data(){
        return{
            applicantId: 0,
            applicant: {},
            serviceUrl:"https://ej2services.syncfusion.com/production/web-services/api/pdfviewer",
            documentPath:"PDF_Succinctly.pdf"
        }
    },
    methods: {
        initData(){
            this.applicantId = parseFloat(this.propApplicantId)

            axios.get('/employer/get-applicant-info/' + this.applicantId).then(res=>{
                this.applicant = res.data
            })
        }
    },
    mounted(){
        this.initData()
    }
}
</script>