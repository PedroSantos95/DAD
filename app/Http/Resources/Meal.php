<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Meal extends Resource
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
            'table_number' => $this->table_number,
            'responsible_waiter' => $this->responsible_waiter_id,
            'total_price_preview' => $this->total_price_preview,
        ];
    }
}
