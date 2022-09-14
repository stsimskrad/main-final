<?php

namespace App\Http\Controllers;

use App\Models\ListPrivilege;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class PrivilegeController extends Controller
{
    public function index(Request $request)
    {
        if($request->search){
            $keyword = $request->keyword;
            $data = DefaultResource::collection(
                ListPrivilege::query()
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
            return inertia('Privileges/Index');
        }
    }

    public function store(Request $request)
    { 
        $data = \DB::transaction(function () use ($request){
            return $data = ListPrivilege::create($request->all());
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
           
            $data = ListPrivilege::findOrFail($request->id);
            $data->update($request->except('editable'));
            $data = ListPrivilege::findOrFail($request->id);

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
        $data = ListPrivilege::all();
        return $data;
    }
}
