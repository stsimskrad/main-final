<?php

namespace App\Http\Controllers\Api;

use App\Models\Scholar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class ScholarController extends Controller
{
    public function index(Request $request){
        $region_code = $request->code;
        $data = Scholar::with('profile','address.region','address.province','address.municipality','address.barangay')
        ->with('program','status')->with('profile')->with('education.school.school','education.course','education.level')
        ->whereHas('address',function ($query) use ($region_code) {
            $query->where('region_code',$region_code);
        })
        ->orderBy('awarded_year','DESC')
        ->paginate(10)
        ->withQueryString();
        return DefaultResource::collection($data);
    }
}
