<template>
	<div class="jumbotron">
		<h1>Add User</h1>   
      
        <form method="POST" action="api/users/">
             <div class="form-group">
	        <label for="inputName">Name</label>
	        <input
	            type="text" class="form-control" v-model="user.name"
	            name="name" id="inputName" 
	            placeholder="Name"/>
	    	</div>
        <div class="form-group">
	        <label for="inputUserName">Username</label>
	        <input
	            type="text" class="form-control" v-model="user.username"
	            name="username" id="inputUserName" 
	            placeholder="Username"/>
	    </div>
	    <div class="form-group">
	        <label for="inputEmail">Email</label>
	        <input
	            type="email" class="form-control" v-model="user.email"
	            name="email" id="inputEmail"
	            placeholder="Email address"/>
	    </div>
            <select v-model="user.type">
                <label for="username">Type</label>
		                <option>Waiter</option>
		                <option>Cook</option>
		                <option>Cashier</option>
		                <option>Manager</option>
            </select>

            <br><br>
        <a class="btn btn-primary" v-on:click.prevent="addUser()">Add</a>
        <a class="btn btn-danger" v-on:click.prevent="cancelAdd()">Cancel</a>
        </form>

	</div>

</template>

<script type="text/javascript">
	export default{
		data: function(){
           	return{
           		user:{
           			name: '',         
                    username: '',
                    email: '',
                    type:''                   
                }			
           	}
		},
        methods: {
             addUser: function(){
               axios.post('api/users/', this.user)
                   .then(response => {
                       console.log(response);                        
                   })
                   .catch(error => console.log(""));
            },		

            cancelAdd: function(){
	        	axios.get('api/users/'+this.user.id)
	                .then(response=>{
	                	Object.assign(this.user, response.data.data);
	                	this.$emit('user-canceled', this.user);
	                });
            },

           	getProfileImage(photo_url) {
      			return `storage/profiles/${photo_url}`;
            },
            
			
		},
			
	}
</script>

<style scoped>
	tr.activerow {
  		background: #123456  !important;
  		color: #fff          !important;
}
</style>