<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StoreSetting;
use Illuminate\Http\Request;


class PublicController extends Controller
{
    public function index()
    {
        $categories = Category::where('published', true)->limit(4)->get();
        $products = Product::where('published', true)
            ->whereHas('category', fn ($query) => $query->where('category_name', 'men')->where('published', true))
            ->latest()->paginate(3, ['*'], 'men_page');
        $latestwomen = Product::where('published', true)
            ->whereHas('category', fn ($query) => $query->where('category_name', 'women')->where('published', true))
            ->latest()->paginate(3, ['*'], 'women_page');
        $productkids = Product::where('published', true)
            ->whereHas('category', fn ($query) => $query->where('category_name', 'kids')->where('published', true))
            ->latest()->paginate(3, ['*'], 'kids_page');
        $currency = StoreSetting::current()->currency;
        return view('welcome',compact('categories','products','latestwomen','productkids','currency'));
    }

    public function about()
    {
        return view('public.about', ['settings' => StoreSetting::current()]);
    }
    public function contact()
    {
        return view('public.contact', ['settings' => StoreSetting::current()]);
    }
    public function products(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'integer', 'exists:categories,id'],
        ]);
        $categories = Category::where('published', true)->orderBy('category_name')->get();
        $products = Product::where('published', true)
            ->whereHas('category', fn ($query) => $query->where('published', true))
            ->when(filled($filters['q'] ?? null), fn ($query) => $query->where('name', 'like', '%'.addcslashes($filters['q'], '%_\\').'%'))
            ->when(filled($filters['category'] ?? null), fn ($query) => $query->where('category_id', $filters['category']))
            ->latest()->paginate(6)->withQueryString();
        $currency = StoreSetting::current()->currency;
        return view('public.products',compact('products','categories','currency'));
    }
    public function show(string $id)
    {
        $product = Product::where('published', true)
            ->whereHas('category', fn ($query) => $query->where('published', true))
            ->findOrFail($id);
        $currency = StoreSetting::current()->currency;
        return view('public.single-product',compact('product','currency'));
    }

}
