<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ScholarsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('scholars')->delete();
        
        \DB::table('scholars')->insert(array (
            0 => 
            array (
                'awarded_year' => 2022,
                'created_at' => '2022-09-21 07:14:08',
                'id' => 1,
                'is_undergrad' => 1,
                'lrn' => '000001',
                'program_id' => 1,
                'spas_id' => 'SPAS-000001',
                'status_id' => 31,
                'updated_at' => '2022-09-21 07:14:08',
            ),
            1 => 
            array (
                'awarded_year' => 2022,
                'created_at' => '2022-09-21 07:36:03',
                'id' => 2,
                'is_undergrad' => 1,
                'lrn' => '000002',
                'program_id' => 1,
                'spas_id' => 'SPAS-000002',
                'status_id' => 31,
                'updated_at' => '2022-09-21 07:36:03',
            ),
            2 => 
            array (
                'awarded_year' => 2022,
                'created_at' => '2022-09-22 04:57:38',
                'id' => 3,
                'is_undergrad' => 1,
                'lrn' => '000003',
                'program_id' => 1,
                'spas_id' => 'SPAS-000003',
                'status_id' => 31,
                'updated_at' => '2022-09-22 04:57:38',
            ),
        ));
        
        
    }
}