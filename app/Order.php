<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;

class Order extends Model
{

    use RecordsActivity;

    protected $table='orders';

    protected $guarded = [];

    protected $with = ['products','user'];

    protected static function boot(){

        parent::boot();

        // static::created(function($order){
        //     $order->activity()->create([
        //         'user_id' => auth()->id(),
        //         'type' => 'test',
        //     ]);
        // });
    }

    // public function activity()
    // {
    //     return $this->morphMany('App\Activity', 'activity');
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)
        ->withPivot(['quantity'])
        ->withTimestamps();
    }

    public function createOrder(){

        // $this->user_id = auth()->id();
        // dd($this->save());
        return $this->create([
            'user_id'=>auth()->id()
        ]);
    }
}
