<template>
    <div>
        <section class="section">
            <div class="columns is-centered">
                <div class="column is-10-desktop is-10-tablet">


                    <div class="box">
                        <div class="box-heading">
                            <div class="mb-5">
                                Trainings / Interventions / Certificates
                            </div>
                        </div>

                        <div class="box-body">

                            <div class="buttons is-right">
                                <a class="button is-primary" href="/faculty/trainings-interventions/create">Add training</a>
                                <b-button type="is-danger" @click="selected = {}">Clear Selected</b-button>
                            </div>
                            <b-table
                                :data="data"
                                :loading="loading"
                                paginated
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
                                :selected.sync="selected"
                                :default-sort-direction="defaultSortDirection"
                                @sort="onSort">

                                <b-table-column field="learning_dev_id" label="ID" sortable v-slot="props">
                                    {{ props.row.learning_dev_id }}
                                </b-table-column>

                                <b-table-column field="title_learning_dev" label="Training Title" sortable v-slot="props">
                                    {{ props.row.title_learning_dev }}
                                </b-table-column>

                                <b-table-column field="training_date" label="Training Date" sortable v-slot="props">
                                    {{ props.row.date_from }} to {{ props.row.date_to }}
                                </b-table-column>

                                <b-table-column field="no_hours" label="No. of Hours" sortable v-slot="props">
                                    {{ props.row.no_hours }}
                                </b-table-column>

                                <b-table-column field="type_ld" label="Learning Development" sortable v-slot="props">
                                    {{ props.row.type_ld }}
                                </b-table-column>

                                <b-table-column field="sponsored_by" label="Sponsored By" sortable v-slot="props">
                                    {{ props.row.sponsored_by }}
                                </b-table-column>

<!--                                <b-table-column field="ratings" label="Rating" sortable v-slot="props">-->
<!--                                    {{ props.row.ratings }}-->
<!--                                </b-table-column>-->

                                <b-table-column label="Action" v-slot="props">
                                    <div class="is-flex">

                                        <b-tooltip label="Options" type="is-info">
                                        </b-tooltip>


                                        <b-dropdown aria-role="list">
                                                <template #trigger="{ active }">
                                                    <b-button
                                                        label="Options"
                                                        type="is-warning is-small"
                                                        :icon-right="active ? 'menu-up' : 'menu-down'" />
                                                </template>

                                                <b-dropdown-item class="color-black" aria-role="listitem"
                                                    :href="`/faculty/trainings-interventions/${props.row.learning_dev_id}/edit`">Edit</b-dropdown-item>

                                                <b-dropdown-item aria-role="listitem" @click="openModalUploadCertificate">Upload Certificate</b-dropdown-item>

                                                <b-dropdown-item @click="confirmDelete(props.row.learning_dev_id)"
                                                    aria-role="listitem">Delete</b-dropdown-item>



                                            </b-dropdown>

                                    </div>
                                </b-table-column>
                            </b-table>


                            <hr>

                            <div v-if="selected.certificates">
                                <div class="cert-text">
                                    Certificates
                                </div>

                                <div class="cert-contianer">
                                    <div class="card-cert" v-for="(item, index) in selected.certificates" :key="index">
                                        <div class="buttons is-right">
                                            <b-button class="is-danger is-small" icon-left="trash-can-outline" @click="removeCert(index)"></b-button>
                                        </div>
                                        <div class="img-cert">
                                            <img :src="`/storage/certificates/${item.certificate}`" />
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div >

                        </div><!--box body -->
                    </div>
                </div>
            </div>
         </section>



         <!--modal create-->
        <b-modal v-model="modalCertificate" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <form @submit.prevent="uploadCertificate">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Upload Certificates</p>
                        <button
                            type="button"
                            class="delete"
                            @click="modalCertificate = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">
                            <div class="column">
                                <b-field label="Drop Certificates here">
                                    <b-upload v-model="dropFiles"
                                        multiple
                                        drag-drop>
                                        <section class="section">
                                            <div class="content has-text-centered">
                                                <p>
                                                    <b-icon
                                                        icon="upload"
                                                        size="is-large">
                                                    </b-icon>
                                                </p>
                                                <p>Drop your certificates here or click to upload</p>
                                            </div>
                                        </section>
                                    </b-upload>
                                </b-field>

                                <div class="tags">
                                    <span v-for="(file, index) in dropFiles"
                                        :key="index"
                                        class="tag is-primary" >
                                        {{file.name}}
                                        <button class="delete is-small"
                                            type="button"
                                            @click="deleteDropFile(index)">
                                        </button>
                                    </span>
                                </div>
                            </div>

                        </div> <!-- div class-->
                    </section>
                    <footer class="modal-card-foot">
                        <button
                            :class="btnClass"
                            label="Save"
                            type="is-success">Upload</button>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->


    </div><!-- root div-->
</template>

<script>

export default{
    props: ['propUser'],

    data(){
        return {

            data: [],
            total: 0,
            loading: false,
            sortField: 'user_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 5,
            defaultSortDirection: 'asc',

            certificates: [],
            selected: {},

            modalCertificate: false,


            dropFiles: [],

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

        }
    },

    methods: {

        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/faculty/get-learning-trainings?${params}`)
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


        // getTrainings(){

        //     const params = [
        //         `sort_by=${this.sortField}.${this.sortOrder}`,
        //         `perpage=${this.perPage}`,
        //         `page=${this.page}`

        //     ].join('&')

        //     axios.get(`/faculty/get-learning-trainings?${params}`).then(res=>{
        //         this.trainings = res.data
        //     }).catch(err=>{

        //     })
        // },

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


        confirmDelete(learningId){
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to delete this information?',

                onConfirm: ()=>{
                    axios.delete('/faculty/learning-developments/' + learningId).then(res=>{
                        if(res.data.status === 'deleted'){
                            this.$buefy.toast.open({
                                message: `Deleted successfully.`,
                                type: 'is-primary'
                            })
                            this.loadAsyncData()
                        }
                    });
                }
            });
        },

        openModalUploadCertificate(){
            this.modalCertificate = true;
        },

        uploadCertificate(){

            let formData = new FormData();

            this.dropFiles.forEach(item => {
                formData.append('files[]', item);
            })

            axios.post('/faculty/upload-certificates/' + this.selected.learning_dev_id, formData).then(res=>{
                if(res.data.status === 'upload'){
                    this.$buefy.toast.open({
                        message: 'Upload successfully.',
                        type: 'is-success'
                    })
                    this.modalCertificate = false;
                    this.dropFiles = []
                    this.loadAsyncData()

                }
            }).catch(err=>{

            })
        },

        removeCert(index){
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to remove this certificate?',

                onConfirm: ()=>{
                    let id = this.selected.certificates[index].certificate_id;

                    if(id > 0){
                        axios.delete('/faculty/remove-certificate/' + id).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.toast.open({
                                    message: `Deleted successfully.`,
                                    type: 'is-primary'
                                })
                            }
                        });
                    }

                    this.selected.certificates.splice(index, 1);
                }
            });
        },


        initData(){
            this.user = JSON.parse(this.propUser)
        }
    },

    mounted(){
        this.loadAsyncData();
    },
    created() {
         this.initData();
    }
}
</script>

<style scoped src="../../../css/training.css">
</style>
