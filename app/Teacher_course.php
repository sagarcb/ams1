<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher_course extends Model
{
    protected $fillable = ['teacher_course_id', 'course_title', 'teacher_id', 'semester', 'year'];

    public function teacher_info()
    {
        return $this->belongsTo(Teacher_info::class,'teacher_id','teacher_id');
    }

    public function course_students()
    {
        return $this->hasMany(CourseStudent::class, 'course_id','teacher_course_id');
    }

    public function course_assignments()
    {
        return $this->hasMany(Course_assignment::class,'teacher_course_id','teacher_course_id');
    }

    public function course_assignment_submissions()
    {
        return $this->hasMany(Course_assignment_submission::class,'teacher_course_id','teacher_course_id');
    }
}
