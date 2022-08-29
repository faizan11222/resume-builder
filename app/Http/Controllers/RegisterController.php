<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        // validate data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255|confirmed',
        ]);
        
        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // create timestamp
        $validatedData['email_verified_at'] = now();
        
        // store data
        User::create($validatedData);

        // create session
        $request->session()->flash('success', '<strong>Register successfully!</strong> Please login');

        // redirect to login page
        return redirect('/login');
    }
}
