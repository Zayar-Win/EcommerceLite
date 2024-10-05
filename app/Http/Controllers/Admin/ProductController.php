<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Uploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProductController extends Controller
{

    public function __construct(public Uploader $uploader) {}

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
            'categories' => $categories
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
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file);

                // resize image proportionally to 300px width
                $image->resize(300, 300);
                $path = $this->uploader->upload($image, 'images');

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
        $product = Product::with('images')->findOrFail($id);

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'category_id' => $request->input('category_id'),
        ]);
        $existingImages = $product->images->pluck('url')->toArray();
        $oldImages = array_filter($request->images, function ($value) {
            return is_string($value); 
        });
        $imagesToDelete = array_diff($existingImages, $oldImages);
        foreach ($imagesToDelete as $url) {
            $image = $product->images()->where('url', $url)->first();
            if ($image) {
                $image->delete();
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file);

                // resize image proportionally to 300px width
                $image->resize(300, 300);
                $path = $this->uploader->upload($image, 'images');

                $product->images()->create([
                    'url' => $path,
                ]);
            }
        }
        return to_route('admin.products.index');
    }

    public function sort()
    {
        return Inertia::render('Admin/Product/OrderProduct');
    }

    public function destroy(Product $product)
    {
        $product->productDetails()->delete();
        $product->delete();

        return back();
    }
}
