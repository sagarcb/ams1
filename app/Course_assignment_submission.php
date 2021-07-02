<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_assignment_submission extends Model
{
    protected $fillable = [
        'course_student_id',
        'teacher_course_id',
        'submission_status',
        'marks',
        'comments',
        'course_assignment_id',
        'teacher_id'
    ];
}
