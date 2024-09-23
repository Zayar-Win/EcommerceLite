<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $query = Product::with(['category', 'productDetails', 'images' => function ($query) {
            $query->limit(1); 
        }])->filterBy(request(['search', 'category']))->orderBy(request('sort', 'id'), request('direction', 'desc'));
        
        $categories = Category::pluck('name', 'id');
        $products = $query->paginate(request('per_page', 10))
            ->withQueryString();
        return Inertia::render('Admin/Product/Index', [
            'products' => $products,
            'categories'=>$categories
        ]);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return inertia('Admin/Product/Create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'category_id' => $request->input('category_id'),
            'slug' => Str::slug($request->input('name')),
        ];

        $product = Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images');

                $product->images()->create([
                    'url' => $path,
                ]);
            }
        }
        return to_route('admin.products.index');
    }

    public function edit(string $id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return inertia('Admin/Product/Edit', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'category_id' => $request->input('category_id'),
        ]);

        $images = $request->images;
        $currentImage = array_filter($images, 'is_string');
        $cleanedCurrentImagePaths = array_map(function($imagePath) {
            return str_replace('/storage/', '', $imagePath);
        }, $currentImage);
        dd($currentImage);
        $newImages = array_filter($images, function($image) {
            return $image instanceof \Illuminate\Http\UploadedFile;
        });

        $oldImagePaths = $product->images->pluck('url')->toArray();
        $imagesToRemove = array_filter($oldImagePaths, function($oldImage) use ($cleanedCurrentImagePaths) {
            return !in_array($oldImage, $cleanedCurrentImagePaths);
        });
        
        if ($imagesToRemove) {
            $product->images()->whereIn('url', $imagesToRemove)->delete();
        }
    
        foreach ($newImages as $image) {
            $path = $image->store('images');

            $product->images()->create([
                'url' => $path,
            ]);
        }

        return to_route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
}
