<?php
 
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
 
class Meal extends Model
{
     use Notifiable;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state',
        'table_number',
        'responsible_waiter_id',
        'total_price_preview',
    ];
 
    public function waiter()
    {
        return $this->belongsTo('App\User', 'responsible_waiter_id');
    }
}