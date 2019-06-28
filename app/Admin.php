<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = ['name'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function product(){

        return $this->hasMany(Product::class);

    }
}
