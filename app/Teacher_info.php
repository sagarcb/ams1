<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher_info extends Model
{
    protected $fillable = ['teacher_id','teacher_name','password','avatar'];

    public function teacher_courses()
    {
        return $this->hasMany(Teacher_course::class, 'teacher_id','teacher_id');
    }
}
