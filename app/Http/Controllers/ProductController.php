<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
class ProductController extends Controller
{

    public function __construct(Product $product)
    {
        $this->product = $product;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {
        // Validate parameter not space
        $request->validate([
            'category_id'=>'required',
            'product_name'=>'required|unique:products',
            'short_description'=>'required',
            'full_description'=>'required',
            'thumnail'=>'required|'
        ]);
        // create product and update database
        $product->storeProduct($request);

        return back()->with('flash','Product have been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $categories = Category::all();

        return view('products.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = Product::find($id);

        return view('products.edit',compact('product','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        //
        try{
            $item=Product::find($request->id);

            $this->authorize('update',$item);

            // Validate
            $request->validate([
                'category_id'=>'required',
                'product_name'=>'required|unique:products,product_name,'.$request->id,
                'short_description'=>'required',
                'full_description'=>'required',
            ]);

            $product->updateProduct($request);

            return back()->with('flash','Product have been updated');

        }catch (\Exception $e){

            return back()->with('error',$e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        try {
            $product = Product::find($id);

            $this->authorize('delete',$product);

            $product->delete();

            $product = $this->product->latest()->paginate(10);

            return response($product,'200');

        } catch (\Exception $e) {

            return response($e->getMessage(),403);

        }

    }

    public function paginate()
    {
        return $this->product->latest()->paginate(10);
    }

    public function search(Request $request)
    {

        $orderPrice = 'DESC';

        if($request->price){
            $orderPrice = $request->price;
        }

        if($request->category){

            return $this->product
            ->where([
                ['product_name','LIKE','%'.$request->search_text.'%'],
                ['category_id','=',$request->category]
            ])
            ->orderBy('price',$orderPrice)
            ->paginate(10);

        }else{

            return $this->product
            ->where('product_name','LIKE','%'.$request->search_text.'%')
            ->orderBy('price',$orderPrice)
            ->paginate(10);
        }

    }
}
