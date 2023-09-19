<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','years_of_experience'
    ];

    public function teacher(){
        return $this->belongsTo(User::class);
    }
}
