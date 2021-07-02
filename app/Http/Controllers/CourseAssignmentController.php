<?php

namespace App\Http\Controllers;

use App\Course_assignment;
use App\Course_assignment_submission;
use App\CourseStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class CourseAssignmentController extends Controller
{

    //Showing Course assignment List
    public function showAssignmentList($courseid)
    {
        $courseAssignments = Course_assignment::where('teacher_course_id',$courseid)
            ->where('teacher_id',session('teacherId'))->get();
        return view('teacher.manage-assignment.assignment-list',compact('courseAssignments','courseid'));
    }

    //Show Create Course Assignment View
    public function showCourseAssignment($courseid)
    {
        return view('teacher.manage-assignment.course-assignment',compact('courseid'));
    }

    //Storing the created assignment into database
    public function createCourseAssignment(Request $request)
    {
        $this->validate($request,[
           'assignment_title' => 'required',
           'assignment_fullmarks' => 'required',
           'assignment_opendate' => 'required',
           'assignment_lastdate' => 'required'
        ]);

        $a = new Course_assignment();
        $a->assignment_title = $request->assignment_title;
        $a->teacher_course_id = $request->teacher_course_id;
        $a->assignment_fullmarks = (int)$request->assignment_fullmarks;
        $a->assignment_opendate = $request->assignment_opendate;
        $a->assignment_lastdate = $request->assignment_lastdate;
        $a->teacher_id = session('teacherId');
        $a->save();

        return redirect("/teacher/$request->teacher_course_id/course-assignments")->with('success','Assignment Created Successfully!!!');
    }

    //Showing Edit assignment view
    public function editAssignment($id)
    {
        $assignment = Course_assignment::where('course_assignment_id',$id)->first();
        return view('teacher.manage-assignment.edit-assignment',compact("assignment"));
    }

    //Store updated assignment details
    public function updateAssignment(Request $request, $id)
    {
        $this->validate($request,[
            'assignment_title' => 'required',
            'assignment_fullmarks' => 'required',
            'assignment_opendate' => 'required',
            'assignment_lastdate' => 'required'
        ]);

        Course_assignment::where('course_assignment_id',$id)
                ->update([
                    'assignment_title' => $request->assignment_title,
                    'teacher_course_id' => $request->teacher_course_id,
                    'assignment_fullmarks' => (int)$request->assignment_fullmarks,
                    'assignment_opendate' => $request->assignment_opendate,
                    'assignment_lastdate' => $request->assignment_lastdate
                ]);
        return redirect("/teacher/$request->teacher_course_id/course-assignments")
                        ->with("success", "Successfully updated!!!");
    }

    public function deleteAssignment($id)
    {
        $courseid = Course_assignment::select("teacher_course_id")->where("course_assignment_id",$id)->first();
        Course_assignment_submission::where('course_assignment_id',$id)->delete();
        Course_assignment::where('course_assignment_id',$id)->delete();
        return redirect("/teacher/$courseid->teacher_course_id/course-assignments")
                            ->with("deleted","Successfully Deleted!!");
    }

    public function showMarkingList($courseAssignmentId, $courseid)
    {
        $assignmentTitle = Course_assignment::select('assignment_title', 'assignment_fullmarks')
                                    ->where('course_assignment_id',$courseAssignmentId)
                                    ->where('teacher_course_id',$courseid)->first();

        $courseStudents = CourseStudent::where('course_id',$courseid)->get();

        $assignmentSubmission = Course_assignment_submission::where('course_assignment_id',$courseAssignmentId)->get();
        $data = array();
        foreach ($courseStudents as $row) {
            $flag = 1;
            for ($i = 0; $i < sizeof($assignmentSubmission); $i++) {
                if ($assignmentSubmission[$i]->course_student_id == $row->student_id){
                    $flag = 0;
                }
            }
            if ($flag == 1)
            {
                array_push($data,$row);
            }
        }
        return view('teacher.manage-assignment.assignment-student',
            compact("courseid",'assignmentTitle','assignmentSubmission','courseStudents','courseAssignmentId','data'));
    }

    public function storeAssignmentSubmission(Request $request)
    {


        Course_assignment_submission::updateOrInsert(
            [
                'course_student_id' => $request->course_student_id,
                'course_assignment_id' => $request->course_assignment_id,
                'teacher_course_id' => $request->teacher_course_id
            ],
            [
                'course_student_id' => $request->course_student_id,
                'course_assignment_id' => $request->course_assignment_id,
                'teacher_course_id' => $request->teacher_course_id,
                'submission_status' => 1,
                'marks' => $request->marks,
                'comments' => $request->comments,
                'teacher_id' => session('teacherId')
            ]
        );

        $data = Course_assignment_submission::where('course_student_id',$request->course_student_id)
                                    ->where('course_assignment_id',$request->course_assignment_id)->first();

        return response()->json($data,200);
    }

    public function deleteAssignmentSubmission(Request $request)
    {
        Course_assignment_submission::where('course_assignment_submission_id',$request->id)->delete();
        //Course_assignment_submission::delete($id);

        return response()->json('Data successfully deleted',200);
    }

}
