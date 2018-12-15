<template>
	<div class="jumbotron">
	    <h2>Edit Item</h2>
	    <div class="form-group">
	        <label for="inputName">Type</label>
	        <input
	            type="text" class="form-control" v-model="selectedItem.type"
	            name="type" id="inputType" 
	           />
	    </div>
	    <div class="form-group">
	        <label for="inputPrice">Description</label>
	        <input
	            type="text" class="form-control" v-model="selectedItem.description"
	            name="description" id="inputDescription"
	            placeholder="Description"/>
	    </div>
	    <div class="form-group">
	        <label for="inputPrice">price</label>
	        <input
	            type="price" class="form-control" v-model="selectedItem.price"
	            name="price" id="inputPrice"
	            placeholder="Price"/>
	    </div>	    

	    <div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="saveItem()">Save</a>
	        <a class="btn btn-danger" v-on:click.prevent="cancelEdit()">Cancel</a>
	    </div>
	</div>
</template>

<script type="text/javascript">
	module.exports={
		props: ['item'],
        data() {
            return {
               selectedItem: Object.assign({}, this.item)
            }
        },
	    methods: {
	         saveItem: function(){
	            axios.put('api/items/' + this.item.id, this.selectedItem)
	                .then(response=>{
	                	Object.assign(this.item, response.data.data);
	                	this.$emit('item-saved', this.item);
	                });
	        },

	        cancelEdit: function(){
	        	
	        	this.$emit('item-canceled', this.selectedItem);
	        	/*
	        	axios.get('api/items/'+this.item.id)
	                .then(response=>{
	                	Object.assign(this.item, response.data.data);
	                	this.$emit('item-canceled', this.item);
	                });
          		*/
          		this.selectedItem
	        }
		},
		watch: {
			item: function (value) {
				console.log(value)
				this.selectedItem = Object.assign({}, value);
			}
		}
	}
</script>

<style scoped>	
</style>