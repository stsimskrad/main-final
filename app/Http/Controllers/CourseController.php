<?php

namespace App\Http\Controllers;

use App\Models\ListCourse;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        if($request->search){
            $keyword = $request->keyword;
            $data = DefaultResource::collection(
                ListCourse::query()
                ->when($request->keyword, function ($query, $keyword) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%{$keyword}%")->orWhere('abbreviation', 'LIKE', "%{$keyword}%");
                    });
                })
                ->paginate($request->count)
                ->withQueryString()
            );
            return $data;
        }else{
            return inertia('Courses/Index');
        }
    }

    public function store(Request $request)
    { 
        $data = \DB::transaction(function () use ($request){
            return $data = ListCourse::create($request->all());
        });

        return back()->with([
            'message' => 'Course created successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle'
        ]); 
    }

    public function update(Request $request)
    {   
        $data = \DB::transaction(function () use ($request){
           
            $data = ListCourse::findOrFail($request->id);
            $data->update($request->except('editable'));
            $data = ListCourse::findOrFail($request->id);
            return [
                'data' => $data,
                'message' => 'Course updated successfully. Thanks',
                'type' => 'bxs-check-circle'
            ];
            
        });

        return back()->with([
            'message' => $data['message'],
            'data' => ($data['data'] != '') ? new DefaultResource($data['data']) : '',
            'type' => $data['type']
        ]);
    }

    public function api(){
        $data = ListCourse::all();
        return $data;
    }
}
