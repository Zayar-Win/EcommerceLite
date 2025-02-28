<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductDetailRequest;
use App\Models\Attribute;
use App\Models\AttributeOptionProductDetail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProductDetailController extends Controller
{

    public function index(Product $product)
    {
        $product = Product::with(['images', 'productDetails' => function ($query) {
            return $query->filterBy(request(['search']))
                ->orderBy(request('sort', 'id'), request('direction', 'desc'));
        }])->where('id', $product->id)->first();
        $sizes = Size::pluck('name',  'id');
        $productDetails = $product->productDetails()->with('attributeOptions', 'attributeOptions.attribute')->paginate(10);
        $attributeOptions = $product->productDetails->flatMap(function ($detail) {
            return $detail->attributeOptions;
        })->groupBy('attribute.name')->map(function ($group) {
            return $group->unique('name')->pluck('attribute.name');
        })->flatten()->toArray();
        return Inertia::render('Admin/ProductDetail/Index', [
            'productDetails' => $productDetails,
            'product' => $product,
            'attributeOptions' => $attributeOptions,
            'sizes' => $sizes
        ]);
    }

    public function create($id)
    {
        $product = Product::with(['images' => function ($query) {
            $query->limit(1);
        }])->findOrFail($id);
        $previousAttributes = $product->productDetails->flatMap(function ($detail) {
            return $detail->attributeOptions;
        })->groupBy('attribute.name')->map(function ($group) {
            return $group->unique('name')->pluck('attribute.name');
        })->flatten()->toArray();
        $attributes = Attribute::with('attributeOptions')->get()->toArray();
        return Inertia::render('Admin/ProductDetail/Create', [
            'attributes' => $attributes,
            'product' => $product,
            'previousAttributes' => $previousAttributes
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make(request()->all(), [
            'variants' => 'required',
            'variants.*.qty' => 'required',
            'vairants.*.price' => 'required',
            'variants.*.discount_price' => 'nullable',
            'variants.*.attributes.*' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please fill the all field.');
        }

        $variants = request('variants');

        foreach ($variants as $variant) {
            $productDetail = ProductDetail::create([
                'price' => $variant['price'],
                'stock_quantity' => $variant['qty'],
                'product_id' => request('product_id'),
                'discount' => request('discount_price') ?? null
            ]);
            foreach ($variant['attributes'] as $attribute) {
                AttributeOptionProductDetail::create([
                    'product_detail_id' => $productDetail->id,
                    'attribute_option_id' => $attribute
                ]);
            }
        }

        return to_route('admin.product-details.index', $request->product_id);
    }

    public function edit(string $productId, string $detailId)
    {
        $productDetail = ProductDetail::with('attributeOptions', 'attributeOptions.attribute')->findOrFail($detailId);
        $product = Product::with('images')->where('id', $productId)->first();
        $previousAttributes = $product->productDetails->flatMap(function ($detail) {
            return $detail->attributeOptions;
        })->groupBy('attribute.name')->map(function ($group) {
            return $group->unique('name')->pluck('attribute.name');
        })->flatten()->toArray();
        $attributes = Attribute::with('attributeOptions')->get()->toArray();
        $sizes = Size::pluck('name', 'id');
        return inertia('Admin/ProductDetail/Edit', compact('productDetail', 'sizes', 'previousAttributes', 'product', 'attributes'));
    }


    public function update(ProductDetailRequest $request, string $productId, string $detailId)
    {
        $validator = Validator::make(request()->all(), [
            'variants' => 'required',
            'variants.*.qty' => 'required',
            'vairants.*.price' => 'required',
            'variants.*.discount_price' => 'nullable',
            'variants.*.attributes.*' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please fill the all field.');
        }
        $productDetail = ProductDetail::findOrFail($detailId);

        $productDetailWithThisVariantsQuery = ProductDetail::where('product_id', $productId);

        foreach (request('variants')[0]['attributes'] as $key => $attribute) {
            $productDetailWithThisVariantsQuery->wherehas('attributeOptions', function ($query) use ($key, $attribute) {
                $query->whereHas('attribute', function ($query)  use ($key) {
                    $query->where('name', $key);
                })->where('attribute_options.id', $attribute);
            });
        }
        $productDetailWithThisVariants = $productDetailWithThisVariantsQuery->where('id', '!=', $detailId)->first();

        if ($productDetailWithThisVariants) {
            return back()->with('error', 'Product Detail with this variants already exists.');
        }

        foreach (request('variants') as $variant) {
            $productDetail->update([
                'discount' => $variant['discount_price'],
                'price' => $variant['price'],
                'stock_quantity' => $variant['qty'],
                'product_id' => $productId,
            ]);
            foreach ($variant['attributes'] as $key => $attribute) {

                $attributeOptionProductDetail = AttributeOptionProductDetail::whereHas('attributeOption.attribute', function ($query) use ($key) {
                    return $query->where('name', $key);
                })->where('product_detail_id', $detailId)->first();

                $attributeOptionProductDetail->update([
                    'attribute_option_id' => $attribute
                ]);
            }
        }
        return to_route('admin.product-details.index', $request->product_id);
    }

    public function destroy($productId, $detailId)
    {
        $productDetail = ProductDetail::where('product_id', $productId)
            ->where('id', $detailId)
            ->first();
        $productDetail->attributeOptions()->delete();
        $productDetail->delete();
        return back();
    }
}
