<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepositoryInterface $category)
    {
    	$this->category = $category;
    }

    public function index(){

        return view('categories.index');

    }

    public function paginate(){

        return $this->category->paginate();

        // return response()->json($categories);
    }

    public function store(Request $request,Category $category){

        $request->validate([
            'slug'=>'required|unique:categories',
            'name'=>'required|unique:categories'
        ]);

        $this->category->create([
            'name'=>$category->name,
            'slug'=>$category->slug,
        ]);

        $category=$this->category->paginate();
        // $request->session()->flash('flash','Created New Category');

        return response($category,200);

    }

    public function destroy($id){

        $category=$this->category->find($id);

        $category->delete();

        $category= $this->category->paginate();

        return response($category,200);
    }

    public function edit($id)
    {
        $category=$this->category->find($id);
        return response($category,200);
    }

    public function update(Request $request){

        $request->validate([
            'slug'=>'required|unique:categories,slug,'.$request->id,
            'name'=>'required|unique:categories,name,'.$request->id
        ]);

        $this->category->update($request->id,[ 
            'name'=>$request->name,
            'slug'=>$request->slug
        ]);

        $category=$this->category->paginate();

        return response($category,200);
    }
}
