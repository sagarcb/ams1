<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_assignment extends Model
{
    protected $fillable = [
      'course_assignment_id',
      'assignment_title',
      'teacher_course_id',
      'assignment_opendate',
      'assignment_lastdate',
      'teacher_id'
    ];
}
