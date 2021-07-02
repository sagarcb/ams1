<?php

use Illuminate\Database\Seeder;

class StudentInfo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++){
            \Illuminate\Support\Facades\DB::table('student_infos')->insert([
                'student_id' => 'UG02-41-15-0'.$i,
                'student_name' => "Student".$i,
                'password' => \Illuminate\Support\Facades\Hash::make('123')
            ]);

        }


    }
}
