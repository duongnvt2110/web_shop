<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
class ConfirmTokenController extends Controller
{
    //
    public function index(){

        $user = User::where('confirmation_token',request('token'))->first();

        // check if user not exists redirect login
        if(! $user){
            return redirect(route('login'))->with('flash', 'No User Exists.');
        }

        // update token
        $user->confirm();
        // Login after confirmed token
        Auth::guard()->login($user);

        return redirect('/home')->with('flash', 'Your account is now confirmed! You may post to the forum.');
    }
}
