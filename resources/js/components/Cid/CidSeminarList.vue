<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-10-desktop is-12-tablet">
                    <div class="box">

                        <div class="is-flex mb-2" style="font-size: 20px; font-weight: bold;">LIST OF POSTED SEMINARS</div>

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
                                                 v-model="search.title" placeholder="Search Title"
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

                            <b-table-column field="seminar_post_id" label="ID" sortable v-slot="props">
                                {{ props.row.seminar_post_id }}
                            </b-table-column>


                            <b-table-column field="title" label="Title" sortable v-slot="props">
                                {{ props.row.title }}
                            </b-table-column>

                            <b-table-column field="ld_type" label="Learning Development Type" sortable v-slot="props">
                                {{ props.row.ld_type }}
                            </b-table-column>

                            <b-table-column field="conducted_by" label="Conducted By" v-slot="props">
                                {{ props.row.conducted_by }}
                            </b-table-column>

                            <b-table-column field="no_hours" label="No. Hours" v-slot="props">
                                {{ props.row.no_hours }}
                            </b-table-column>

                            <b-table-column field="specialization" label="Specialization" v-slot="props">
                                {{ props.row.specialization }}
                            </b-table-column>

                            <b-table-column field="seminar_date" label="Seminar Date" v-slot="props">
                                {{ props.row.seminar_date }}
                            </b-table-column>


                        </b-table>

                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->




    </div> <!-- root div -->
</template>

<script>

import ModalBrowseTeacherList from "../Modals/ModalBrowseTeacherList";
export default{
    components: {ModalBrowseTeacherList},
    data() {
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'seminar_post_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 10,
            defaultSortDirection: 'asc',

            search: {
                title: '',
            },

            modalRate: false,

            errors: {},
            fields: {
                rating: 0
            },

            id: 0,
        }
    },

    methods: {
        /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `title=${this.search.title}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/cid/get-seminar-posted-list?${params}`)
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




        teacherList(item){
            this.modalRate = true
            this.id = item;
        },

        submitRating(){
            axios.post('/cid/submit-rating/' + this.id , this.fields).then(res=>{
                if(res.data.status === 'rated'){
                    this.$buefy.dialog.alert({
                        title: 'Rated!',
                        type: 'is-success',
                        message: 'Successfully rated.'
                    });

                    this.modalRate = false
                    this.loadAsyncData()
                    this.fields.rating = 0;
                }
            }).catch(err=>{

            })
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
