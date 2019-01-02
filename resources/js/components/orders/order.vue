<template>
	<div>
		<div class="jumbotron">
			<h1>{{ title }}</h1>
		</div>

		<router-link to="/orders/new/orders"><button class="btn btn-xs btn-success">Add New Order</button> </router-link>

		<order-list :orders="orders" @set_state-click="orderState" @delete-click="deleteOrder" > </order-list>
		<!--<order-list :orders="orders" @delete-click="deleteOrder" @message="childMessage" ref="ordersListRef"></order-list> -->

		<div class="alert alert-success" v-if="showSuccess">

			<button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
			<strong>{{ successMessage }}</strong>
		</div>

	</div>
</template>

<script type="text/javascript">

	import OrderList from './orderList.vue';
	import OrderAdd from './orderAdd.vue';

	export default {
		data: function(){
			return {
				title: 'List of Orders',
				showSuccess: false,
				successMessage: '',
				currentOrder: null,
				orders: [],
				meals: [],
				items: []
			}
		},
		methods: {
			orderState: function(order){
				axios.post('api/orders/' + order.id)
						.then(response=>{
							if (order.state === 'pending') {
								order.state = 'confirmed';
							} else if(order.state === 'confirmed'){
								order.state = 'in preparation';
							} else if(order.state === 'in preparation'){
								order.state = 'prepared';
							} else if (order.state === 'prepared') {
								order.state = 'delivered';
							} else if(order.state === 'delivered'){
								order.state = 'not delivered';
							}
							Object.assign(order, response.data.data);
							this.$emit('message', this.message)
						})
						.catch(erros => {
							console.log(erros);
						})
			},
			deleteOrder: function(order){
				axios.delete('api/orders/'+order.id)
						.then(response => {
							this.showSuccess = true;
							this.successMessage = 'Order Deleted';
							this.getOrders();
						});
			},
			/*savedOrder: function(){
                this.currentOrder = null;
                this.$refs.ordersListRef.editingOrder = null;
                this.showSuccess = true;
                this.successMessage = 'Order Saved';
            },*/
	        getOrders: function(){
				console.log(this.$store.state.user.id);
                axios.get('/api/orders/'+this.$store.state.user.id).then(response=>{
				this.orders = response.data;})
				.catch(error=>{
					this.showFailure = true;
					this.failMessage = 'Error while fetching the existing orders!';
				});
			},
			childMessage: function(message){
				this.showSuccess = true;
				this.successMessage = message;
			}
	    },
	   	components: {
	    	'order-list': OrderList,
	    },
	    mounted() {
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