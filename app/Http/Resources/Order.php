<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Order extends Resource
{

    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'state' => $this->state,
            'item_id' => $this->item_id,
            'meal_id' => $this->meal_id,
            'responsible_cook_id' => $this->responsible_cook_id,
        ];
    }
}
