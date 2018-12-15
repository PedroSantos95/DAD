<template>
	<table class="table table-striped">
	    <thead>
	        <tr>
	            <th>Table-Number</th>
	            <th>Resposible-Waiter</th>
	            <th>Total-Price</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr v-for="invoice in invoices"  :key="invoices.id">
	            <td>{{ invoice.table_number }}</td>
	            <td>{{ invoice.responsible_waiter_id }}</td> 
	            <td>{{ invoice.total_price }}</td>
	        </tr>
	    </tbody>
	</table>
</template>

<script type="text/javascript">
	// Component code (not registered)
	module.exports={
		props: ['invoices'],
	    methods: {
        	
        },
	}
</script>

<style scoped>
	tr.activerow {
  		background: #123456  !important;
  		color: #fff          !important;
}
</style>