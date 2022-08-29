<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    
    public function destroy(Skill $skill){
        if(Auth::user()->id !== $skill->resume->user_id){
            return back();
        }
        $skill->delete();
        return back();
    }

    
}
