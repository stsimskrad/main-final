<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\SchoolCampus;
use Illuminate\Http\Request;
use App\Http\Requests\SchoolRequest;
use App\Http\Resources\SchoolResource;
use App\Http\Resources\SchoolListResource;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        if($request->search){
            $info = (!empty(json_decode($request->info))) ? json_decode($request->info) : NULL;
            $location = (!empty(json_decode($request->location))) ? json_decode($request->location) : NULL;
            $keyword = $info->keyword;

            $data = SchoolListResource::collection(
                SchoolCampus::with('school','school.class')
                ->with('municipality.province.region','term','grading')
                ->when($info->keyword, function ($query, $keyword) {
                    $query->where('campus', 'LIKE', "%{$keyword}%")
                    ->orWhereHas('school',function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%{$keyword}%");
                    });
                })
                ->when($info, function ($query,$info) {
                    ($info->term == null) ? '' : $query->where('term_id',$info->term);
                    ($info->grading == null) ? '' : $query->where('grading_id',$info->grading);
                })
                ->whereHas('school',function ($query) use ($keyword,$info) {
                    $query->where(function ($query) use ($info) {
                        ($info->class == null) ? '' : $query->where('class_id',$info->class);
                        $query->orderBy('name','DESC');
                    });
                    $query->orderBy('name','DESC');
                })
                ->where(function ($query) use ($location) {
                    if(!empty($location)){
                        if(property_exists($location, 'municipality')){
                            $query->where('municipality_code',$location->municipality);
                        }else if(property_exists($location, 'province')){
                            $query->whereHas('municipality',function ($query) use ($location) {
                                $query->whereHas('province',function ($query) use ($location) {
                                    $query->where('province_code',$location->province);
                                });
                            });
                        }else if(property_exists($location, 'region')){
                            $query->whereHas('municipality',function ($query) use ($location) {
                                $query->whereHas('province',function ($query) use ($location) {
                                    $query->whereHas('region',function ($query) use ($location) {
                                        $query->where('region_code',$location->region);
                                    });
                                });
                            });
                        }
                    }
                })
                ->paginate($info->counts)
                ->withQueryString()
            );
            return $data;
        }else{
            return inertia('Schools/Index');
        }
    }

    public function store(SchoolRequest $request){
        $data = \DB::transaction(function () use ($request){
            if($request->new == 'false'){
                $data = School::findOrFail($request->id);
                $data->campuses()->create($request->all());
                $id = \DB::getPdo()->lastInsertId();
                return $data = SchoolCampus::findOrFail($id);
            }else{
                $data = School::create($request->all());
                $data->campuses()->create($request->all());
                $id = \DB::getPdo()->lastInsertId();
                return $data = SchoolCampus::findOrFail($id);
            }
            // if($request->editable){
            //     $data = School::findOrFail($request->id);
            //     $data->update($request->except('editable'));
            //     return $data;
            // }else{
            //     $data = School::create($request->all());
            //     $data->campuses()->create($request->all());
            //     return $data;
            // }
        });

        return back()->with([
            'message' => 'School created successfully. Thanks',
            'data' => new SchoolListResource($data),
            'type' => 'bxs-check-circle'
        ]); 
    }
}
