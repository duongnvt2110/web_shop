<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\User;

class OrderController extends Controller
{
    //
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.order');
    }



    public function buyIt(Order $order,Request $request){

        $items = $request->all();

        $data = $order->createOrder();

        foreach($items['data'] as $item){
            $product = Product::find($item['id']);
            $data->products()->attach($product,
                [   'quantity' => $item['quantity'],
                ]
            );
        }

        $request->session()->forget('cart');

        return response('ok','200');
    }

    public function deleteOrder($order_id){

        $order = Order::find($order_id);

        $order->delete();

        $user = User::find(auth()->id());

        $order=$user->orders()
        ->with('products')
        ->get();
        return response($order,'200');
    }

    public function cancelOrder($order_id){

        Order::where('id',$order_id)->update([
            'confirm'=>null,
            'cancel'=>true,
            'delivery'=>null,
        ]);

        $user = User::find(auth()->id());

        $order=$user->orders()
        ->with('products')
        ->get();

        return response($order,'200');
    }

    public function confirmOrder($order_id){

        Order::where('id',$order_id)->update([
            'confirm'=>true,
            'cancel'=>null,
            'delivery'=>null,
        ]);

        $user = User::find(auth()->id());

        $order=$user->orders()
        ->with('products')
        ->get();

        return response($order,'200');
    }

    public function deliveryOrder($order_id){

        Order::where('id',$order_id)->update([
            'cancel'=>null,
            'delivery'=>true,
        ]);

        $user = User::find(auth()->id());

        $order=$user->orders()
        ->with('products')
        ->get();

        return response($order,'200');
    }

    public function searchOrder(Request $request)
    {
        if($request->latest){
            $orderLatest = $request->latest;
        }else{
            $orderLatest = 'DESC';
        }
        // where('name','LIKE','%'.$test.'%');
        return $this->order
        ->orderBy('created_at',$orderLatest)
        ->paginate(10);

    }
}
