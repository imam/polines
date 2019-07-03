<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['schedule_id', 'day', 'entry_hour', 'lecture_id', 'lecturer_id', 'classroom_id'];

    public function lecture() {
        return $this->belongsTo('App\Lecture');
    }

    public function lecturer() {
        return $this->belongsTo('App\Lecturer');
    }

    public function classroom() {
        return $this->belongsTo('App\Classroom');
    }

    public function getDayNameAttribute() {
        $day = ['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ];

        return $day[$this->day];
    }
}
