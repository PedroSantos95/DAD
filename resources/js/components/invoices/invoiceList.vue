<template>
<div class="container" id="people">
    <div class="filter">
        <label><input type="radio" v-model="selectedType" value="All"/> All </label>
        <label><input type="radio" v-model="selectedType" value="Pending"/> Pending</label>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Table</th>
            <th>Waiter</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="invoice in invoicesType"  :key="invoice.id" :class="{activerow: currentInvoice === invoice}">
            <td>{{ invoice.name }}</td>
            <td>{{ invoice.meal.table_number }}</td>
            <td>{{ invoice.meal.responsible_waiter }}</td>
            <td>{{ invoice.total_price }}</td>
            <td>
                <button @click="invoiceInfo(invoice)" type="button" class="btn btn-info">Info</button>
               <!-- <button @click="invoiceEnd(invoice)" type="button" class="btn btn-danger">End</button>-->
            </td>
        </tr>
        </tbody>
    </table>
</div>
</template>
 
<script>
    
    module.exports = {
        props: ["invoices"],
        data: function() {
            return {
                showingInvoice:null,
                selectedType: 'Pending',
                currentInvoice:null
            };
        },
        methods: {
            invoiceInfo: function(invoice){
                this.showingInvoice = invoice;
                this.$emit('show-click', invoice);
            },
            invoiceEnd: function(invoice){
                this.currentInvoice = invoice;
                this.$emit('end-invoice', invoice);
            },
        },
        computed:{
            invoicesType: function() {
                var category = this.selectedType;
                if(category === "All") {
                    return this.invoices;
                }
                if(category ===  "Pending") {
                    return this.invoices.filter(function(invoice) {
                        return invoice.state =="not paid";
                    });
                }
                if(!category) {
                    return this.invoices.filter(function(invoice) {
                        return invoice.state =="not paid";
                    });
                }
            }
        },
    };
</script>
 
<style scoped>
    tr.activerow {
        background: #123456 !important;
        color: #fff !important;
    }
</style>