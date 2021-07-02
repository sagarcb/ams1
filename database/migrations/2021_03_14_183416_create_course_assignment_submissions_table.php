<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseAssignmentSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_assignment_submissions', function (Blueprint $table) {
            $table->bigIncrements('course_assignment_submission_id');
            $table->string('course_student_id'); //student id
            $table->unsignedBigInteger('course_assignment_id'); //assignment id
            $table->string('teacher_course_id',20);
            $table->boolean('submission_status')->default(0);
            $table->integer('marks')->nullable();
            $table->text('comments')->nullable();
            $table->string('teacher_id',20);
            $table->timestamps();

//            $table->foreign('student_id')->references('student_id')->on('course_students')->onDelete('cascade');
            $table->foreign('course_assignment_id')->references('course_assignment_id')->on('course_assignments')->onDelete('cascade');
            $table->foreign('teacher_course_id')->references('teacher_course_id')->on('teacher_courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_assignment_submissions');
    }
}
