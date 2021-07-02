<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_infos', function (Blueprint $table) {
            $table->string('teacher_id',20)->primary();
            $table->string('teacher_name',100);
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });

        \App\Teacher_info::create([
           'teacher_id' => 'teacher-101',
           'teacher_name' => 'Muntasir Hasan Kanchan',
           'password' =>  \Illuminate\Support\Facades\Hash::make('teacher')
        ]);

        \App\Teacher_info::create([
            'teacher_id' => 'teacher-102',
            'teacher_name' => 'Sharmin Afroz',
            'password' => \Illuminate\Support\Facades\Hash::make('teacher')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_infos');
    }
}
