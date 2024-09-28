<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductDetailRequest;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductDetailController extends Controller
{
    
    public function index($id)
    {
        $query = ProductDetail::with(['size', 'images' => function ($query) {
            $query->limit(1); 
        }])
        ->where('product_id', $id)
        ->filterBy(request(['search', 'size']))
        ->orderBy(request('sort', 'id'), request('direction', 'desc'));

        $sizes=Size::pluck('name','id');
        $product=Product::findOrFail($id);
        $productDetails = $query->paginate(request('per_page', 10))
            ->withQueryString();
        return Inertia::render('Admin/ProductDetail/Index', [
            'productDetails'=>$productDetails,
            'product' => $product,
            'sizes' => $sizes
        ]);
    }

    public function create($id)
    {
        $product=Product::with(['images'=>function($query){
            $query->limit(1);
        }])->findOrFail($id);
        // dd($product);
        $attributes = Attribute::with('attributeOptions')->get()->toArray();
        // dd($attributes);
        return Inertia::render('Admin/ProductDetail/Create', [
            'attributes'=>$attributes,
            'product' => $product,
        ]);
       
    }

    public function store(Request $request)
    {
        // dd("Gekki");
        dd($request->all());
        ProductDetail::create($request->all());
        return to_route('admin.product-details.index',$request->product_id);
    }

    public function edit(string $productId,string $detailId)
    {
        $productDetail = ProductDetail::findOrFail($detailId);
        $sizes = Size::pluck('name', 'id');
        return inertia('Admin/ProductDetail/Edit', compact('productDetail', 'sizes'));
    }


    public function update(ProductDetailRequest $request,string $productId,string $detailId)
    {
        $productDetail = ProductDetail::findOrFail($detailId);
        
        $productDetail->update([
            'size_id' => $request->input('size_id'),
            'discount' => $request->input('discount'),
            'price' => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
            'product_id' => $request->input('product_id'),
        ]);
        return to_route('admin.product-details.index',$request->product_id);
    }

    public function destroy($productId, $detailId)
    {
        $productDetail = ProductDetail::where('product_id', $productId)
        ->where('id', $detailId)
        ->first();
    $productDetail->delete();
    return back();
    }
}
