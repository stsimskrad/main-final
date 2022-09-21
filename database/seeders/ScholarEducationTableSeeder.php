<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ScholarEducationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('scholar_education')->delete();
        
        \DB::table('scholar_education')->insert(array (
            0 => 
            array (
                'award_id' => NULL,
                'course_id' => 35,
                'created_at' => '2022-09-21 07:16:36',
                'graduated_year' => NULL,
                'id' => 1,
                'information' => '[]',
                'level_id' => 2,
                'scholar_id' => 1,
                'school_id' => 183,
                'updated_at' => '2022-09-21 07:16:36',
            ),
            1 => 
            array (
                'award_id' => NULL,
                'course_id' => 35,
                'created_at' => '2022-09-21 07:38:59',
                'graduated_year' => NULL,
                'id' => 2,
                'information' => '[]',
                'level_id' => 2,
                'scholar_id' => 2,
                'school_id' => 176,
                'updated_at' => '2022-09-21 07:38:59',
            ),
            2 => 
            array (
                'award_id' => NULL,
                'course_id' => 35,
                'created_at' => '2022-09-22 04:59:30',
                'graduated_year' => NULL,
                'id' => 3,
                'information' => '[]',
                'level_id' => 2,
                'scholar_id' => 3,
                'school_id' => 183,
                'updated_at' => '2022-09-22 04:59:30',
            ),
        ));
        
        
    }
}