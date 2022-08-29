<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function destroy(Experience $experience){
        if(Auth::user()->id !== $experience->resume->user_id){
            return back();
        }
        $experience->delete();
        return back();
    }
}
