<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
class AdminController extends Controller
{
    //
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth:admin');
    }

    public function showAllOrder(){
        $order=Order::get();
        return response($order,'200');
    }

    public function locked($id){

        $this->user->where('id',$id)->update(['locked'=>'1']);

        return $this->user->latest()->paginate(10);
    }

    public function unlocked($id){

        $this->user->where('id',$id)->update(['locked'=>'0']);

        return $this->user->latest()->paginate(10);
    }

    public function search(Request $request){
        return $this->user->where('name','LIKE','%'.$request->search_text.'%')->paginate(10);
    }

    public function destroy($id)
    {
        //
        $user = User::find($id);

        $user->delete();

        $user = $this->user->latest()->paginate(10);

        return response($user,'200');
    }


}
