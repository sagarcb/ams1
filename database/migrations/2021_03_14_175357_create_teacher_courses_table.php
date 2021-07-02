<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_courses', function (Blueprint $table) {
            $table->string('teacher_course_id',20)->primary();
            $table->string('course_title',100);
            $table->string('teacher_id',20);
            $table->string('semester',10);
            $table->string('year',10);
            $table->timestamps();

            $table->foreign('teacher_id')->references('teacher_id')->on('teacher_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_courses');
    }
}
