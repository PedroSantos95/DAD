<template>
	<table class="table table-striped">
	    <thead>
	        <tr>
	            <th>Item</th>
	            <th>Type</th>
	            <th>Description</th>
	            <th>Price</th>
	            <th>Photo</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="item in items"  :key="item.id">
	            <td>{{ item.id }}</td>
	            <td>{{ item.type }}</td>
	            <td>{{ item.description }}</td>
	            <td>{{ item.price }}</td>
	            <td><img width="100px" :src ="getProfilePhoto(item.photo_url)"></td>
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
        	}
        },
	}
</script>

<style scoped>
	tr.activerow {
  		background: #123456  !important;
  		color: #fff          !important;
}
</style>