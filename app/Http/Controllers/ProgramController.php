<?php

namespace App\Http\Controllers;

use App\Models\ListProgram;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        if($request->search){
            $keyword = $request->keyword;
            $data = DefaultResource::collection(
                ListProgram::query()
                ->when($request->keyword, function ($query, $keyword) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%{$keyword}%");
                    });
                })
                ->paginate($request->count)
                ->withQueryString()
            );
            return $data;
        }else{
            return inertia('Programs/Index');
        }
    }

    public function store(Request $request)
    { 
        $data = \DB::transaction(function () use ($request){
            return $data = ListProgram::create($request->all());
        });

        return back()->with([
            'message' => 'Program created successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle'
        ]); 
    }

    public function update(Request $request)
    {   
        $data = \DB::transaction(function () use ($request){
           
            $data = ListProgram::findOrFail($request->id);
            $data->update($request->except('editable'));
            $data = ListProgram::findOrFail($request->id);

            return [
                'data' => $data,
                'message' => 'Program updated successfully. Thanks',
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
        $data = ListProgram::all();
        return $data;
    }
}
