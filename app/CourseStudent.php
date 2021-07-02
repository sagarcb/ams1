<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    protected $fillable = ['student_id','course_id','student_name','teacher_id'];
}
