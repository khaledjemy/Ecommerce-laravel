<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Trait\ResponseTrait;
use App\Models\Category;
use App\Traits\Common;


class CategoryController extends Controller
{
    use Common;
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Category = Category::get();

        if(!$Category)
        {
            return $this->Error('invalid');
        }
            return $this->Success($Category,'success');
    
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = $this->uploadFile($request->image,'assets/images');
        }
         Category::create($data);

         return response()->json([
             'msg'=>'category added successfully',
             'data'=>$data,
         ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    public function update(StoreRequest $request, string $id)
    {
        $data = $request->validated();
        
        if($request->hasFile('image')){
            $data['image'] = $this->uploadFile($request->image,'assets/images');
        }
        $Category = Category::findOrFail($id);
        $Category->update($data);
        
        if(!$Category)
        {
            return $this->Error('invalid');
        }
            return $this->Success($Category,'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
