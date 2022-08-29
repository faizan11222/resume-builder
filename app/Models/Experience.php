<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resume;

class Experience extends Model
{
    use HasFactory;

    public function resume(){
        return $this->belongsTo(Resume::class);
    }
}
