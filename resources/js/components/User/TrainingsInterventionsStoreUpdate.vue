<template>
    <div>
        <section class="section">
            <div class="columns is-centered">
                <div class="column is-8-desktop is-10-tablet">


                    <div class="box">
                        <div class="box-heading">
                            <div>
                                Manage Trainings / Inteventions / Certificates
                            </div>
                        </div>

                        <div class="box-body">
                           <div class="columns">
                                <div class="column">
                                    <b-field label="Title of Learning Development (Write Full)" label-position="on-border">
                                        <b-input type="text" v-model="fields.title_learning_dev" placeholder="Title of Learning Development (Write Full)"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Inclusive Dates (Attendance)" label-position="on-border">
                                        <b-datepicker v-model="fields.date_from" editable placeholder="From"></b-datepicker>
                                        <b-datepicker v-model="fields.date_to" editable placeholder="To"></b-datepicker>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="No. of hours" label-position="on-border">
                                        <b-input type="text" v-model="fields.no_hours" placeholder="No. of hours"></b-input>
                                    </b-field>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Type Learning Development" label-position="on-border" expanded>
                                        <b-select v-model="fields.type_ld"
                                                  placeholder="Type Learning Development"
                                                  expanded>
                                            <option v-for="(item, index) in learning_developments" :key="index"
                                                :value="item.ld_type">
                                                {{ item.ld_type }}
                                            </option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Conducted / Sponsored By" expanded label-position="on-border">
                                        <b-input type="text" v-model="fields.sponsored_by" expanded placeholder="Conducted / Sponsored By"></b-input>

                                    </b-field>
                                </div>
                            </div>

                            <!-- <div class="columns">
                                <div class="column">
                                    <b-field class="file is-primary" :class="{'has-name': !!fields.file}">
                                        <b-upload v-model="fields.file" class="file-label">
                                            <span class="file-cta">
                                                <b-icon class="file-icon" icon="upload"></b-icon>
                                                <span class="file-label">Click to upload certificate</span>
                                            </span>
                                            <span class="file-name" v-if="fields.file">
                                                {{ fields.file.name }}
                                            </span>
                                        </b-upload>
                                    </b-field>
                                </div>
                            </div> -->

                            <div class="columns" v-if="id == 0">
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
                            </div>

                            <div class="buttons is-right">
                                <b-button icon-left="content-save" @click="submitTraining" class="button is-primary">
                                    Save Training
                                </b-button>
                            </div>

                        </div><!--box body -->
                    </div>
                </div>
            </div>
         </section>
    </div>
</template>

<script>

export default{
    props: ['propUser', 'propId', 'propData'],
    data(){
        return {
            fields: {},
            errors: {},
            dropFiles: [],

            trainings: [],
            total: 0,
            loading: false,
            sortField: 'user_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 5,
            defaultSortDirection: 'asc',

            id: 0,

            learning_developments: [],

        }
    },

    methods: {
        loadLearningDevelopments(){
            axios.get('/get-open-learning-dev-types').then(res=>{
                this.learning_developments = res.data
            })
        },
        getTrainings(){

            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            axios.get(`/faculty/get-learning-trainings?${params}`).then(res=>{
                this.trainings = res.data
            }).catch(err=>{

            })
        },

        submitTraining(){

            let ndateFrom = new Date(this.fields.date_from);
            let ndateTo = new Date(this.fields.date_to);

            let dateNow = new Date();
            //2018 > 2017
            if((dateNow.getFullYear() - 5) > (ndateTo.getFullYear())){
                this.$buefy.dialog.alert({
                    title: 'Training too old!',
                    message: 'The training you inputted is too old.',
                    type: 'is-danger',
                });
                return;
            }

            let dateFrom = ndateFrom.getFullYear() + '-' + (ndateFrom.getMonth() + 1) + '-' + ndateFrom.getDate();
            let dateTo = ndateTo.getFullYear() + '-' + (ndateTo.getMonth() + 1) + '-' + ndateTo.getDate();

            let formData = new FormData();

            formData.append('title_learning_dev', this.fields.title_learning_dev);
            formData.append('date_from', dateFrom);
            formData.append('date_to', dateTo);
            formData.append('no_hours', this.fields.no_hours);
            formData.append('type_ld', this.fields.type_ld);
            formData.append('sponsored_by', this.fields.sponsored_by);


            if(this.id > 0){
                //update
                axios.post('/faculty/trainings-interventions-update/' + this.id, formData).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: 'UPDATED!',
                            message: 'Trainings successfully saved.',
                            type: 'is-success',
                            onConfirm: ()=>{
                                window.location = '/faculty/trainings-interventions'
                            }
                        });
                    }

                }).catch(err=>{
                    if(err.reponse.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })
            }else{
                //store
                this.dropFiles.forEach(item => {
                    formData.append('files[]', item);
                })

                axios.post('/faculty/trainings-interventions', formData).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: 'SAVED!',
                            message: 'Trainings successfully saved.',
                            type: 'is-success',
                            onConfirm: ()=>{
                                window.location = '/faculty/trainings-interventions'
                            }
                        });
                    }

                }).catch(err=>{
                    if(err.reponse.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })

            }

        },

        deleteDropFile(index) {
            this.dropFiles.splice(index, 1)
        },



        initData(){
            this.user = JSON.parse(this.propUser)

            this.id = parseInt(this.propId)

            if(this.id > 0){
                let nData = JSON.parse(this.propData)
                this.fields.title_learning_dev = nData.title_learning_dev;
                this.fields.date_from = new Date(nData.date_from);
                this.fields.date_to = new Date(nData.date_to);

                this.fields.no_hours = nData.no_hours;
                this.fields.type_ld = nData.type_ld;
                this.fields.sponsored_by = nData.sponsored_by;
            }
        }
    },

    mounted(){
        this.getTrainings();
        this.loadLearningDevelopments()
    },
    created() {
         this.initData();
    }
}
</script>


<style scoped src="../../../css/training.css">
</style>
