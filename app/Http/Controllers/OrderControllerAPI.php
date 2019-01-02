<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Resources\Notifiable\Notifiable;


use App\Http\Resources\Order as OrderResource;

use Notification;
use App\Order;



class OrderControllerAPI extends Controller
{
    public function getOrders(Request $request)
    {
      return orders::all();
    }

    public function add(Request $request)
    {
        $current = Carbon::now();
        $order = new Order();
        $order->id = null;
        $order->state = 'pending';
        $order->item_id = null;
        $order->meal_id= null;
        $order->responsible_cook_id = null;
        $order->start = $current;
        $order->end = null;
        $order->created_at = $current;
        $order->updated_at = $current;
        $order->fill($request->all());
        $order->save();
        return response()->json($order, 200);
    }

    public function orderState($id)
    {
        $order = order::findOrFail($id);
        if($order->state === 'confirmed'){
            $order->state = 'in preparation';
        } else if ($order->state === 'in preparation') {
            $order->state = 'prepared';
        } else if ($order->state === 'prepared') {
            $order->state = 'delivered';
        } else if ($order->state === 'delivered') {
            $order->state = 'confirmed';
        }
        $order->save();
        return response()->json($order,200);
    }
    public function confirmOrder($id)
    {
        $order = order::findOrFail($id);
        if($order->state === 'pending'){
            $order->state = 'confirmed';
        }
        $order->save();
        return response()->json($order,200);
    }


    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return new OrderResource($order);
    }
    
    
    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(null, 204);
    }

    public function getDailyOrders(User $user){
        
    }

}
