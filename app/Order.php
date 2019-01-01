<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use App\User;

class Order extends Model
{
     use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state',
        'item_id', 
        'meal_id',
        'responsible_cook_id',
    ];

    public function meals()
    {
        return $this->belongsTo(Meal::class);
    }
    public function cookers()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}