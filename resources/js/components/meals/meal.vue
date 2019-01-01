<template>

	<div>
		<div class="jumbotron">
			<h1>{{ title }}</h1>
		</div>
		<router-link to="/meals/start"> <button class="btn btn-xs btn-success">Start</button></router-link>
		<div>
			<meal-list :meals="meals"  @show-click="mealShow" ></meal-list>
			<meal-show :meal="currentMeal" :meals="meals" v-if="currentMeal"></meal-show>
		</div>
	</div>

</template>
<script type="text/javascript">

	import mealList	 from './mealList.vue';
	import mealInfo from './mealInfo.vue';
	import mealStart from './mealStart.vue';

	export default {
		data: function(){
			return {
				title: 'List of Meals',
				showSuccess: false,
				successMessage: '',
				currentMeal: null,
				showingMeal: false,
				meals:[],
			}
		},
		methods: {
			getMeals: function(){
				axios.get('api/meals')
						.then(response=>{this.meals = response.data;});
			},

			mealShow: function (meal) {
				console.log(meal);
				this.currentMeal = meal;
				this.showSuccess = false;
				axios.get('api/meals/'+ meal.id)
						.then(response => {
							this.meals=response.data;
							console.log(response);
						});
			},
		},
		mounted() {
			this.getMeals();
		},
		components: {
			'meal-list': mealList,
			'meal-info': mealInfo,
			'meal-start':mealStart,
		},
	}
</script>

<style scoped>
	p {
		font-size: 2em;
		text-align: center;
	}
</style>