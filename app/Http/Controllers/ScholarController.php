<?php

namespace App\Http\Controllers;

use App\Models\Scholar;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class ScholarController extends Controller
{
    public function index(Request $request){

        if($request->search){
            $info = (!empty(json_decode($request->info))) ? json_decode($request->info) : NULL;
            $education = (!empty(json_decode($request->education))) ? json_decode($request->education) : NULL;
            $location = (!empty(json_decode($request->location))) ? json_decode($request->location) : NULL;
    
            $data = DefaultResource::collection(
                Scholar::with('profile','address.region','address.province','address.municipality','address.barangay')
                ->with('program','status')->with('profile')->with('education.school.school','education.course')
                ->when($info->keyword, function ($query, $keyword) {
                    $query->whereHas('profile',function ($query) use ($keyword) {
                        $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')
                        ->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%')
                        ->orWhere('spas_id','LIKE','%'.$keyword.'%');
                    });
                })
               ->whereHas('address',function ($query) use ($location) {
                    if(!empty($location)){
                        (property_exists($location, 'region')) ? $query->where('region_code',$location->region) : '';
                        (property_exists($location, 'province')) ? $query->where('province_code',$location->province) : '';
                        (property_exists($location, 'municipality')) ? $query->where('municipality_code',$location->municipality) : '';
                        (property_exists($location, 'barangay')) ? $query->where('barangay_code',$location->barangay) : '';
                    }
                })
                ->whereHas('education',function ($query) use ($education) {
                    if(!empty($education)){
                        (property_exists($education, 'school')) ? $query->where('school_id',$education->school) : '';
                        (property_exists($education, 'course')) ? $query->where('course_id',$education->course) : '';
                    }
                 })
                ->where(function ($query) use ($info) {
                    ($info->program == null) ? '' : $query->where('program_id',$info->program);
                    ($info->status == null) ? '' : $query->where('status_id',$info->status);
                    ($info->is_undergrad == 'all') ? '' : $query->where('is_undergrad',$info->is_undergrad);
                    ($info->year == null) ? '' : $query->where('awarded_year',$info->year);
                })
                ->orderBy('awarded_year','DESC')
                ->paginate($info->counts)
                ->withQueryString()
            );
            return $data;
        }else{
            return inertia('Scholars/Index');
        }
    }

    public function show($data){
        if($data == 'new'){
            return inertia('Scholars/Create');
        }
    }
}
