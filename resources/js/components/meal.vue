<template>
	<div>
		<div class="jumbotron">
			<h1>{{ title }}</h1>
		</div>

		<meal-list :meals="meals" ref="mealsListRef" ></meal-list>

		</div>							
</template>

<script type="text/javascript">

	export default {
		data: function(){
			return { 
		        title: 'List Orders',
		        meals: []
			}
		},
	    methods: {
	        getMeals: function(){
	            axios.get('api/meals')
	                .then(response=>{this.meals = response.data.data;});
			},
			
	    },
	    mounted(){
	    	this.getMeals();
        }
	}
</script>

<style scoped>	
p {
	font-size: 2em;
	text-align: center;
}
</style>