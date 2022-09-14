<?php

namespace App\Http\Controllers;

use App\Models\ListAgency;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class AgencyController extends Controller
{
    public function index(Request $request)
    {
        if($request->search){
            $keyword = $request->keyword;
            $data = DefaultResource::collection(
                ListAgency::query()
                ->with('region')
                ->when($request->keyword, function ($query, $keyword) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%{$keyword}%")->orWhere('acronym', 'LIKE', "%{$keyword}%");
                    });
                })
                ->paginate($request->count)
                ->withQueryString()
            );
            return $data;
        }else{
            return inertia('Agencies/Index');
        }
    }

    public function store(Request $request)
    { 
        $data = \DB::transaction(function () use ($request){
            return $data = ListAgency::create($request->all());
        });

        return back()->with([
            'message' => 'Agency created successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle'
        ]); 
    }

    public function update(Request $request)
    {   
        $data = \DB::transaction(function () use ($request){
           
            $data = ListAgency::findOrFail($request->id);
            $data->update($request->except('editable'));
            $data = ListAgency::findOrFail($request->id);
            return [
                'data' => $data,
                'message' => 'Agency updated successfully. Thanks',
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
        $data = ListAgency::all();
        return $data;
    }
}
