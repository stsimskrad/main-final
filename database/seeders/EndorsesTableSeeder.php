<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EndorsesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('endorses')->delete();
        
        \DB::table('endorses')->insert(array (
            0 => 
            array (
                'course_id' => 35,
                'created_at' => '2022-09-22 00:31:10',
                'id' => 1,
                'information' => '{"id": 13, "name": "Doe, John Bim", "avatar": "avatar.jpg", "course": {"id": 35, "name": "Bs Civil Engineering"}, "school": {"id": 176, "name": "Samar College", "created_at": "Nov 30, -0001 12:00 am", "updated_at": "Nov 30, -0001 12:00 am"}, "address": {"id": 1005, "name": "Acad, Aurora, Zamboanga Del Sur", "region": {"id": 10, "code": "090000000", "name": "Zamboanga Peninsula", "island": "mindanao", "region": "Region IX"}, "barangay": {"id": 29766, "code": "097302001", "name": "Acad", "district": null, "old_name": null, "municipality_code": "097302000"}, "province": {"id": 50, "code": "097300000", "name": "Zamboanga Del Sur", "region_code": "090000000"}, "has_region": true, "has_barangay": true, "has_province": true, "is_completed": 1, "municipality": {"id": 1113, "code": "097302000", "name": "Aurora", "district": "1st", "old_name": null, "is_chartered": 0, "province_code": "097300000", "is_municipality": 1}, "has_municipality": true}, "profile": {"id": 1005, "email": "qualifier@yahoo.com", "gender": "Male", "mobile": "09123456222", "suffix": null, "birthday": "1994-03-11", "lastname": "Doe", "firstname": "John", "middlename": "Bim", "is_completed": 1}, "program": {"id": 1, "name": "RA 7687", "is_sub": 0, "others": "n/a", "is_active": 1, "created_at": "Nov 30, -0001 12:00 am", "updated_at": "Nov 30, -0001 12:00 am"}, "spas_id": "SPAS-000011", "is_waiting": 0, "information": {"level": "n/a", "course": "n/a", "school": "GODOD NHS", "address": {"zip": 7126, "name": "PRK. 1 SOMALIA, POBLACION", "name2": "GODOD, ZAMBOANGA DEL NORTE REGION 9", "region": 9, "street": "PRK. 1", "village": "SOMALIA", "barangay": "POBLACION", "district": 3, "province": "ZAMBOANGA DEL NORTE", "municipality": "GODOD"}, "parents": {"father": "n/a", "mother": "n/a"}, "birth_place": "n/a", "requirements": {"count": 0, "lacking": null}}, "is_referral": 0, "is_qualified": null, "is_undergrad": 1}',
                'municipality_code' => NULL,
                'name' => 'Doe, John Bim',
                'school_id' => 176,
                'spas_id' => 'SPAS-000011',
                'updated_at' => '2022-09-22 00:31:10',
            ),
        ));
        
        
    }
}