<?php

namespace App\Http\Controllers;

use App\Course_assignment_submission;
use App\CourseStudent;
use App\Http\Middleware\Teacher;
use App\Student_info;
use App\Teacher_course;
use App\Teacher_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use StudentInfo;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher.teacher-dashboard');
    }

    /*Show Teacher's profile*/
    public function showProfile($id)
    {
        $teacher_info = Teacher_info::where('teacher_id',session('teacherId'))->first();
        return view('teacher.profile')->with('teacher_info',$teacher_info);
    }

    /*Show Edit Teacher's profile page*/
    public function showEditProfile($id)
    {

        $teacher_info = Teacher_info::where('teacher_id',$id)->first();
        return view('teacher.edit-profile')->with('teacher_info',$teacher_info);
    }



    //Updating Teacher information
    public function update(Request $request, $id)
    {
        if (isset($request->avatar)){
            $d = DB::table('teacher_infos')->select('avatar')->where('teacher_id',$id)->get();
            $avt = $d[0]->avatar;
            if (isset($avt)){
            unlink("uploads/$avt");
            }
            $extension = $request->avatar->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $request->avatar->move('uploads',$filename);

            $data['teacher_name'] = $request->teacher_name;
            $data['avatar'] = $filename;
            session()->put('teacherImage',$filename);
            DB::table('teacher_infos')
                ->where('teacher_id',$id)
                ->update($data);

            $name = DB::table('teacher_infos')->select('teacher_name')
                ->where('teacher_id',$id)->get();
            session()->put('teacherName',$name[0]->teacher_name);
        }else{
            $data['teacher_name'] = $request->teacher_name;
            DB::table('teacher_infos')
                ->where('teacher_id',$id)
                ->update($data);

            $name = DB::table('teacher_infos')->select('teacher_name')
                ->where('teacher_id',$id)->get();
            session()->put('teacherName',$name[0]->teacher_name);
        }

        return redirect("/teacher/profile/$id")->with('message','Successfully Updated!!!');
     }

     //Show Change password Form
    public function showChangePassword($id)
    {
        $teacher_info = Teacher_info::where('teacher_id',$id)->first();
        return view('teacher.change-password')->with('teacher',$teacher_info);
    }
    //update password
    public function changePassword(Request $request,$id)
    {
        $oldPass = $request->old_pass;
        $newPass = $request->password;
        $confirmPass = $request->confirm_pass;
        $teacher_info = Teacher_info::where('teacher_id',$id)->first();

        $this->validate($request,[
           'old_pass' => 'required',
           'password' => 'required',
            'confirm_pass' => 'required'
        ]);

        if (Hash::check($oldPass,$teacher_info->password)){
            if ($newPass == $confirmPass){
                DB::table('teacher_infos')->where('teacher_id',$id)
                    ->update(['password'=>Hash::make($newPass)]);
                return redirect("teacher/profile/$id")->with('message','password changed successfully!!!');
            }else{
                session()->flash('msg', "Confirm password didn't match with new password!!!");
                return redirect()->back();
            }
        }else{
            session()->flash('msg', "Previous password was wrong!!");
            return back();
        }

    }

    //Show the Course list page
    public function showCourses()
    {
        $data = DB::table('teacher_courses')
            ->where('teacher_id','=',session('teacherId'))->get();
        return view('teacher.course-list')->with('courses',$data);
    }

    //Show course list
    public function showCourseList()
    {
        $courses = Teacher_course::where('teacher_id','=',session('teacherId'))->get();
        return view('teacher.manage_courses.course-list',compact('courses'));
    }

    //Show add course
    public function showAddCourse()
    {
        return view("teacher.manage_courses.add-course");
    }

    //Store new course to database
    public function addCourse(Request $request)
    {
        $this->validate($request,[
           'teacher_course_id' => 'required|unique:teacher_courses,teacher_course_id',
            'course_title' => 'required',
            'semester' => 'required',
            'year' => 'required'
        ]);

        Teacher_course::create($request->all());
        return redirect('/teacher/course-list')->with('success','Course Added Successfully!!');
    }

    //Show edit course view
    public function showEditCourse($id)
    {
        $course = Teacher_course::where('teacher_course_id',$id)->first();
        return view('teacher.manage_courses.edit-course',compact('course'));
    }

    //Update Course information
    public function updateCourse(Request $request,$id)
    {
        $this->validate($request,[
            'teacher_course_id' => 'required',
            'course_title' => 'required',
            'semester' => 'required',
            'year' => 'required'
        ]);
        $data = request()->except(['_token','_method']);
        Teacher_course::where('teacher_course_id',$id)->update($data);
        return redirect('/teacher/course-list')->with('success','successfully Updated');
    }

    //Delete course information
    public function deleteCourse($id)
    {
        DB::table('course_students')->where('course_id',$id)->delete();
        DB::table('teacher_courses')->where('teacher_course_id',$id)->delete();
        return redirect('/teacher/course-list')->with('deleted','Successfully Deleted!!');
    }

    //Show course students list
    public function showCourseStudents($courseid)
    {
        $courseStudents = CourseStudent::where('course_id',$courseid)->get();
        return view('teacher.manage_courses.course-students',compact(['courseid','courseStudents']));
    }

    //Show add course student form view
    public function showAddCourseStudent($courseid)
    {
        return view("teacher.manage_courses.add-courseStudent",compact('courseid'));
    }

    //Insert a student for a course
    public function addCourseStudent(Request $request,$courseid)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'student_name' => 'required',
            'course_id' => 'required'
        ]);

        $studentInfo = CourseStudent::where('student_id',$request->student_id)
                                    ->where('course_id',$courseid)->first();
        if (!empty($studentInfo)){
            return back()->with('errorMsg','This Student ID is already registered for this course!!');
        }else {
            CourseStudent::create($request->all());
            return redirect("/teacher/$courseid/course-students")->with('success', 'Successfully added!');
        }
    }

    //Show Edit Course student view
    public function showEditCourseStudent($id)
    {
        $studentInfo = CourseStudent::find($id);
        return view('teacher.manage_courses.edit-courseStudent',compact('studentInfo'));
    }

    public function updateEditCourseStudent(Request $request, $id)
    {
        $this->validate($request, [
            'student_id' => [
                'required',
                'unique:course_students,student_id,'.$id
            ],
            'student_name' => 'required',
            'course_id' => 'required'
        ]);

        $courseStudent = CourseStudent::find($id);
        $courseStudent->course_id = $request->course_id;
        $courseStudent->student_id = $request->student_id;
        $courseStudent->student_name = $request->student_name;
        $courseStudent->save();
        return redirect("/teacher/$request->course_id/course-students")->with('success','Successfully Updated!!!');
    }

    public function deleteCourseStudent(Request $request, $id)
    {
        Course_assignment_submission::where('course_student_id',$request->course_student_id)
                        ->where('teacher_course_id',$request->course_id)->delete();
        CourseStudent::where('id',$id)->delete();
        return back()->with('deleted','Successfully Deleted!!!');
    }

}
