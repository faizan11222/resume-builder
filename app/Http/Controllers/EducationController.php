<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    
    public function destroy(Education $education){
        if(Auth::user()->id !== $education->resume->user_id){
            return back();
        }
        $education->delete();
        return back();
    }
}
