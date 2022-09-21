<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListExpensesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_expenses')->delete();
        
        \DB::table('list_expenses')->insert(array (
            0 => 
            array (
                'code' => 'HONORARIUM-PLeader',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 18,
                'id' => 1,
            'name' => 'Honorarium of One (1) Project Leader',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            1 => 
            array (
                'code' => 'HONORARIUM-PCoord',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 18,
                'id' => 2,
            'name' => 'Honorarium of One (1) Project Coordinator',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            2 => 
            array (
                'code' => 'HONORARIUM-RegStaff',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 18,
                'id' => 3,
            'name' => 'Honorarium of Three (3) Regional Program Support Staff',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            3 => 
            array (
                'code' => 'InterCOMMITTEE',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 18,
                'id' => 4,
                'name' => 'Inter-Agency Committee Meeting',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            4 => 
            array (
                'code' => 'UnivCOORDINATOR',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 18,
                'id' => 5,
                'name' => 'University Coordinator',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            5 => 
            array (
                'code' => 'SUPPLIES-MATERIALS',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 6,
                'name' => 'Supplies and Materials, Communication Expenses, Traveling Allowances, Coordination, Meeting, Workshop and other Related Expenses',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            6 => 
            array (
                'code' => 'SERVICE-FEE PA III',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 7,
            'name' => 'Service Fee of One (1) Project Assistant III',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            7 => 
            array (
                'code' => 'SERVICE-FEE PA II',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 8,
            'name' => 'Service Fee of One (1) Project Assistant II',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            8 => 
            array (
                'code' => 'TUITION-SCHOOL',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 20,
                'id' => 9,
                'name' => 'Tuition and Other School Fees',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            9 => 
            array (
                'code' => 'STIPEND',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 20,
                'id' => 10,
                'name' => 'Monthly Stipends',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            10 => 
            array (
                'code' => 'BOOKALLOW',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 20,
                'id' => 11,
                'name' => 'Book Allowance',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            11 => 
            array (
                'code' => 'PEMSALLOW',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 20,
                'id' => 12,
                'name' => 'PE/MS Allowances',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            12 => 
            array (
                'code' => 'TRANSPO',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 20,
                'id' => 13,
                'name' => 'Actual Transportation Allowance of Scholars',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            13 => 
            array (
                'code' => 'STLAP',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 20,
                'id' => 14,
                'name' => 'STLAP',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            14 => 
            array (
                'code' => 'GROUP-INSURANCE',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 20,
                'id' => 15,
                'name' => 'Group Health and Accident Insurance',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            15 => 
            array (
                'code' => 'SUMMER',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 20,
                'id' => 16,
                'name' => 'Financial Assistance during Summer',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            16 => 
            array (
                'code' => 'GRADUATION-ALLOW',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 20,
                'id' => 17,
                'name' => 'Graduation Allowance',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            17 => 
            array (
                'code' => 'CO',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 21,
                'id' => 18,
                'name' => 'Capital Outlay',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            18 => 
            array (
                'code' => 'HONORARIUM-GreatM',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 18,
                'id' => 19,
                'name' => 'Honorarium GreatM',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            19 => 
            array (
                'code' => 'SUP-MATERIALS-GREATM',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 20,
                'name' => 'Supplies and Materials, Communication Expenses, Traveling Allowances, Coordination, Meeting, Workshop and other Related Expenses - GreatM',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            20 => 
            array (
                'code' => 'TestPromoInfoDev',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 21,
                'name' => 'Test Promotion and Information Development',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            21 => 
            array (
                'code' => 'Mainten-TestCenter',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 22,
                'name' => 'Travel Expenses to transfer test centers of the JLSS examinees from Basilan, Sulu and Tawi-tawi to Zamboanga',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            22 => 
            array (
                'code' => 'GRATUITYPAY',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 23,
                'name' => 'Gratuity Pay',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            23 => 
            array (
                'code' => 'otherScholarAct',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 24,
                'name' => 'Other Scholarship Activity',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            24 => 
            array (
                'code' => 'HONORARIUM-PSTCs',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 18,
                'id' => 25,
            'name' => 'Honorarium of Three (3) PSTCs',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            25 => 
            array (
                'code' => 'SERVICE-FEE 2 PA II',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 26,
            'name' => 'Service Fee of Two (2) Project Assistant II',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            26 => 
            array (
                'code' => 'SERVICE-FEE CO I',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 27,
            'name' => 'Service Fee of One (1) Computer Operator I',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            27 => 
            array (
                'code' => 'Mainten-TestCenter',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 28,
                'name' => 'Travel Expenses to transfer test centers of the JLSS examinees',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            28 => 
            array (
                'code' => 'TEST-ADMIN',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 29,
                'name' => 'Test Administration',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            29 => 
            array (
                'code' => 'NOTAR',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 30,
                'name' => 'Notarization Fee',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            30 => 
            array (
                'code' => 'SERVICE-FEE-SRS1',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 31,
            'name' => 'Service Fee of One (1) Science Research Specialist I',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            31 => 
            array (
                'code' => 'DEV-STSIMS',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 20,
                'id' => 32,
                'name' => 'Development of S&T Information Management System',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            32 => 
            array (
                'code' => 'PILOT-TEST-JLSS',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 20,
                'id' => 33,
                'name' => 'Pilot Testing of the new items for JLSS Scholarship Examination',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            33 => 
            array (
                'code' => 'CO-I',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 34,
            'name' => 'Service Fee of Three (3) Computer Operator I',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            34 => 
            array (
                'code' => 'HAZARD-ALLOW',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 35,
                'name' => 'Hazard Allowance',
                'updated_at' => '2022-06-02 00:00:00',
            ),
            35 => 
            array (
                'code' => 'THESIS-ALLOWANCE',
                'created_at' => '2022-06-02 00:00:00',
                'expenditure_id' => 19,
                'id' => 36,
                'name' => 'Thesis Allowance',
                'updated_at' => '2022-06-02 00:00:00',
            ),
        ));
        
        
    }
}