<template>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Order ID</th>
				<th>State</th>
				<th>Item</th>
				<th>Meal</th>
				<th>Cook</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>			
			<tr v-for="order in orders"  :key="order.id" :style="colorOrder(order)">
				<td>{{ order.id }}</td>
				<td>{{ order.state }}</td>
				<td>{{ order.item_id }}</td>
				<td>{{ order.meal_id }}</td>
				<td>{{ order.responsible_cook_id }}</td>
				<td>
					<a class="btn btn-sm btn-primary" click.prevent="orderState(order)">State</a>
					<a v-if="order.state" class="btn btn-sm btn-danger" v-on:click.prevent="deleteOrder(order)">Delete</a>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script type="text/javascript">
	
	module.exports={
		props:["orders"],
		data: function () {
			return {
				confirmed: {color: 'green'},
				delivered: {color:'blue'},
				notDelivered: {color:'red'},
				prepared: {color:'grey'},
				currentOrder: null
			}
		},
		computed: {

		},
		methods: {
			orderState: function(order){
				this.$emit('order_state-click', order);
			},
			deleteOrder: function(order){
				this.currentOrder = null;
				this.$emit('delete-click', order);
			},
			colorOrder(order) {
				var style =""; 
				
				if(order.state === 'delivered') 
					style = 'background-color: lightblue';
				else if(order.state === 'confirmed')
					style = 'background-color: lightgreen';
				else if(order.state === ' notDelivered') 
					style = 'background-color: lightred';
				else if (order.state === 'prepared') 
					style = 'background-color: lightgrey';
				else{
					style=null;
				}
				
				return style;
			}
		}
	}
</script>

<style scoped>

</style>