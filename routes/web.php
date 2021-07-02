<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/sendemail', 'SendEmailController@index');
Route::post('/sendemail/send', 'SendEmailController@send');


Route::get('/','TeacherLoginController@index');
Route::post('/','TeacherLoginController@authenticate');

Route::group(['middleware' => 'teacher'],function () {
    Route::get('/teacher','TeacherController@index'); //Show Teacher dashboard
    Route::get('/teacher/logout','TeacherLoginController@logout'); //Logout link
    Route::get('/teacher/profile/{id}','TeacherController@showProfile'); //Show profile page

    Route::get('/teacher/{id}/edit','TeacherController@showEditProfile'); //show edit profile page
    Route::patch('/teacher/profile/{id}','TeacherController@update'); //update the edited profile

    Route::get('/teacher/{id}/change-pass','TeacherController@showChangePassword'); //show change password page
    Route::patch('/teacher/update-pass/{id}','TeacherController@changePassword'); //update the new password

    Route::get('/teacher/add-course',"TeacherController@showAddCourse"); // Show add course view
    Route::post('/teacher/add-course',"TeacherController@addCourse"); //add new course to db


    Route::get('/teacher/course-list','TeacherController@showCourseList');//show course list view
    Route::get('/teacher/{id}/edit-course','TeacherController@showEditCourse');//show edit course view
    Route::patch('/teacher/{id}/updateCourseInfo','TeacherController@updateCourse'); //update course information
    Route::delete('/teacher/{id}/delete-course','TeacherController@deleteCourse'); //delete course information

    Route::get('/teacher/{courseid}/course-students','TeacherController@showCourseStudents');

    Route::get('/teacher/{courseid}/add-courseStudent','TeacherController@showAddCourseStudent'); //show add course student view
    Route::post('/teacher/{courseid}/add-courseStudent','TeacherController@addCourseStudent'); //insert student for a course
    Route::get('/teacher/{id}/edit-courseStudent','TeacherController@showEditCourseStudent'); //Show edit course student view
    Route::patch('/teacher/{id}/update-courseStudent','TeacherController@updateEditCourseStudent'); //update the edited information
    Route::delete('/teacher/{id}/delete-courseStudent','TeacherController@deleteCourseStudent'); //delete a student from a subject

    //Manage Assignment Routes
    Route::get('/teacher/{courseid}/create-course-assignment','CourseAssignmentController@showCourseAssignment'); //Show Course Assignment View
    Route::post('/teacher/course-assignment/create','CourseAssignmentController@createCourseAssignment'); //storing created assignment


    Route::get('/teacher/{courseid}/course-assignments',"CourseAssignmentController@showAssignmentList"); // Showing course assignment list
    Route::get("/teacher/{id}/edit-assignment","CourseAssignmentController@editAssignment");
    Route::patch('/teacher/{id}/update-assignment',"CourseAssignmentController@updateAssignment");
    Route::delete("/teacher/{id}/delete-assignment",'CourseAssignmentController@deleteAssignment');

    //Show Start Marking View
    Route::get('/teacher/{courseAssignmentId}/{courseid}/marking-students','CourseAssignmentController@showMarkingList');

    //Store Assignment Submission
    Route::post('/teacher/assignmentSubmission', 'CourseAssignmentController@storeAssignmentSubmission');

    //Delete Assignment Submission
    Route::post('/teacher/deleteAssignmentSubmission','CourseAssignmentController@deleteAssignmentSubmission');

    /*All Students Marking Table for a particular Course*/
    Route::get('/teacher/{courseId}/all-marks','AllStudentsMarksController@index')->name('allMarks');

    //Student Assignment Marks
    Route::get('/teacher/{assignment_id}/student-marks','AllStudentsMarksController@assignmentStudentMarks')->name('studentMarks');

});
