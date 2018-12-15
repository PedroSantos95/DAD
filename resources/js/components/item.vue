<template>
	<div>
		<div class="jumbotron">
			<h1>{{ title }}</h1>
		</div>

		<div>
			<router-link to="/items/new/item"> <button>Add</button></router-link>
		</div>

	  <item-edit :item="currentItem" @item-saved="saveItem"  @item-canceled="cancelEdit" v-if="currentItem"></item-edit>
        
      <item-list :items="items" @delete-click="deleteItem" ref="itemsListRef" @edit-click="editItem"></item-list>

	</div>			


</template>

<script type="text/javascript">

	import ItemList from './itemList.vue';
    import ItemEdit from './itemEdit.vue';

	export default {
		data: function(){
			return { 
		        title:'List item',
		        editingItem: false,
				showSuccess: false,
				showFailure: false,
				successMessage: '',
				failMessage: '',
				currentItem: null,
				currentItemIndex: -1,
				items: [],
			}
		},
	    methods: {
	        getItems: function(){
	            axios.get('api/items')
	                .then(response=>{this.items = response.data.data;});
			},

			editItem: function(item){
	            this.currentItem = item;
				this.showSuccess = false;
				
			},

            deleteItem: function(item){		
	             axios.delete('api/items/', {params:{id:item.id}})
	                .then(response => {
	                    this.showSuccess = true;
						this.successMessage = 'Item Deleted';
						this.getItems();	                    
	                }); 
			},

            saveItem: function(){
                this.currentItem = null;
                this.$refs.itemsListRef.editingItem = null;
                this.showSuccess = true;
                this.successMessage = 'Item Saved';
            },
            cancelEdit: function(){
                this.currentItem = null;
                this.$refs.itemsListRef.editingItem = null;
                this.showSuccess = false;
            },
			
	    },
	    mounted(){
	    	this.getItems();
	    },
	    components: {
            'item-list': ItemList,
            'item-edit': ItemEdit
        }, 


	}
</script>

<style scoped>	
p {
	font-size: 2em;
	text-align: center;
}
</style>