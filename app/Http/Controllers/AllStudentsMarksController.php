<?php

namespace App\Http\Controllers;

use App\Course_assignment;
use App\Course_assignment_submission;
use App\CourseStudent;
use App\Exports\AssignmentMarks;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class AllStudentsMarksController extends Controller
{
    public function index($courseId)
    {
        $students = CourseStudent::select('student_id')->where('course_id',$courseId)->get();
        $assignments = Course_assignment::where('teacher_course_id',$courseId)->get();
        $submissions = Course_assignment_submission::where('teacher_course_id',$courseId)->get();
        return view('teacher.markings.total-assignment-markings',
                compact('students','assignments','submissions','courseId'));
    }

    public function assignmentStudentMarks($assignment_id)
    {
        $filename = time().'marks.xlsx';
        return Excel::download(new AssignmentMarks($assignment_id),$filename);
    }
}
