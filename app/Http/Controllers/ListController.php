<?php

namespace App\Http\Controllers;

use App\Models\ListCourse;
use Illuminate\Http\Request;
use App\Models\LocationProvince;
use App\Models\LocationMunicipality;
use App\Models\LocationBarangay;
use App\Models\SchoolCampus;
use App\Models\School;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\School\SchoolResource;
use App\Http\Resources\School\CampusResource;

class ListController extends Controller
{
    public function provinces($id = null)
    {
        $data = LocationProvince::where('region_code',$id)->orderBy('name','ASC')->get();
        return DefaultResource::collection($data);
    }

    public function municipalities($id = null)
    {
        $data = LocationMunicipality::where('province_code',$id)->orderBy('name','ASC')->get();
        return DefaultResource::collection($data);
    }

    public function barangays($id = null)
    {
        $data = LocationBarangay::where('municipality_code',$id)->orderBy('name','ASC')->get();
        return DefaultResource::collection($data);
    }

    public function schools(Request $request){

        $keyword = $request->input('word');
        $data = School::where(function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })->get()->take(5);

        return SchoolResource::collection($data);
    }

    public function campuses(Request $request){

        $keyword = $request->input('word');
        $data = SchoolCampus::with('school')
        ->whereHas('school',function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orWhere(function ($query) use ($keyword) {
            $query->where('campus',$keyword);
        })->get()->take(10);

        return CampusResource::collection($data);
    }

    public function courses(Request $request){
        $keyword = $request->input('word');
        $data = ListCourse::where('name','LIKE','%'.$keyword.'%')->get()->take(10);
        return DefaultResource::collection($data);
    }
}
