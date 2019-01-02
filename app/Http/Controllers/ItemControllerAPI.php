<?php
namespace App\Http\Controllers;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Resources\Item as ItemResource;
use Illuminate\Support\Facades\DB;
class ItemControllerAPI extends Controller
{
    public function getItems(Request $request)
    {
        return ItemResource::collection(Item::all());
        
    }
    public function add(Request $request)
    {
        $item = new Item();
        $item->fill($request->all()); 
        $item->photo_url= ""; 
        $item->save();
        return response()->json($item,200);
    } 
    public function edit(Request $request)
    {
        $id = $request->query('id');
        $item = Item::findOrFail($id);
        $item->update($request->all());
        return response()->json($item,200);
    }
    public function destroy(Request $request)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

   /* public function restoreDestroy($id)
    {
        Item::withTrashed()->find($id)->restore();
        return response()->json(null, 204);;
    }*/
   
}