<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Traits\Common;
use App\Trait\ResponseTrait;


class ProductController extends Controller
{
    use Common;
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */

    public function index()
    {  
        $product = Product::get();

        if(!$product)
        {
            return $this->Error('invalid');
        }
            return $this->Success($product,'success');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
    
        if($request->hasFile('image')){
            $data['image'] = $this->uploadFile($request->image,'assests/images');
        }
         Product::create($data);
        return response()->json([
            'msg'=>'Product added successfully',
            'data'=>$data,
         ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if(!$product)
        {
            return $this->Error('invalid');
        }
            return $this->Success($product,'success');
  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image'))
         {
            $data['image'] = $this->uploadFile($request->file('image'), 'assests/images'); 
        }
        $product = Product::findOrFail($id);
        $product->update($data);

        return response()->json([
            'data'=>$data,
          'message' => 'Product updated successfully'], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
