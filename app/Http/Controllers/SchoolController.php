<?php

namespace App\Http\Controllers;

use Hashids\Hashids;
use App\Models\School;
use App\Models\SchoolCampus;
use App\Models\SchoolCourse;
use Illuminate\Http\Request;
use App\Http\Requests\SchoolRequest;
use App\Http\Resources\SchoolResource;
use App\Http\Resources\SchoolListResource;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\SchoolPublicResource;
use App\Http\Resources\School\CourseResource;

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
       
        if($request->option != 'course'){
            if($request->new == 'false'){
                $data = School::findOrFail($request->id);
                $data->campuses()->create($request->all());
                $id = \DB::getPdo()->lastInsertId();
                $data = new SchoolListResource(SchoolCampus::findOrFail($id));
            }else{
                $data = School::create($request->all());
                $data->campuses()->create($request->all());
                $id = \DB::getPdo()->lastInsertId();
                $data = new SchoolListResource(SchoolCampus::findOrFail($id));
            }
            $message = 'School created successfully. Thanks';
        }else{
            if($request->editable){
                $message = 'Course successfully updated. Thanks';
                $data = SchoolCourse::findOrFail($request->id);
                $data->update($request->except('editable','option'));
                $data = SchoolCourse::findOrFail($request->id);
            }else{
                $message = 'Course successfully added. Thanks';
                $data = new CourseResource(SchoolCourse::create($request->all()));
            }
        }

        return back()->with([
            'message' => $message,
            'data' => $data,
            'type' => 'bxs-check-circle'
        ]); 
    }

    public function update(SchoolRequest $request){
        $data = \DB::transaction(function () use ($request){
           
            $data = SchoolCampus::findOrFail($request->id);
            $data->update($request->all());
            $data = SchoolCampus::findOrFail($request->id);
    
            return [
                'data' => new SchoolListResource($data),
                'message' => 'School updated successfully. Thanks',
                'type' => 'bxs-check-circle'
            ];
            
        });
    
        return back()->with([
            'message' => $data['message'],
            'data' => ($data['data'] != '') ? $data['data'] : '',
            'type' => $data['type']
        ]);
    }

    public function show($data){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($data);
        
        $data = SchoolCampus::with('school','school.class')
        ->with('municipality.province.region','term','grading','courses.course')
        ->where('id',$id)->first();
        
        return inertia('Schools/View',[
            'school' => new SchoolListResource($data)
        ]);
    }

    public function api(){
        $data = School::with('campuses','campuses.courses')->get();
        return $data;
    }

    public function search(Request $request){
        $keyword = $request->keyword;
        if($request->type == 'school'){
            $location = (!empty(json_decode($request->location))) ? json_decode($request->location) : NULL;
            $data = SchoolPublicResource::collection(
                SchoolCampus::with('school','courses.course')
                ->with('municipality.province.region')
                ->when($keyword, function ($query, $keyword) {
                    $query->where('campus', 'LIKE', "%{$keyword}%")
                    ->orWhereHas('school',function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%{$keyword}%");
                    });
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
                ->paginate(10)
                ->withQueryString()
            );
        }else{
            $data = SchoolPublicResource::collection(
                SchoolCampus::with('school','courses.course')
                ->with('municipality.province.region')
                ->when($keyword, function ($query, $keyword) {
                    $query->whereHas('courses',function ($query) use ($keyword) {
                        $query->whereHas('course',function ($query) use ($keyword) {
                            $query->where('name', 'LIKE', "%{$keyword}%");
                        });
                    });
                })
                ->paginate(10)
                ->withQueryString()
            );
        }
        
        return $data;
    }
}
