<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Product;
class CartController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        return view('users.cart');
    }
    public function getCart(Product $product){

        $products=$product->getProductCart();

        return response($products,'200');
    }
    public function addToCart($id,Request $request){

        if( ! Session::has('cart')){
                $request->session()->put('cart',[['product_id'=>$id,'quantity'=>1]]);
        }else{
            $items = Session::get('cart');
            $flag=0; // flag to check new session
            for($i=0;$i<=count($items);$i++){
                if(isset($items[$i])){
                    if($items[$i]['product_id'] == $id){
                        $flag=1;
                        $quantity = $items[$i]['quantity']+1;
                        $newSession = [$i=>['product_id'=>$id,'quantity'=>$quantity]];
                        Session::put('cart',array_replace($items,$newSession));
                    }
                }
            }
            if($flag==0){
                $index = count($items)+1;
                $newSession = [$index=>['product_id'=>$id,'quantity'=>1]];
                Session::put('cart',array_merge($items,$newSession));
            }
        }

        return response(Session::get('cart'),200);
    }

    public function minusQuantity($id,Product $product){
        if(Session::has('cart')){
            $items = Session::get('cart');
            for($i=0;$i<=count($items);$i++){
                if(isset($items[$i])){
                    if($items[$i]['quantity'] <= 1){
                        $this->delete($id,$product);
                    }else if($items[$i]['product_id'] == $id){
                        $quantity = $items[$i]['quantity']-1;
                        $newSession = [$i=>['product_id'=>$id,'quantity'=>$quantity]];
                        Session::put('cart',array_replace($items,$newSession));
                    }
                }
            }
        }
        $products=$product->getProductCart();
        return response($products,'200');
    }

    public function plusQuantity($id,Product $product){

        if(Session::has('cart')){
            $items = Session::get('cart');
            for($i=0;$i<=count($items);$i++){
                if(isset($items[$i])){
                    if($items[$i]['product_id'] == $id){
                        $quantity = $items[$i]['quantity']+1;
                        $newSession = [$i=>['product_id'=>$id,'quantity'=>$quantity]];
                        Session::put('cart',array_replace($items,$newSession));
                    }
                }
            }
        }

        $products=$product->getProductCart();
        return response($products,'200');
    }

    public function delete($id,Product $product){

        if(Session::has('cart')){
            $items = Session::get('cart');
            foreach($items as $key => $item)
            {
                if($items[$key]['product_id'] == $id){
                    Session::put('cart',array_except($items,$key));
                }
            }
        }

        $products=$product->getProductCart();
        return response($products,'200');
    }
}
