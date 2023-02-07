<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-desktop is-10-tablet">
                    <div class="box">
                        <div class="subtitle">
                            Apply Job
                        </div>
                        
                        <div>
                            <div class="colums">
                                <div class="column">
                                    <b-field label="Tell something about yourself...">
                                        <b-input type="textarea" v-model="pitch"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="colums">
                                <div class="column">

                                    <div style="font-weight: bold;">Upload Resume/Application Letter (Optional)</div>
                                    
                                    <b-field expanded>
                                        <b-upload v-model="dropFiles" expanded
                                            drag-drop>
                                            <section class="section">
                                                <div class="content has-text-centered">
                                                    <p>
                                                        <b-icon
                                                            icon="upload"
                                                            size="is-large">
                                                        </b-icon>
                                                    </p>
                                                    <p>Drop your files here or click to upload</p>
                                                </div>
                                            </section>
                                        </b-upload>
                                    </b-field>

                                    <div class="tags" v-if="dropFiles.name" expanded>
                                        <span class="tag is-primary" >
                                            {{ dropFiles.name }}
                                            <button class="delete is-small"
                                                type="button"
                                                @click="deleteDropFile()">
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div><!--cols -->

                            <div class="buttons is-right">
                                <b-button type="is-primary" @click="submit" outlined>APPLY NOW</b-button>
                            </div>

                        </div> <!-- form container -->
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>


<script>
export default{
    props: ['propJobPostId'],
    data(){
        return{
            jobPostId: 0,

            pitch: '',
            dropFiles: {},

            errors: {},
        }
    },

    methods: {
        initData(){
            this.jobPostId = this.propJobPostId
        },

        deleteDropFile() {
            this.dropFiles = {};
        },

        submit: function(){
            let formData = new FormData();

            formData.append('pitch', this.pitch);
            formData.append('dropFiles', this.dropFiles);
            formData.append('job_post_id', this.jobPostId);
            
            axios.post('/apply-now-submit', formData).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'Submitted Successfully!',
                        type: 'is-success',
                        message: 'Application submitted successfully.',
                        confirmText: 'OK',
                        onConfirm: () => {
                            window.location = '/';
                        }
                    });
                }
            }).catch(err=>{
                console.log(err.response.data.errors);
                if(err.response.data.errors.dropFiles){
                    this.$buefy.dialog.alert({
                        title: 'Error!',
                        type: 'is-danger',
                        message: err.response.data.errors.dropFiles[0],
                        confirmText: 'OK',
                    });
                }
               

                if(err.response.data.errors === 'exists'){
                    this.$buefy.dialog.alert({
                        title: 'Already Applied!',
                        type: 'is-danger',
                        message: 'You already applied on this job post.',
                        confirmText: 'OK',
                    });
                }
            })
        }

    },

    mounted() {
        this.initData()
    }
}
</script>

<style scoped>
    
</style>
