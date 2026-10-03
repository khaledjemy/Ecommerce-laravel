<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\Common;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Common;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.addCategory',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_name'=>'required|string',
            'description'=>'required|string',
            'published'=>'boolean',
            'image' =>'required|mimes:png,jpg,jpeg|max:2048',

        ]);
        if($request->hasFile('image')){
            $data['image'] = $this->uploadFile($request->image,'assests/images');
        }
       Category::create($data);
       return redirect()->route('category.index');

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
        $category = Category::findOrfail($id);
        return view('admin.editCategory',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'category_name'=>'sometimes|string',
            'description'=>'sometimes|string',
            'published'=>'boolean',
            'image' =>'sometimes|mimes:png,jpg,jpeg|max:2048',

        ]);
        if($request->hasFile('image')){
            $data['image'] = $this->uploadFile($request->image,'assests/images');
        }
       Category::where('id',$id)->update($data);
       return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('category.index');

    }
}
