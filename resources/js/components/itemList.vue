<template>
	<table class="table table-striped">
	    <thead>
	        <tr>
	            <th>Item</th>
	            <th>Type</th>
	            <th>Description</th>
	            <th>Price</th>
	            <th>Photo</th>
	            <th>Actions</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="item in items"  :key="item.id">
	            <td>{{ item.id }}</td>
	            <td>{{ item.type }}</td>
	            <td>{{ item.description }}</td>
	            <td>{{ item.price }}</td>
	            <!--<td><img width="100px" :src ="getProfilePhoto(item.photo_url)"></td>-->
	            <td><button @click="editItem(item)">edit</button>
                    <button @click="deleteItem(item)">Delete</button></td></td>
	        </tr>
	    </tbody>
	</table>
</template>

<script type="text/javascript">
	// Component code (not registered)
	module.exports={
		props: ['items'],
	    methods: {
        	getProfilePhoto(photo_url){
        		return `img/items/${photo_url}`;
        	},
        	editItem: function(item){
                this.editingItem = item;
                this.$emit('edit-click', item);
			},
			deleteItem: function(item){
				this.$emit('delete-click', item);
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