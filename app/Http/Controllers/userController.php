<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function isAdmin(){
        
        $this->authorize('isAdmin', Auth::user());
        return view('admin_dashboard', [
            'resumes' => Resume::all(),
            'users' => User::all(),
        ]);
    }
}
