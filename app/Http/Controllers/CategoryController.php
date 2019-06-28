<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
//
    public function __construct(Category $category)
    {
    	$this->category = $category;
    }
    public function index(){

        return view('categories.index');

    }

    public function paginate(){

        return $this->category->latest()->paginate(10);

        // return response()->json($categories);
    }

    public function store(Request $request,Category $category){

        $request->validate([
            'slug'=>'required|unique:categories',
            'name'=>'required|unique:categories'
        ]);

        $category->storeCategory($request);

        $category=Category::latest()->paginate(10);
        // $request->session()->flash('flash','Created New Category');

        return response($category,200);

    }

    public function destroy($id){

        $category=Category::find($id);

        $category->delete();

        $category= $this->category->latest()->paginate(10);

        return response($category,200);
    }

    public function edit($id)
    {

        $category = Category::find($id);

        return response($category,200);
    }

    public function update(Request $request ,Category $category){

        $request->validate([
            'slug'=>'required|unique:categories,slug,'.$request->id,
            'name'=>'required|unique:categories,name,'.$request->id
        ]);

        $category->updateCategory($request);

        $category=$this->category->latest()->paginate(10);

        return response($category,200);
    }
}
