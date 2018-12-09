<template>
	<table class="table table-striped">
	    <thead>
	        <tr>
	            <th>Id</th>
	            <th>State</th>
	            <th>Table Number</th>
	            <th>Responsible Waiter</th>
	            <th>Total Price Preview</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="meal in meals"  :key="meal.id">
	            <td>{{ meal.id }}</td>
	            <td>{{ meal.state }}</td>
	            <td>{{ meal.table_number }}</td>
	            <td>{{ meal.responsible_waiter }}</td>
	            <td>{{ meal.total_price_preview }}</td>
	        </tr>
	    </tbody>
	</table>
</template>

<script type="text/javascript">
	// Component code (not registered)
	module.exports={
        props: ['meals'],
        mounted(){
            console.log("OLA");
        }
	}
</script>

<style scoped>
	tr.activerow {
  		background: #123456  !important;
  		color: #fff          !important;
}
</style>