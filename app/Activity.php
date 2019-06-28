<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Activity extends Model
{
    //
    protected $guarded = [];


    public function activity(){

        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
