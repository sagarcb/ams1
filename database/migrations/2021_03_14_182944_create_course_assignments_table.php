<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_assignments', function (Blueprint $table) {
            $table->bigIncrements('course_assignment_id');
            $table->text('assignment_title');
            $table->string('teacher_course_id',20);
            $table->integer('assignment_fullmarks');
            $table->date('assignment_opendate');
            $table->date('assignment_lastdate');
            $table->string('teacher_id',20);
            $table->timestamps();

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
        Schema::dropIfExists('course_assignments');
    }
}
