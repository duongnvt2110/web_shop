<?php

namespace App;
use Eloquent;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Auth;
use App\Activity;
use App\Order;
class User extends Eloquent implements Authenticatable
{
    use Notifiable, AuthenticableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded =['name'];

    // protected $with = ['activity'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function activity(){
        return $this->hasMany(Activity::class);
    }
    public function isAdmin(){

        return in_array($this->name,["admin"]);

    }

    public function confirm()
    {
        $this->update([
            'confirmed'=>true,
            'confirmation_token'=>null
        ]);
        // $this->confirmed = true;
        // $this->confirmation_token = null;
        // $this->save();
    }

}
