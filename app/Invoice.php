<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
 
class Invoice extends Model
{
   
    protected $fillable = [
        'id',
        'name',
        'type',
        'description',
        'photo_url',
        'price',
    ];
 
    public function meal()
    {
        return $this->belongsTo('App\Meal');
    }
}