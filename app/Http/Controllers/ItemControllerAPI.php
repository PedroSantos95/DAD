<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;


use App\Http\Resources\Item as ItemResource;
use Illuminate\Support\Facades\DB;

use App\Item;
use App\StoreItemRequest;
use Hash;




class ItemControllerAPI extends Controller
{
    public function getItems(Request $request)
    {
       return ItemResource::collection(Item::all());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
        $item = new Item();
        $item->fill($request->all());
        $item->save();
        return response()->json(new ItemResource($item), 201);
    }
    
    public function edit(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());
        return new ItemResource($item);
    }
   
   
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}
