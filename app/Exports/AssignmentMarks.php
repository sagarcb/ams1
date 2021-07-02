<?php

namespace App\Exports;

use App\Course_assignment_submission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssignmentMarks implements FromCollection, WithHeadings
{

    private $assignmentId;

    public function __construct($assignmentId)
    {
        return $this->assignmentId = $assignmentId;
    }

    public function collection()
    {
        return Course_assignment_submission::join('course_assignments','course_assignments.course_assignment_id',
            'course_assignment_submissions.course_assignment_id')
            ->select('course_assignment_submissions.course_student_id','course_assignments.assignment_title','course_assignment_submissions.marks',
                'course_assignment_submissions.comments')
            ->where('course_assignments.course_assignment_id',$this->assignmentId)->get();
    }

    public function headings(): array
    {
       return ['Student Id','Assignment Title','Student Marks','Comments'];
    }
}
