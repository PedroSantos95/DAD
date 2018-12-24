<template>
    <div>
        <div class="jumbotron">
            <h1>{{this.$store.state.user.name}} Orders</h1>
            <!-- 
                CRIAR TEMPLATE !
            -->
    </div>
</div>
</template>

<script type="text/javascript">
export default {
    data: 
    function() {
        return {
            orders: [],
        };
    },
    methods: {
        getOrders: function() {
            axios.get('api/users/orders/'+this.$store.state.user.id)
            .then(
                response=>{
                    console.log(response.data.data);
                    this.orders = response.data.data;
                }).catch(error=>{
                    console.log(error.response.data);
                });
            },
        },
        mounted() {
            this.getOrders();
        },
    };
</script>

<style scoped>
	tr.activerow {
  		background: #123456  !important;
  		color: #fff          !important;
}
</style>