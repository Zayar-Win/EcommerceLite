<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories
        ]);
    }

    public function store()
    {
        $validatedData = request()->validate([
            'name' => ['required', 'min:3']
        ]);

        Category::create($validatedData);
        return back()->with('success', 'Category created successful.');
    }

    public function update(Category $category)
    {
        $validatedData = request()->validate([
            'name' => ['required', 'min:3']
        ]);

        $category->update([
            'name' => $validatedData['name']
        ]);
        return back()->with('success', 'Category updated successful.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted successful.');
    }
}
