<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\User;

class Resume extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function educations(){
        return $this->hasMany(Education::class);
    }

    public function experiences(){
        return $this->hasMany(Experience::class);
    }

    public function skills(){
        return $this->hasMany(Skill::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
