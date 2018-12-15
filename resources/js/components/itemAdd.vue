<template>
	<div class="jumbotron">
			<h1>Add Item</h1>     

        <form method="POST" action="api/items/">
        <div class="form-group">
                <label for="name">Name</label>
                <input
                    type="text" class="form-control" v-model="item.name"
                    name="name" id="name"/>
            </div>
            <div class="form-group">
                <label for="username">Price</label>
                <input
                    type="text" class="form-control" v-model="item.price"
                    name="name" id="name"/>
            </div>
            <div class="form-group">
                <label for="username">Description</label>
                <input
                    type="text" class="form-control" v-model="item.description"
                    name="name" id="name"/>
            </div>
            <select v-model="item.type" class="col-6">
                <label for="username">Type</label>
                <option>Dish</option>
                <option>Drink</option>
            </select>

            <br>
            <br>

        
        <a class="btn btn-primary pull-right" v-on:click.prevent="AddItem()">Add</a>
        <a class="btn btn-danger" v-on:click.prevent="cancelAdd()">Cancel</a>
        </form>

        
	</div>

</template>

<script type="text/javascript">

	// Component code (not registered)
	export default{
		data: function(){
           	return{
                item:{
                    name: '',         
                    price: '',
                    description: '',
                    type:''
               }
           }			
		},
        methods: {
            AddItem(){
                 axios.post('api/items/',this.item)
                   // .then(response => console.log("Success"))
                   .then(response => {
                       console.log(response);                        
                   })
                   .catch(error => console.log('Whoops'));
                
            },		


           cancelAdd: function(){
            axios.get('api/items/'+this.item.id)
                  .then(response=>{
                    Object.assign(this.item, response.data.data);
                    this.$emit('item-canceled', this.item);
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