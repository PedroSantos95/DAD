<template>
	<div class="jumbotron">
	    <h2>End invoice</h2>
	    <div class="form-group">
	        <label for="inputTableNumber">NIF</label>
	        <input
	            type="number" class="form-control" v-model="invoice.nif"
	            name="nif" id="inputNIF" 
	            placeholder="NIF"/>
	    </div>
	    <div class="form-group">
	        <label for="name">Name</label>
	        <input
	            type="string" class="form-control" v-model="invoice.name"
	            name="name" id="inputName"
	            placeholder="Name"/>
	    </div>
	    <div>
        	<label>State</label>
        	<select v-model="invoice.state">
            	<option>Paid</option>
            	<option>Not paid</option>
        	</select>
    	</div>
	    <div class="form-group">
	        <a class="btn btn-primary" v-on:click.prevent="saveInvoice()">Save</a>
	        <a class="btn btn-light" v-on:click.prevent="cancelClose()">Cancel</a>
	    </div>
	</div>
</template>

<script type="text/javascript">
	module.exports={
		props: ['invoice'],

	    methods: {
	        saveInvoice: function(){
	            axios.post('api/invoices/'+this.invoice.id, this.invoice)
	                .then(response=>{
	                	// Copy object properties from response.data.data to this.user
	                	// without creating a new reference
	                	Object.assign(this.invoice, response.data.data);
	                	this.$emit('invoice-closed', this.invoice)
	                });
	        },
	        cancelEnd: function(){
	        	axios.get('api/invoice/'+this.invoice.id)
	                .then(response=>{
	                	// Copy object properties from response.data.data to this.user
	                	// without creating a new reference
	                	Object.assign(this.invoice, response.data.data);
	                	this.$emit('invoice-canceled', this.invoice);
	                });
	        }
		}
	}
</script>

<style scoped>	
</style>