<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ScholarProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('scholar_profiles')->delete();
        
        \DB::table('scholar_profiles')->insert(array (
            0 => 
            array (
                'birthday' => '1994-03-11',
                'created_at' => '2022-09-21 07:18:09',
                'email' => 'kradjumli@gmail.com',
                'firstname' => 'Ra-ouf',
                'gender' => '1',
                'id' => 1,
                'lastname' => 'Jumli',
                'middlename' => 'Indanan',
                'mobile' => '09557650803',
                'scholar_id' => 1,
                'suffix' => NULL,
                'updated_at' => '2022-09-21 07:18:09',
            ),
            1 => 
            array (
                'birthday' => '1995-03-11',
                'created_at' => '2022-09-21 07:39:39',
                'email' => 'johndoe@gmail.com',
                'firstname' => 'John',
                'gender' => '1',
                'id' => 2,
                'lastname' => 'Doe',
                'middlename' => 'Ex',
                'mobile' => '09123456789',
                'scholar_id' => 2,
                'suffix' => NULL,
                'updated_at' => '2022-09-21 07:39:39',
            ),
            2 => 
            array (
                'birthday' => '1994-03-11',
                'created_at' => '2022-09-22 05:00:16',
                'email' => 'robertsnow@yahoo.com',
                'firstname' => 'Robert',
                'gender' => '1',
                'id' => 3,
                'lastname' => 'Snow',
                'middlename' => 'B',
                'mobile' => '09123456111',
                'scholar_id' => 3,
                'suffix' => NULL,
                'updated_at' => '2022-09-22 05:00:16',
            ),
        ));
        
        
    }
}