<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class Invoice extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'state' => $this->state,
            'meal_id' => $this->meal_id,
            'table_number' => $this->table_number,
            'nif' => $this->nif,
            'name' => $this->name,
            'date' => $this->date,
            'total_price' => $this->total_price,

            'resposible_waiter_id' => $this->meal->resposible_waiter_id,
            'table_number' => $this->meal->table_number        
        ];
    }
}