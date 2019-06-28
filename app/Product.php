<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Admin;
use App\User;
use App\Order;
use Session;
class Product extends Model
{
    //
    protected $table='products';

    protected $guarded = [];

    // public function user(){

    //     return $this->belongsTo(User::class);

    // }

    public function admin(){

        return $this->belongsTo(Admin::class);

    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }

    /** The product belong to product*/
    public function category(){

        return $this->belongsTo(Category::class);
    }

     /** */
    public function getProduct(){

        return $this->get();

    }
    public function getProductCart(){
        $products = [];
        if(Session::has('cart')){
            foreach(Session::get('cart') as $item){
                $product= $this->find($item['product_id'])->toArray();
                $product['quantity']=$item['quantity'];
                if(! in_array($product,$products)){
                    array_push($products,$product);
                }
            }
        }
        return collect($products);
    }
    public function storeProduct($product){

        return $this->create([
            'admin_id'=>auth()->guard('admin')->id(),
            'category_id'=>$product->category_id,
            'product_name'=>$product->product_name,
            'slug'=>str_slug($product->product_name),
            'thumnail'=>$product->thumnail,
            'image'=>json_encode($product->image),
            'short_description'=>$product->short_description,
            'full_description'=>$product->full_description,
            'published'=>$product->published,
            'price'=>$product->price,
            'tax'=>$product->tax,
            'fee_ship'=>$product->fee_ship,
        ]);

    }
    public function updateProduct($product){

        return $this->where('id',$product->id)
            ->update([
            'admin_id'=>auth()->guard('admin')->id(),
            'category_id'=>$product->category_id,
            'product_name'=>$product->product_name,
            'slug'=>str_slug($product->product_name),
            'thumnail'=>$product->thumnail,
            'image'=>json_encode($product->image),
            'short_description'=>$product->short_description,
            'full_description'=>$product->full_description,
            'published'=>$product->published,
            'price'=>$product->price,
            'tax'=>$product->tax,
            'fee_ship'=>$product->fee_ship,
        ]);

    }
}
