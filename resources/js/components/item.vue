<template>
	<div>
		<div class="jumbotron">
			<h1>{{ title }}</h1>
		</div>

		<item-list :items="items" ref="itemsListRef" ></item-list>

		</div>							
</template>

<script type="text/javascript">

	export default {
		data: function(){
			return { 
		        title: 'List Items',
		        items: []
			}
		},
	    methods: {
	        getItems: function(){
	            axios.get('api/items')
	                .then(response=>{this.items = response.data.data;});
			},
			
	    },
	    mounted(){
	    	this.getItems();
	    }

	}
</script>

<style scoped>	
p {
	font-size: 2em;
	text-align: center;
}
</style>