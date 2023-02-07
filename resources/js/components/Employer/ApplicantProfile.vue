<template>
    <div>
        <div class="section">

            <div class="columns is-centered">
                <div class="column is-8-desktop">
                    <div class="box">
                        <div class="profile-container">
                            <div class="profile-header">
                                <strong>Profile</strong>
                            </div>
                            <div class="profile-body">
                                <div class="img-container">
                                    <img :src="`/storage/avatar/${user.avatar}`" />
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <strong>Lastname: </strong>  
                                        {{ user.lname }}
                                    </div>
                                    <div class="column">
                                        <strong>Firstname: </strong>   
                                        {{ user.fname }}
                                    </div>
                                    <div class="column">
                                        <strong>Middlename: </strong>
                                        {{ user.mname }}
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <strong>Suffix: </strong>  
                                        {{ user.suffix }}
                                    </div>
                                    <div class="column">
                                        <strong>Sex: </strong>   
                                        {{ user.sex }}
                                    </div>
                                    <div class="column">
                                        <strong>Birthdate: </strong>
                                        {{ user.bdate }}
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <strong>Email: </strong>  
                                        {{ user.email }}
                                    </div>
                                    <div class="column">
                                        <strong>Contact No.: </strong>   
                                        {{ user.contact_no }}
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <strong>Province: </strong>  
                                        {{ user.province.provDesc }}
                                    </div>
                                    <div class="column">
                                        <strong>City: </strong>   
                                        {{ user.city.citymunDesc }}
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column">
                                        <strong>Barangay: </strong>  
                                        {{ user.barangay.brgyDesc }}
                                    </div>
                                    <div class="column">
                                        <strong>Street: </strong>   
                                        {{ user.street }}
                                    </div>
                                </div>


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
    props: ['propUser'],

    data(){
        return {
            user: {}
        }
    },

    methods: {

    },

    mounted(){
        this.user = JSON.parse(this.propUser)

        console.log(this.user)
    }
}
</script>

<style scoped src="../../../css/applicant-profile.css">
    
</style>