<template>
    <div>
        <div class="alert alert-success" v-if="showSuccess">             
            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>
        <user-edit :user="profileUser"  @user-saved="savedUser" @user-canceled="cancelEdit"></user-edit>
    </div>              
</template>

<script type="text/javascript">    
    import userEdit from './userEdit.vue';
    
    export default {
        data: function(){
            return { 
                profileUser: {
                    id: '',
                    name: '',
                    username: '',
                    email: '',
                    email_verified_at: '',
                    type: '',
                    blocked: '',
                    photo_url: '',
                    last_shift_start: '',
                },
                successMessage: "",
                showSuccess: false
            }
        },
        methods: {
            getInformationFromLoggedUser() {
                this.profileUser = this.$store.state.user;
            },
            savedUser: function(){
                this.showSuccess = true;
                this.successMessage = "User's Profile Updated";
            },
            cancelEdit: function(){
                this.showSuccess = false;
            },            
        },
        components: {
            'user-edit': userEdit, 
        },
        mounted() {
            this.getInformationFromLoggedUser();
        }        
    }
</script>