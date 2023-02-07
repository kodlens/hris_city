<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-desktop is-10-tablet">
                    <div class="box">

                        <div class="is-flex mb-2" style="font-size: 20px; font-weight: bold;">LIST OF SPECIALIZATION</div>

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
                                                 v-model="search.specialization" placeholder="Search Specialization"
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

                            <b-table-column field="ld_type_id" label="ID" sortable v-slot="props">
                                {{ props.row.specialization_id }}
                            </b-table-column>

                            <b-table-column field="ld_type" label="Specialization" sortable v-slot="props">
                                {{ props.row.specialization }}
                            </b-table-column>

                            <b-table-column label="Action" v-slot="props">
                                <div class="is-flex">
                                    <b-tooltip label="Edit" type="is-primary">
                                        <b-button class="button is-small mr-1" tag="a" icon-right="pencil" @click="openModal(props.row.specialization_id)"></b-button>
                                    </b-tooltip>
                                    <b-tooltip label="Delete" type="is-danger">
                                        <b-button class="button is-small mr-1 is-danger" icon-right="trash-can" @click="confirmDelete(props.row.specialization_id)"></b-button>
                                    </b-tooltip>
                                </div>
                            </b-table-column>
                        </b-table>

                        <div class="buttons">
                            <b-button label="New" @click="openModal(0)" icon-right="plus" type="is-primary"></b-button>
                        </div>
                    </div>

                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->


        <!--modal create-->
        <b-modal v-model="modalCreateUpdate" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>


            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Specialization Information</p>
                    <button
                        type="button"
                        class="delete"
                        @click="modalCreateUpdate = false"/>
                </header>
                <section class="modal-card-body">
                    <div class="">
                        <div class="columns">

                            <div class="column">
                                <b-field label="Specialization">
                                    <b-input type="input" placeholder="Specialization"
                                             v-model="fields.specialization"></b-input>
                                </b-field>
                            </div>
                        </div>

                    </div> <!-- div class-->
                </section>
                <footer class="modal-card-foot">
                    <button
                        @click="submit"
                        class="button is-primary">Save</button>
                </footer>
            </div>
        </b-modal>
        <!--close modal-->

    </div>
</template>

<script>

export default{
    data() {
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'specialization_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 10,
            defaultSortDirection: 'asc',

            search: {
                specialization: '',
            },

            modalCreateUpdate: false,

            specializationId: 0,

            fields: {},
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
                `specialization=${this.search.specialization}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-specialization?${params}`)
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

        submit: function(){
            if(this.specializationId > 0){
                //update
                axios.put('/specialization/' + this.specializationId, this.fields).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: 'UPDATED!',
                            message: 'Successfully updated.',
                            type: 'is-success',
                            confirmText: 'OK',
                            onConfirm: () => {
                                this.loadAsyncData();
                                this.modalCreateUpdate = false
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors
                    }
                })
            }else{
                //insert
                axios.post('/specialization', this.fields).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: 'SAVED!',
                            message: 'Successfully saved.',
                            type: 'is-success',
                            confirmText: 'OK',
                            onConfirm: () => {
                                this.loadAsyncData();
                                this.modalCreateUpdate = false
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors
                    }
                })

            }
        },


        //alert box ask for deletion
        confirmDelete(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this data?',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => this.deleteSubmit(delete_id)
            });
        },
        //execute delete after confirming
        deleteSubmit(delete_id) {
            axios.delete('/specialization/' + delete_id).then(res => {
                this.loadAsyncData();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },


        getData(){
            axios.get('/specialization/' + this.specializationId).then(res=>{
                this.fields = res.data
            })
        },

        openModal(specializationId){
            this.fields = {}
            this.specializationId = 0;

            this.specializationId = specializationId
            this.modalCreateUpdate = true;

            if(this.specializationId > 0){
                this.getData()
            }
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
