<?php

namespace App\Http\Controllers;

use App\Teacher_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MongoDB\Driver\Session;

class TeacherLoginController extends Controller
{
    public function index()
    {
        return view('teacher.teacher-login');
    }

    public function authenticate(Request $request)
    {
        $teacher_id = $request->teacherid;
        $password = $request->password;
        $teacherInfo = Teacher_info::where('teacher_id',$teacher_id)->first();
        if (!empty($teacherInfo)){
            if (Hash::check($password, $teacherInfo->password)){
                session()->put('teacherloginstatus',1);
                session()->put('teacherName', $teacherInfo->teacher_name);
                session()->put('teacherId',$teacher_id);
                session()->put('teacherImage',$teacherInfo->avatar);
                return redirect('/teacher');
            }else{
                return back()->with('error',"*Teacher id or password was incorrect");
            }
        }else{
            return back()->with('error',"*Teacher id or password was incorrect");
        }
    }

    public function logout()
    {
        session()->forget('teacherloginstatus');
        return redirect('/');
    }

}
