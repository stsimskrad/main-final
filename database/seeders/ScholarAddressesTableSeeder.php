<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ScholarAddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('scholar_addresses')->delete();
        
        \DB::table('scholar_addresses')->insert(array (
            0 => 
            array (
                'address' => NULL,
                'barangay_code' => '097332004',
                'created_at' => '2022-09-21 07:14:57',
                'id' => 1,
                'municipality_code' => '097332000',
                'province_code' => '099300000',
                'region_code' => '090000000',
                'scholar_id' => 1,
                'updated_at' => '2022-09-21 07:14:57',
            ),
            1 => 
            array (
                'address' => NULL,
                'barangay_code' => '086005001',
                'created_at' => '2022-09-21 07:37:14',
                'id' => 3,
                'municipality_code' => '086005000',
                'province_code' => '086000000',
                'region_code' => '080000000',
                'scholar_id' => 2,
                'updated_at' => '2022-09-21 07:37:14',
            ),
            2 => 
            array (
                'address' => NULL,
                'barangay_code' => '097332004',
                'created_at' => '2022-09-22 04:58:16',
                'id' => 4,
                'municipality_code' => '097332000',
                'province_code' => '099300000',
                'region_code' => '090000000',
                'scholar_id' => 3,
                'updated_at' => '2022-09-22 04:58:16',
            ),
        ));
        
        
    }
}