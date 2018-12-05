<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>
       
       
       
        <user-list :users="users"></user-list>
    </div>             
</template>
 
<script type="text/javascript">
   
    export default {
        data: function(){
            return {
                title: 'List Users',
                editingUser: false,
                showSuccess: false,
                showFailure: false,
                successMessage: '',
                failMessage: '',
                currentUser: {},
                currentUserIndex: -1,
                users: [],
            };
        },
        methods: {
             editUser: function(user){
                this.currentUser = user;
                this.showSuccess = false;
               
            },
            deleteUser: function(user){    
                 axios.delete('api/users/', {params:{id:user.id}})
                    .then(response => {
                        this.showSuccess = true;
                        this.successMessage = 'User Deleted';
                        this.getUsers();                       
                    });
            },
            saveUser: function(){
                this.currentUser = null;
                this.$refs.usersListRef.editingUser = null;
                this.showSuccess = true;
                this.successMessage = 'User Saved';
            },
            cancelEdit: function(){
                this.currentUser = null;
                this.$refs.usersListRef.editingUser = null;
            },
            getUsers: function(){
                axios.get('api/users')
                    .then(response=>{this.users = response.data; });
                  
            },
            childMessage: function(message){
                this.showSuccess = true;
                this.successMessage = message;
            }
           
        },
        mounted() {
            this.getUsers();
        }
 
       
    }
</script>
 
<style scoped> 
p {
    font-size: 2em;
    text-align: center;
}
</style>