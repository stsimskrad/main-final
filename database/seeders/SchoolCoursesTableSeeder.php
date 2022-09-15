<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SchoolCoursesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('school_courses')->delete();
        
        \DB::table('school_courses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'years' => 4,
                'type' => 'N/a',
                'certification' => 'COE',
                'validity' => 'all',
                'school_id' => 183,
                'course_id' => 35,
                'is_active' => 1,
                'created_at' => '2022-08-31 00:14:48',
                'updated_at' => '2022-08-31 00:14:48',
            ),
            1 => 
            array (
                'id' => 2,
                'years' => 4,
                'type' => 'N/a',
                'certification' => 'COE',
                'validity' => '5',
                'school_id' => 183,
                'course_id' => 90,
                'is_active' => 1,
                'created_at' => '2022-08-31 00:16:07',
                'updated_at' => '2022-08-31 00:16:07',
            ),
            2 => 
            array (
                'id' => 3,
                'years' => 4,
                'type' => 'N/a',
                'certification' => 'COE',
                'validity' => 'a',
                'school_id' => 183,
                'course_id' => 101,
                'is_active' => 1,
                'created_at' => '2022-08-31 00:16:52',
                'updated_at' => '2022-08-31 00:16:52',
            ),
            3 => 
            array (
                'id' => 4,
                'years' => 4,
                'type' => 'N/a',
                'certification' => 'COE',
                'validity' => 'a',
                'school_id' => 183,
                'course_id' => 26,
                'is_active' => 1,
                'created_at' => '2022-08-31 00:17:26',
                'updated_at' => '2022-08-31 00:17:26',
            ),
            4 => 
            array (
                'id' => 5,
                'years' => 4,
                'type' => 'A',
                'certification' => 'COE',
                'validity' => '5',
                'school_id' => 183,
                'course_id' => 42,
                'is_active' => 1,
                'created_at' => '2022-08-31 00:18:05',
                'updated_at' => '2022-08-31 00:18:05',
            ),
            5 => 
            array (
                'id' => 6,
                'years' => 4,
                'type' => 'N/a',
                'certification' => 'COE',
                'validity' => 'a',
                'school_id' => 181,
                'course_id' => 39,
                'is_active' => 1,
                'created_at' => '2022-08-31 00:24:18',
                'updated_at' => '2022-08-31 00:24:18',
            ),
            6 => 
            array (
                'id' => 7,
                'years' => 4,
                'type' => 'N/a',
                'certification' => 'COE',
                'validity' => 'a',
                'school_id' => 181,
                'course_id' => 60,
                'is_active' => 1,
                'created_at' => '2022-08-31 00:24:33',
                'updated_at' => '2022-08-31 00:24:33',
            ),
            7 => 
            array (
                'id' => 8,
                'years' => 4,
                'type' => 'N/a',
                'certification' => 'COE',
                'validity' => 'a',
                'school_id' => 181,
                'course_id' => 101,
                'is_active' => 1,
                'created_at' => '2022-08-31 00:24:56',
                'updated_at' => '2022-08-31 00:24:56',
            ),
        ));
        
        
    }
}