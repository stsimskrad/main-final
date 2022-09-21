<?php

namespace App\Http\Controllers\Api;

use App\Models\Qualifier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class QualifierController extends Controller
{
    public function index(Request $request){
        $region_code = $request->code;
        $data = Qualifier::with('region','province','municipality','barangay')
        ->with('program')
        ->where('region_code',$region_code)
        ->orderBy('year','DESC')
        ->paginate(10)
        ->withQueryString();
        return DefaultResource::collection($data);
    }
}
