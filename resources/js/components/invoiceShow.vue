<template>
    <div class="jumbotron">
        <h2>Invoice Information</h2> <br>
        <div class="form-group">
            <label>Date:</label>
            <span>{{invoice.date}} </span>
        </div>
        <div class="form-group">
            <label>Table Number:</label>
            <span>{{invoice.table_number}} </span>
        </div>
        <div class="form-group">
            <label>Name Responsible Waiter:</label>
            <span>{{invoice.name}} </span>
        </div>
        <div class="form-group">
            <label>Total Price:</label>
            <span>{{invoice.total_price}} </span>
        </div>
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