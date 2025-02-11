<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('email')) {
            $email = $request->input('email');
            $query->where(function ($q) use ($email) {
                $q->where('email', 'like', "%{$email}%");
            });
        }

        $users = $query->paginate();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        User::create(request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required|confirmed',
        ]));

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    {
        $user->update(request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]));    
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}
