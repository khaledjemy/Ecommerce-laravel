<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\Common;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Common;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id','category_name')->get();
        return view('admin.addProduct',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string',
            'price'=>'required|numeric',
            'rate'=>'required|numeric',
            'published'=>'boolean',
            'category_id'=>'required|integer|exists:categories,id',
            'image' =>'required|mimes:png,jpg,jpeg|max:2048',

        ]);
        if($request->hasFile('image')){
            $data['image'] = $this->uploadFile($request->image,'assests/images');
        }
       Product::create($data);
       return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrfail($id);
        $categories = Category::select('id','category_name')->get();
        return view('admin.editProduct',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name'=>'sometimes|string',
            'price'=>'sometimes|numeric',
            'rate'=>'sometimes|numeric',
            'published'=>'boolean',
            'category_id'=>'sometimes|integer|exists:categories,id',
            'image' =>'sometimes|mimes:png,jpg,jpeg|max:2048',

        ]);
        if($request->hasFile('image')){
            $data['image'] = $this->uploadFile($request->image,'assests/images');
        }
       Product::where('id',$id)->update($data);
       return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $id = $request->id;
       Product::where('id',$id)->delete();
       return redirect()->route('product.index');
    }
}
