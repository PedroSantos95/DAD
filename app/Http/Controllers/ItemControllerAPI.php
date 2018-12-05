<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Resources\Notifiable\Notifiable;


use App\Http\Resources\Item as ItemResource;

use Notification;
use App\Item;



class ItemControllerAPI extends Controller
{
    public function getItems(Request $request)
    {
       return ItemResource::collection(Item::all());
    }

}
