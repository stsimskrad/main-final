<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EndorsementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('endorsements')->delete();
        
        \DB::table('endorsements')->insert(array (
            0 => 
            array (
                'created_at' => '2022-09-22 00:31:10',
                'endorsed_by' => '090000000',
                'endorsed_to' => '080000000',
                'id' => 1,
                'is_approved' => NULL,
                'is_seened' => 0,
                'scholar_id' => 1,
                'updated_at' => '2022-09-22 00:31:10',
                'user_id' => 1,
            ),
        ));
        
        
    }
}