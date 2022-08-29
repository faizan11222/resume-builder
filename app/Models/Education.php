<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resume;

class Education extends Model
{
    use HasFactory;
    // protected $fillable = ['id'];

    public function resume(){
        return $this->belongsTo(Resume::class);
    }
}
