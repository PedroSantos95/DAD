<template>
	<div class="container" id="people">
    <div class="filter">
      <label> <input type="radio" v-model="selectedCategory" value="All"> All Users </label>
      <label> <input type="radio" v-model="selectedCategory" value="Blocked"> Blocked Users </label>
    </div>
		<div class="container" id="people">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Photo</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="user in filteredUsers"  :key="user.id">
						<td>{{ user.name }}</td>
						<td>{{ user.username }}</td>
						<td>{{ user.email }}</td>
						<td ><img width="100px" :src="getProfileImage(user.photo_url)"></td>
						<td>
							<button class="btn btn-primary" @click="editUser(user)">edit</button>
							<button class="btn btn-danger" @click="deleteUser(user)">Delete</button>
							<a :class="user.blocked ?  'btn btn-xs btn-success' : 'btn btn-xs btn-warning'"  @click.prevent="blockedUsers(user)" v-text="user.blocked ?  'UnBlock' : 'Block'"></a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script type="text/javascript">
	module.exports={
		props: ["users"],
		data: function(){
			return{
				selectedCategory:'',
				editingUser:null,
			};
		},
		methods: {
			editUser: function(user){
				this.editingUser = user;
				this.$emit('edit-click', user);
			},
			getProfileImage(photo_url) {
				return `storage/profiles/${photo_url}`;
			},
			deleteUser: function(user){
				this.$emit('delete-click', user);
			},
			blockedUsers: function(user){
				if (user.blocked === 1) {
					this.message = 'User Unblocked';
				} else {
					this.message = 'User Blocked';
				}
				axios.post('api/users/block/'+user.id)
						.then(response=>{
							user.blocked = !user.blocked;
							this.$emit('message', this.message)
						})
						.catch(erros => {
							console.log(erros);
						})
			},
		},
		computed:{
			filteredUsers: function() {
				var category = this.selectedCategory;
				if(category === "All") {
					return this.users;
				}
				if(category ===	 "Blocked") {
					return this.users.filter(function(user) {
						return user.blocked ==1;
					});
				}
				if(!category)
				{
					return this.users;
				}
			}
		},
	}
</script>

<style scoped>
	tr.activerow {
		background: #123456  !important;
		color: #fff          !important;
	}
.center {
  text-align: center;
}
.button {
  background-color: #4caf50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>