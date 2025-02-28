<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique(Product::class, 'name')],
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'images' => 'array|max:5',
        ];
    }

    public function messages()
    {
        return [
            'images.array' => 'You can upload up to 5 images only.',
            'images.max' => 'You can upload up to 5 images only.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Only jpeg, png, and gif files are allowed.',
            'images.*.max' => 'Each image must not be larger than 2MB.',
        ];
    }
}
