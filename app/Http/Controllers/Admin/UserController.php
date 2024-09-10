<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $query = User::filterBy(request(['search', 'nationality', 'dob']))->orderBy(request('sort', 'id'), request('direction', 'desc'));
        $users = $query->paginate(request('per_page', 10))
            ->withQueryString();
        return Inertia::render('Admin/User/Index', [
            'users' => $users,
        ]);
    }


    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        return inertia('Admin/User/Create',compact('roles'));
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'telegram' => $request->input('telegram'),
            'viber' => $request->input('viber'),
            'fb_profile_link' => $request->input('fb_profile_link'),
            'password' => Hash::make($request->input('password')), 
            'role_id' => $request->input('role_id'),
            'phone' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'address' => $request->input('address'),
        ]);

        return to_route('admin.users.index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $user = User::findOrFail($id);


        $roles = Role::select('id', 'name')->get();

        return inertia('Admin/User/Edit', compact('user', 'roles'));
    }


    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'telegram' => $request->input('telegram'),
            'viber' => $request->input('viber'),
            'fb_profile_link' => $request->input('fb_profile_link'),
            'phone' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'address' => $request->input('address'),
        ]);

        return to_route('admin.users.index');
    }

    public function destroy(string $id)
    {
        //
    }
}
