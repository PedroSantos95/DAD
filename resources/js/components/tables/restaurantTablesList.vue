<template>
	<div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Table Number</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="restaurant_table in restaurant_tables"  :key="restaurant_table.table_number" :class="{activerow: editingTable === restaurant_table}">
					<td>restaurant_table.table_number</td>
					<td>
						<a  class="btn btn-sm btn-primary"  v-on:click.prevent="editTable(restaurant_table)">Edit</a>
						<a  class="btn btn-sm btn-danger" v-on:click.prevent="deleteTable(restaurant_table)">Delete</a>
                        <button  @click="showTable(restaurant_table)">Show</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script type="text/javascript">
	
	module.exports={
		props:["restaurant_tables"],
		data: function () {
			return {
				showingTable: null,
                currentTable: null,
                editingTable: null,
			}
		},
		methods: {
			editTable: function(restaurant_table){
                this.editingTable = restaurant_table;
				this.$emit('edit-table-click', restaurant_table);
			},
			deleteTable: function(restaurant_table){
				this.currentTable = restaurant_table;
				this.$emit('delete-click', restaurant_table);
			},
            showTable: function(restaurant_table){
                this.showingTable = restaurant_table;
                this.$emit('show-restaurant-table-click', restaurant_table);
            },
		},
	}
</script>

<style scoped>
	
</style>