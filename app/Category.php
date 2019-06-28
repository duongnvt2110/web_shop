<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    //
    protected $table = 'categories';

    protected $guarded = [];

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function storeCategory($category){

        return $this->create([
            'name'=>$category->name,
            'slug'=>$category->slug,
        ]);

    }

    public function updateCategory($category){

        return $this->where('id',$category->id)->update([
            'name'=>$category->name,
            'slug'=>$category->slug,
        ]);

    }
}
