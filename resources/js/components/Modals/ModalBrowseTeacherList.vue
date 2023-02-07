<template>
    <div>
<!--        <b-field label="Dentist"-->
<!--            :type="this.errors.dentist_id ? 'is-danger':''"-->
<!--            :message="this.errors.dentist_id ? this.errors.dentist_id[0] : ''">-->

<!--            <b-input :value="valueFullname" expanded icon-pack="fa"-->
<!--                    icon="account-outline" placeholder="SELECT DENTIST" required readonly>-->
<!--            </b-input>-->

<!--            <p class="control">-->
<!--                <b-button class="button is-primary" @click="openModal">...</b-button>-->
<!--            </p>-->
<!--        </b-field>-->

        <b-tooltip label="Teacher List" type="is-primary">
            <b-button class="button is-small mr-1" tag="a"
                  icon-right="format-list-bulleted"
                  @click="openModal"></b-button>
        </b-tooltip>


        <!--modal reset password-->
        <b-modal v-model="isModalActive" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Select Teacher</p>
                    <button type="button" class="delete"
                            @click="isModalActive = false"/>

                </header>

                <section class="modal-card-body">
                    <div>

                        <b-field label="Search" label-position="on-border" >
                            <b-input type="text" v-model="search.lname" placeholder="Search Lastname..." expanded auto-focus></b-input>
                            <b-input type="text" v-model="search.fname" placeholder="Search Firstname..." expanded auto-focus></b-input>
                            <p class="control">
                                <b-button class="is-primary" icon-pack="fa" icon-left="search" @click="loadAsyncData"></b-button>
                            </p>
                        </b-field>

                        <div class="table-container">
                            <b-table
                                :data='data'
                                :loading="loading"
                                paginated
                                :sticky-header="true"
                                checkable
                                sticky-checkbox
                                backend-pagination
                                :total='total'
                                :per-page="perPage"
                                @page-change="onPageChange"
                                detail-transition=""
                                aria-next-label="Next page"
                                aria-previous-label="Previouse page"
                                aria-page-label="Page"
                                :show-detail-icon=true
                                aria-current-label="Current page"
                                default-sort-direction="defualtSortDirection"
                                @sort="onSort">

                                <b-table-column field="user_id" label="ID" v-slot="props">
                                    {{props.row.user_id}}
                                </b-table-column>

                                <b-table-column field="lname" label="Lastname" v-slot="props">
                                    {{props.row.lname}}
                                </b-table-column>

                                <b-table-column field="fname" label="Firstname" v-slot="props">
                                    {{props.row.fname}}
                                </b-table-column>

                                <b-table-column field="mname" label="Middlename" v-slot="props">
                                    {{props.row.mname}}
                                </b-table-column>

                                <b-table-column field="no_seminars" label="No. Of Seminars" v-slot="props">
                                    {{props.row.no_seminars}}
                                </b-table-column>


                            </b-table>
                        </div>

                    </div>
                </section>

                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="isModalActive=false"></b-button>
                </footer>
            </div>
        </b-modal>


    </div>
</template>

<script>
export default {
    props: ['propSpecialization', 'propSeminar'],

    data(){
        return{
            data: [],
            total: 0,
            loading: false,
            sortfield: 'user_id',
            sortOrder:'desc',
            page: 1,
            perPage: 20,
            defaultSortDirection:'',

            isModalActive: false,
            errors:{},

            search: {
                lname: '',
                fname: '',
            },

            seminar: {},

        }
    },
    methods: {
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortfield}.${this.sortOrder}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`,
                `lname=${this.search.lname}`,
                `specialization=${this.propSpecialization}`,
                `fname=${this.search.fname}`,
            ].join('&');

            this.loading = true;
            axios.get(`/generate-list?${params}`).then(({data}) => {
                this.data = [];
                let currentTotal = data.total;
                if (data.total / this.perPage > 1000) {
                    currentTotal = this.perPage * 1000;
                }

                this.total = currentTotal;
                data.forEach((item) => {
                    this.data.push(item);
                });

                this.loading = false;
            }).catch(err => {
                this.data = [];
                this.total = 0;
                this.loading = false;
                throw err;
            });

        },

        onPageChange(page) {
            this.page = page;
            this.loadAsyncData();
        },

        onSort(field, order) {
            this.sortfield = field;
            this.sortOrder = order;
            this.loadAsyncData();
        },

        setPerPage() {
            this.loadAsyncData();
        },

        openModal(){
             this.loadAsyncData();
             this.isModalActive = true;
        },

        selectData(dataRow){
            this.isModalActive = false;
            this.$emit('browseDentist', dataRow);
        },


        initData(){
            this.seminar = JSON.parse(this.propSeminar)
        }

    },

    mounted() {

    },

    computed: {
        valueFullname(){
            return this.propDentist;
        }
    },

}
</script>

<style scoped>
    .card-width{
        width: 640px;
    }
</style>
