<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        // dd("hit");
        // $query = Product::with('category')->filterBy(request(['search', 'nationality', 'dob']))->orderBy(request('sort', 'id'), request('direction', 'desc'));
        $query = Product::with('category','productDetail')->orderBy(request('sort', 'id'), request('direction', 'desc'));
        $products = $query->paginate(request('per_page', 10))
            ->withQueryString();
        return Inertia::render('Admin/Product/Index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        dd("it is create");
    }

    public function update()
    {
        dd("it is update");
    }

    public function destroy()
    {
        dd("it is destroy");
    }
}
