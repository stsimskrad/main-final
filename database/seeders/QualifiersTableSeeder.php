<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QualifiersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('qualifiers')->delete();
        
        \DB::table('qualifiers')->insert(array (
            0 => 
            array (
                'address' => NULL,
                'barangay_code' => '097302001',
                'birthday' => '1994-03-11',
                'created_at' => '2022-09-22 07:36:35',
                'email' => 'qualifier@yahoo.com',
                'firstname' => 'John',
                'gender' => '1',
                'id' => 1,
                'information' => '[]',
                'is_undergrad' => 1,
                'lastname' => 'Doe',
                'middlename' => 'Bim',
                'mobile' => '09123456222',
                'municipality_code' => '097302000',
                'program_id' => 1,
                'province_code' => '097300000',
                'region_code' => '090000000',
                'spas_id' => 'SPAS-000011',
                'suffix' => NULL,
                'updated_at' => '2022-09-22 07:36:35',
                'year' => 2022
            ),
        ));
        
        
    }
}