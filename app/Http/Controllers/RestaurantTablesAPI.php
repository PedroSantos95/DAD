<?php
namespace App\Http\Controllers;
use App\RestaurantTable;
use Illuminate\Http\Request;
use DB;
use App\Http\Resources\RestaurantTable as RestaurantTableResource;
use Carbon\Carbon;

class RestaurantTableControllerAPI extends Controller
{
    public function getRestaurantTables(Request $request)
    {
        return  RestaurantTable::all();
    }

    public function destroy(Request $request)
    {
        $tableNumber = $request->query('tableDelete');
        $table = RestaurantTable::withTrashed()->findOrFail($tableNumber);
        $meals = DB::table('meals')
            ->where('meals.responsible_waiter_id', $tableNumber)
            ->count();
        if($meals!=0){
            $table->delete();
        }else{
            $table->forceDelete();
        }
        return response()->json(null, 204);
    }

    public function update(Request $request, RestaurantTable $table)
    {
        $request->validate([
            'table_number' => 'unique:restaurant_tables',
        ]);
        $table->table_number = $request->newTableNumber;
        $table->save();
        return response()->json($table,200);
    }
    
    public function showTable(Request $request, $id){
        $items = Invoice::findOrFail($id);
        $items = DB::table('invoice_items')
            ->join('items', 'invoice_items.item_id', '=', 'items.id')
            ->select('invoice_items.quantity', 'invoice_items.unit_price', 'invoice_items.sub_total_price', 'items.name')
            ->where('invoice_items.invoice_id', $id)
            ->get();
        return $items;
    }
    public function add(Request $request)
    {
        
        $restaurant_table = new RestaurantTable();
        $current = Carbon::now();
        $restaurant_table->created_at = $current;
        $restaurant_table->fill($request->all());
        $restaurant_table->save();
        return response()->json($restaurant_table, 200);
    }
}