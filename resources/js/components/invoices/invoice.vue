<template>
 
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>
        <div>
             <invoice-list :invoices="invoices"  @show-click="infoInvoice" @close-invoice="closeInvoice" ref="mealsListRef"></invoice-list>

            <div class="alert alert-success" v-if="showSuccess">             
            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
            </div>
                <invoice-info :invoice="currentInvoice" @invoice-saved="saveInvoice" @invoice-canceled="cancelEdit" :items="items" v-if="currentInvoice" ></invoice-info>
                <end-invoice :invoice="currentInvoice"  @invoice-saved="saveInvoice" @invoice-canceled="cancelEdit" v-if="currentInvoice"></end-invoice>
            </div>
    </div>
 
</template>
 
<script type="text/javascript">
 
    import InvoiceList from './invoiceList.vue';
    import InvoiceInfo from './invoiceInfo.vue';
    import InvoiceEnd  from './invoiceEnd.vue';
 
    export default {
        data: function () {
            return {
                title: 'List of invoices',
                showingInvoice: false,
                currentInvoice: null,
                showSuccess: false,
                showFailure: false,
                successMessage: '',
                failMessage: '',
                currentInvoiceIndex: -1,
                invoices: [],
                items:[]
            }
        },
        methods: {
            getInvoices: function () {
                axios.get('api/invoices')
                    .then(response => {
                        this.invoices = response.data.data;
                    }); 
            },
            infoInvoice: function (invoice) {
                this.currentInvoice = invoice;
                this.showSuccess = false;
                axios.get('api/invoices/'+ invoice.id)
                    .then(response => {
                        this.items=response.data;
                        console.log(response);
                    });
            },
            saveUser: function(){
                this.currentUser = null;
                this.$refs.usersListRef.editingUser = null;
                this.showSuccess = true;
                this.successMessage = 'User Saved';
                this.$socket.emit('user_changed', savedUser)
            },

            closeInvoice: function(invoice){
                this.currentInvoice = invoice;
                this.showSuccess = false;
            },
            saveInvoice: function(){
                this.currentInvoice = null;
                this.$refs.invoicesListRef.currentInvoice = null;
                this.showSuccess = true;
                this.successMessage = 'Invoice Saved';
            },
            cancelEdit: function(){
                this.currentMeal = null;
                this.$refs.invoicesListRef.currentInvoice = null;
                this.showSuccess = false;
            },
        },
        components: {
            'invoice-list': InvoiceList,
            'invoice-info': InvoiceInfo,
            'invoice-end': InvoiceEnd,
        },
        mounted() {
            this.getInvoices();
        }
    }
</script>
 
<style scoped>
    p {
        font-size: 2em;
        text-align: center;
    }
</style>