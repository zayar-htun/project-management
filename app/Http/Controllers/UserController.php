<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('first_name')) {
            $query->where('first_name', $request->first_name);
        }

        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->has('date_of_birth')) {
            $query->whereDate('date_of_birth', $request->date_of_birth);
        }

        return $query->get();
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update($request->all());

        return response()->json($user);
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();

        return response()->json(null, 204);
    }
}
