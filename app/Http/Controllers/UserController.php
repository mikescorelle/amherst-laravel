<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'bio' => 'nullable|string',
            'is_admin' => 'sometimes|accepted',
        ]);

        // Create a new user
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'bio' => $data['bio'] ?? 'This is Not Available',
            'is_admin' => $request->has('is_admin')
        ]);

        $user->save();

        return Redirect::route('dashboard');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('edit', compact('user'));
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string',
            'is_admin' => 'sometimes|boolean',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->bio = $data['bio'];
        $user->is_admin = $request->has('is_admin');

        $user->save();

        return redirect()->route('dashboard')->with('success', 'User updated successfully');
    }


    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return Redirect::route('users.index')->with('success', 'User deleted successfully.');

    }
}
