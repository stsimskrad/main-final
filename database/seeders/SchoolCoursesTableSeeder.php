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
                'certification' => 'COE',
                'course_id' => 35,
                'created_at' => '2022-08-31 00:14:48',
                'id' => 1,
                'is_active' => 1,
                'school_id' => 183,
                'type' => 'N/a',
                'updated_at' => '2022-08-31 00:14:48',
                'validity' => 'all',
                'years' => 4,
            ),
            1 => 
            array (
                'certification' => 'COE',
                'course_id' => 90,
                'created_at' => '2022-08-31 00:16:07',
                'id' => 2,
                'is_active' => 1,
                'school_id' => 183,
                'type' => 'N/a',
                'updated_at' => '2022-08-31 00:16:07',
                'validity' => '5',
                'years' => 4,
            ),
            2 => 
            array (
                'certification' => 'COE',
                'course_id' => 101,
                'created_at' => '2022-08-31 00:16:52',
                'id' => 3,
                'is_active' => 1,
                'school_id' => 183,
                'type' => 'N/a',
                'updated_at' => '2022-08-31 00:16:52',
                'validity' => 'a',
                'years' => 4,
            ),
            3 => 
            array (
                'certification' => 'COE',
                'course_id' => 26,
                'created_at' => '2022-08-31 00:17:26',
                'id' => 4,
                'is_active' => 1,
                'school_id' => 183,
                'type' => 'N/a',
                'updated_at' => '2022-08-31 00:17:26',
                'validity' => 'a',
                'years' => 4,
            ),
            4 => 
            array (
                'certification' => 'COE',
                'course_id' => 42,
                'created_at' => '2022-08-31 00:18:05',
                'id' => 5,
                'is_active' => 1,
                'school_id' => 183,
                'type' => 'A',
                'updated_at' => '2022-08-31 00:18:05',
                'validity' => '5',
                'years' => 4,
            ),
            5 => 
            array (
                'certification' => 'COE',
                'course_id' => 39,
                'created_at' => '2022-08-31 00:24:18',
                'id' => 6,
                'is_active' => 1,
                'school_id' => 181,
                'type' => 'N/a',
                'updated_at' => '2022-08-31 00:24:18',
                'validity' => 'a',
                'years' => 4,
            ),
            6 => 
            array (
                'certification' => 'COE',
                'course_id' => 60,
                'created_at' => '2022-08-31 00:24:33',
                'id' => 7,
                'is_active' => 1,
                'school_id' => 181,
                'type' => 'N/a',
                'updated_at' => '2022-08-31 00:24:33',
                'validity' => 'a',
                'years' => 4,
            ),
            7 => 
            array (
                'certification' => 'COE',
                'course_id' => 101,
                'created_at' => '2022-08-31 00:24:56',
                'id' => 8,
                'is_active' => 1,
                'school_id' => 181,
                'type' => 'N/a',
                'updated_at' => '2022-08-31 00:24:56',
                'validity' => 'a',
                'years' => 4,
            ),
            8 => 
            array (
                'certification' => 'COE',
                'course_id' => 35,
                'created_at' => '2022-09-20 23:34:16',
                'id' => 9,
                'is_active' => 1,
                'school_id' => 176,
                'type' => 'n/a',
                'updated_at' => '2022-09-20 23:34:16',
                'validity' => '4yrs',
                'years' => 4,
            ),
        ));
        
        
    }
}