<template>
	<div class="jumbotron">
	    <h2>Edit User</h2>
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
	    <div class="form-group">
	        <label for="inputPhoto">Photo</label>
            <br>
	        <img  width="100px" :src="getProfileImage(user.photo_url)">
            <br>
            <input type="file" @change="onFileSelected">
            <button @click="onUpload">Upload</button>
	    </div>

	    <div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="saveUser()">Save</a>
	        <a class="btn btn-light" v-on:click.prevent="cancelEdit()">Cancel</a>
	    </div>
	</div>
</template>

<script type="text/javascript">
	module.exports={
        props: ['user'],
        data() {
            return {
                selectedFile: "",
                
            }
        },
	    methods: {
	        saveUser: function(){
	            axios.put('api/users/' + this.user.id, this.user)
	                .then(response=>{
	                	Object.assign(this.user, response.data.data);
	                	this.$emit('user-saved', this.user);
	                });
	        },
	        cancelEdit: function(){
	        	axios.get('api/users/'+this.user.id)
	                .then(response=>{
	                	Object.assign(this.user, response.data.data);
	                	this.$emit('user-canceled', this.user);
	                });
            },
            getProfileImage(photo_url) {
      			return `img/profiles/${photo_url}`;
            },
            onFileSelected(event) {
                this.selectedFile = event.target.files[0];
            },
            onUpload() {
				console.log(this.selectedFile);
				uploadHandler = () => {
			  	const formData = new FormData();
  				formData.append('myFile', this.selectedFile, this.selectedFile.name);
  				axios.post('http://projetodad.test/#/users/file-upload', formData, {
   						 onUploadProgress: progressEvent => {
      									console.log(progressEvent.loaded / progressEvent.total)
										}
				})
            }
		}
	}
	}
</script>

<style scoped>	
</style>
