<template>
    <div>
        <div class="container" id="meals">
             <div class="filter">
                <label><input type="radio" v-model="selectedCategory" value="paid"/> Paid</label>
                <label><input type="radio" v-model="selectedCategory" value="not paid"/> Not Paid</label>
                <label><input type="radio" v-model="selectedCategory" value="terminated"/> Terminated</label>
                <label for="active"> <input id="active" type="radio" v-model="selectedCategory" value="active"/>Active</label>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>State</th>
                    <th>TableNumber</th>
                    <th>Responsible Waiter</th>
                    <th>Total Price Preview</th>
                    <th>Start</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="meal in filteredMeals" :key="meal.id" >
                    <td>{{ meal.id }}</td>
                    <td>{{ meal.state }}</td>
                    <td>{{ meal.table_number }}</td>
                    <td>{{ meal.responsible_waiter_id }}</td>
                    <td>{{ meal.total_price_preview}}</td>
                    <td>{{ meal.start }}</td>
                    <td>
                        <button v-if="meal.state=='active'" @click="mealShow(meal)">Show</button>
                    </td>
           
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script type="text/javascript">
    
    export default {
        props: ["meals"],
        data: function () {
            return {
                selectedCategory: '',
                writtenNumber: '',
                writtenDate: '',
                showingMeal: null,
            };
        },
        methods: {
            getDate(date) {
                return moment(date, 'YYYY-MM-DD').format('YYYY-MM-DD');
            },

            mealShow: function (meal) {
                this.showingMeal = meal;
                this.$emit('show-click', meal);
            },
        },
       computed: {
            filteredMeals() {
            	
                let category = this.selectedCategory;
                let inputValue = this.writtenNumber;
                let inputDate = this.writtenDate;

                return this.meals.filter((meal) => {
                    if (category === '' && (meal.state === 'active' || meal.state === 'terminated')) {
                        return true;
                    }
                    if (category === meal.state) {
                        if (inputValue === '') {
                            return true;
                        }
                        if (inputValue.toString() === meal.responsible_waiter_id.toString()) {
                            return true;
                        }
                        return false;
                    }
                    return false;
                });
            }
        }
    }
</script>

<style scoped>
    tr.activerow {
        background: #123456 !important;
        color: #fff !important;
    }
</style>