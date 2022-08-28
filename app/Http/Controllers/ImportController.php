<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserEmployee;
use App\Models\ListPosition;
use Illuminate\Http\Request;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index(Request $request){
        $validated = $request->validate([
            'import_file' => 'required'
        ]);

        $datas =  Excel::toCollection(new EmployeeImport,$request->import_file);

        foreach($datas as $data){
            $rows = $data;
            foreach($rows as $row){
                if($row[3] != ''){
                    switch($row[24]){
                        case 'Zamboanga del Norte': 
                            $office = 8;
                        break;
                        case 'Zamboanga Sibugay': 
                            $office = 10;
                        break;
                        case 'Zamboanga del Sur': 
                            $office = 9;
                        break;
                        case 'Zamboanga City': 
                            $office = 7;
                        break;
                    }

                    $position = $row[11];
                    $position_res = ListPosition::where('name',$position)->first();
                    ($position_res != null) ? $position = $position_res->id : $position = 1;

                    switch($row[5]){
                        case 'C': 
                            $status = 6;
                        break;
                        case 'P': 
                            $status = 5;
                        break;
                        case 'D': 
                            $status = 7;
                        break;
                    }

                    if($row[25] == 'TS' || $row[25] == 'FASS'){
                        $department = 3;
                    }else if($row[25] == 'FOS'){
                        $department = 4;
                    }else{
                        $department = 2;
                    }

                    $mobile = str_replace("-","",$row[18]);

                    $employee[] = [
                        'username' => $row[6],
                        'firstname' => $row[8],
                        'middlename' => $row[9],
                        'lastname' => $row[7],
                        'suffix' => '',
                        'email' => ($row[19] == '' || $row[19] == 'n/a' || $row[19] == 'N/A') ? strtolower($row[6]).'@gmail.com' : $row[19],
                        'mobile' => $mobile,
                        'birthday' => $row[14],
                        'gender' => $row[13],
                        'office' => $office,
                        'position' => $position,
                        'status' => $status,
                        'department' => $department
                    ];
                }
            }
        }
        return $employee;
    }

    public function store(Request $request){
        set_time_limit(0);

        $result = \DB::transaction(function () use ($request){
            $employees = $request->users;
            $users = array();
            $success = array();
            $failed = array();
            $duplicate = array();

            foreach($employees as $employee){
                $count = User::where('username',$employee['username'])->count();
                if($count == 0){
                    $user = [ 
                        'email' => $employee['email'],
                        'username' => $employee['username'],
                        'avatar' => 'avatar.jpg',
                        'password' => bcrypt('dost9ict'),
                        'role' => 'Employee',
                        'created_at'	=> now(),
                        'updated_at'	=> now()
                    ];

                    \DB::beginTransaction();
                    $user_model = User::create($user);

                    if($user_model)
                    {       
                        $birthday = date('Y-m-d',strtotime($employee['birthday']));                
                        $profile_data = [
                            'user_id' => $user_model->id,
                            'firstname' => $employee['firstname'],
                            'middlename' => $employee['middlename'],
                            'lastname' => $employee['lastname'],
                            'suffix' => $employee['suffix'],
                            'gender' => $employee['gender'],
                            'birthday' => $birthday,
                            'mobile' => $employee['mobile'],
                            'created_at'	=> now(),
                            'updated_at'	=> now()
                        ];

                        $profile_model = UserProfile::insertOrIgnore($profile_data); 

                        if($profile_model){
                            $employee_data = [
                                'user_id' => $user_model->id,
                                'position_id' => $employee['position'],
                                'department_id' => $employee['department'],
                                'office_id' => $employee['office'],
                                'status_id' => $employee['status'],
                                'created_at'	=> now(),
                                'updated_at'	=> now()
                            ];

                            $employee_model = UserEmployee::insertOrIgnore($employee_data); 

                            if($employee_model){
                                array_push($success,$employee['username']);
                                \DB::commit();
                            }else{
                                array_push($failed,$employee['username']);
                                \DB::rollback();
                            }
    
                        }
                       
                    }else{
                        array_push($failed,$employee['username']);
                        \DB::rollback();
                    }
                }else{
                    array_push($duplicate,$employee['username']);
                }
            }

            $result = [
                'success' => $success,
                'failed' => $failed,
                'duplicate' => $duplicate,
            ];

            return $result;
        });
    }
}
