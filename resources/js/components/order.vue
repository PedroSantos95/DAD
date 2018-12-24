<template>
	<div>
		<div class="jumbotron">
			<h1>{{ title }}</h1>
		</div>

		<order-list :orders="orders" ref="orderListRef" ></order-list>

		</div>							
</template>

<script type="text/javascript">

	export default {
		data: function(){
			return { 
		        title: 'List Orders',
		        orders: []
			}
		},
	    methods: {
	        getOrders: function(){
	            axios.get('api/orders')
	                .then(response=>{this.order = response.data.data;});
			},
			
	    },
	    mounted(){
	    	this.getOrders();
        }
	}
</script>

<style scoped>	
p {
	font-size: 2em;
	text-align: center;
}
</style>