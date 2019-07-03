<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'NIM', 'student_id', 'class'];

    public function user() {
        return $this->hasOne('App\User', 'NIM', 'NIM');
    }
}
