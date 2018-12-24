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
            'id' =>$this->id,
            'state'=>$this->state,
            'meal'=> new Meal($this->meal),
            'nif'=>$this->nif,
            'name'=>$this->name,
            'date'=>$this->date,
            'total_price'=>$this->total_price,
        ];
    }
}