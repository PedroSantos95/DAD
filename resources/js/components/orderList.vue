<template>
	<table class="table table-striped">
	    <thead>
	        <tr>
	            <th>Id</th>
	            <th>State</th>
	            <th>Item ID</th>
	            <th>Meal ID</th>
	            <th>Responsible Cook ID</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="order in orders"  :key="order.id">
	            <td>{{ order.id }}</td>
	            <td>{{ order.state }}</td>
	            <td>{{ order.item_id }}</td>
	            <td>{{ order.meal_id }}</td>
	            <td>{{ order.responsible_cook_id }}</td>
	        </tr>
	    </tbody>
	</table>
</template>

<script type="text/javascript">
	// Component code (not registered)
	module.exports={
        props: ['orders'],
        mounted(){
        }
	}
</script>

<style scoped>
	tr.activerow {
  		background: #123456  !important;
  		color: #fff          !important;
}
</style>