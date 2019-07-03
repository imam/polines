<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{

    protected $fillable = ['lecturer_id','student_id', 'date', 'entry_hour', 'schedule_id'];

    public function student() {
      return $this->belongsTo('App\Student');
    }
    
    public function lecturer() {
      return $this->belongsTo('App\Lecturer');
    }

    public function schedule() {
      return $this->belongsTo('App\Schedule');
    }

    public function getDayNameAttribute() {
        $day = ['Minggu','Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ];

        return $day[$this->schedule->day];
    }

    public function getNameAttribute() {
      return $this->student ? $this->student->name : ($this->lecturer ? $this->lecturer->name : null);
    }

    public function getNimOrNipAttribute() {
      return $this->student 
        ? $this->student->NIM: 
        ($this->lecturer ? $this->lecturer->NIP : null);
    }

}
