<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute as ModelsAttribute;
use App\Models\AttributeOption;
use Attribute;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AttributeController extends Controller
{
    public function index()
    {
        // dd("helo");
        // $query=ModelsAttribute::orderBy(request('sort', 'id'), request('direction', 'desc'));;
        // dd(ModelsAttribute::with('attributeOptions')->get());
        $query = ModelsAttribute::with('attributeOptions')->filterBy(request(['search']))->orderBy(request('sort', 'id'), request('direction', 'desc'));
        $attributes = $query->paginate(request('per_page', 10));

        return Inertia::render(
            'Admin/Attributes/Index',
            [
                'attributes' => $attributes,
            ]
        );
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $data = $request->validate([
           'name' => 'required|unique:attributes,name',
            'values' => 'required|array',
        ]);

        $attribute = ModelsAttribute::create([
            'name' => $data['name']
        ]);

        foreach ($data['values'] as $value) {
            if (!is_null($value)) {
                AttributeOption::create([
                    'attribute_id' => $attribute->id,
                    'value' => $value
                ]);
            }
        }

        return back();
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $attribute = ModelsAttribute::findOrFail($id);
        $data = $request->validate([
            'name' => [
                'required',
                'unique:attributes,name,' . $id, 
            ],
            'values' => 'required|array',
        ]);

        $attribute->name = $data['name'];
    $attribute->save();

    return back();
    }


    public function destroy(string $id)
    {
        // dd($id);
        $attribute = ModelsAttribute::findOrFail($id);
        $attribute->delete();
        return back();
    }
}
