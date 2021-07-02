<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <= 10; $i++){
            $data[] = [
                'course_title' => 'subject'.$i,
                'teacher_id' => 't-101',
                'semester' => 'spring',
                'year' => '2021'
            ];
        }

        foreach ($data as $row){
            \App\Teacher_course::create($row);
        }
    }
}
