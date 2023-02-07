<template>
    <div>
        <div class="section">

            <div class="buttons">
                <a class="button is-primary is-small is-outlined" tag="a" href="/employer/company-add-edit">
                    <b-icon
                        class="mr-2"
                        icon="plus-thick"
                        type="is-info">
                    </b-icon>
                    ADD COMPANY</a>
            </div>

            <div class="company-container">
                <div class="company-box" v-for="(item, index) in companies" :key="index">
                    <div class="company-box-header">
                        <div class="company-title">{{ item.company }}</div>
                        <div class="company-box-close">
                            <button class="button is-small" @click="editCompany(item.company_id)">
                                <b-icon
                                    icon="pencil"
                                    type="is-warning">
                                </b-icon>
                            </button>
                            <button class="button is-small" @click="confirmDelete(item.company_id)">
                                <b-icon
                                    icon="delete"
                                    type="is-danger">
                                </b-icon>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="company-desc">
                        {{ item.overview }}
                    </div>
                    <div class="company-footer">
                         {{ item.owner }}
                    </div>

                    <div class="buttons">
                        <b-button tag="a" class="button is-primary" :href="`/employer/company-job-post/${item.company_id}`">VIEW FEEDS</b-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            companies: []
        }
    },

    methods: {
        loadCompanies(){
            axios.get('/employer/get-my-companies').then(res=>{
                this.companies = res.data;
            })
        },

        editCompany(id){
            window.location = '/employer/company-add-edit/' +id;
        },


        //alert box ask for deletion
        confirmDelete(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this company? This action cannot be undone.',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => this.deleteSubmit(delete_id)
            });
        },
        //execute delete after confirming
        deleteSubmit(delete_id) {
            axios.delete('/employer/company-delete/' + delete_id).then(res => {
                this.loadCompanies();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },

    },

    mounted(){
        this.loadCompanies();
    }
}
</script>
<style scoped>
    .company-container{
        display: flex;
    }

    .company-box{
        max-width: 450px;
        border: 1px solid gray;
        padding: 15px;
        margin: 10px;
    }

    .company-box-header{
        display: flex;
    }


    .company-title{
        font-weight: bold;
        margin-right: 20px;
    }

    .company-box-close{
        margin-left: auto;
    }

    .company-footer{
        margin: 15px 0 15px 0;
        border-top: 1px solid rgb(207, 207, 207);
    }
</style>
