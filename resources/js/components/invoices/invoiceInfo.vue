<template>
    <div class="jumbotron">
        <h2>Invoice Information</h2> <br>
        <div class="form-group"> <label>Date:</label>
            <span>{{invoice.date}} </span>
        </div>
        <div class="form-group"> <label>Table Number:</label>
            <span>{{invoice.meal.table_number}} </span>
        </div>
        <div class="form-group"> <label>Name Responsible Waiter:</label>
            <span>{{invoice.meal.responsible_waiter}} </span>
        </div>
        <div class="form-group"> <label>Total Price:</label>
            <span>{{invoice.total_price}} </span>
        </div>
        <table class="table table-striped">
        <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total Price</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in items"  :key="index">
            <td>{{ item.name }}</td>
            <td>{{ item.quantity }}</td>
            <td>{{ item.unit_price }}</td>
            <td>{{ item.sub_total_price }}</td>
        </tr>
        </tbody>
    </table>
    </div>
</template>
 
<script type="text/javascript">
        module.exports= {
            props: ['invoice','items'],
            data() {
                return {
                }
            },
            methods: {
            }
        }
</script>
 
<style scoped>
</style>