<template>
	<div>
		<div class="jumbotron">
			<h1>{{ title }}</h1>
		</div>

		<invoice-list :invoices="invoices" ref="invoicesListRef" ></invoice-list>

		</div>							
</template>

<script type="text/javascript">

	export default {
		data: function(){
			return { 
		        title: 'List of "Pending" Invoices',
                invoices: [],
                showSuccess: false,
                showFailure: false,
                failMessage: '',
                successMessage: '',
			}
		},
	    methods: {
	       getPendingInvoices: function(){
	            axios.get('api/invoices')
	                .then(response=>{this.invoices  = response.data.data;});
			},
	    },
	    mounted(){
	    	this.getPendingInvoices();
	    }

	}
</script>

<style scoped>	
p {
	font-size: 2em;
	text-align: center;
}
</style>