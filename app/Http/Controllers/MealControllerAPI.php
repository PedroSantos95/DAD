<?php
namespace App\Http\Controllers;
use App\Meal;
use Illuminate\Http\Request;
use App\Http\Resources\Meal as MealResource;
use SebastianBergmann\Environment\Console;
use DB;
class MealControllerAPI extends Controller
{
    public function getMeals(Request $request)
    {
        return Meal::all();
    }
    public function add(Request $request)
    {
        $meal = new Meal();
        $meal->fill($request->all());
        $meal->state ="active";
        $mytime = Carbon\Carbon::now();
        $meal->start = $mytime->toDateTimeString();
        $meal->save();
        return response()->json($meal, 200);
    }

    public function showMeal(Request $request, $id){
        $meals = Meal::findOrFail($id);
        $meals = DB::table('orders')
            ->join('items', 'items.id', '=', 'orders.item_id')
            ->join('meals', 'meals.id', '=', 'orders.meal_id')
            ->select('meals.table_number', 'meals.total_price_preview', 'items.name', 'items.price')
            ->where('meals.id', $id)
            ->get();
        return $meals;
    }

    public function getDailyMeals(User $user){

    }

}