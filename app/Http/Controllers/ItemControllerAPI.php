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
        if ($request->has('page')) {
            return ItemResource::collection(Item::paginate(5));
        } else {
            return ItemResource::collection(Item::all());
        }
    }
}
