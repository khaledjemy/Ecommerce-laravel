<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;


class PublicController extends Controller
{
    public function index()
    {
        $categories = Category::limit(4)->get();
        $products = Product::where('category_id', 1)->paginate(3);
        $latestwomen = Product::where('category_id', 2)->paginate(3);
        $productkids = Product::where('category_id', 4)->paginate(3);
        return view('welcome',compact('categories','products','latestwomen','productkids'));
    }

    public function about()
    {
        return view('public.about');
    }
    public function contact()
    {
        return view('public.contact');
    }
    public function products()
    {
        $products = Product::where('published',1)->latest()->paginate(6);
        return view('public.products',compact('products'));
    }
    public function show(string $id)
    {
        $product = Product::findOrfail($id);
        return view('public.single-product',compact('product'));
    }

}
