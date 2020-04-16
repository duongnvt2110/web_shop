<?php 

namespace App\Filters;

use Illuminate\Http\Request;

use App\Filters\Filters;

class ProductFilters extends Filters{

    protected $filters = ['text','category','price'];

    public function category($categoryId){
        return $this->builder->where('category_id','=',$categoryId)->paginate(10);
    } 

    public function text($searchText){
        return $this->builder->where('product_name','like','%'.$searchText.'%')->paginate(10);
    }

    public function price($price){
        return $this->builder->where('price','=',$price)->paginate(10);
    }

}