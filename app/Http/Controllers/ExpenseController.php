<?php

namespace App\Http\Controllers;

use App\Models\ListExpense;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        if($request->search){
            $keyword = $request->keyword;
            $data = DefaultResource::collection(
                ListExpense::query()
                ->with('expenditure')
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
            return inertia('Expenses/Index');
        }
    }

    public function store(Request $request)
    { 
        $data = \DB::transaction(function () use ($request){
           $data = ListExpense::create($request->all());
           return $data = ListExpense::with('expenditure')->where('id',$data->id)->first();
        });

        return back()->with([
            'message' => 'Expense created successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle'
        ]); 
    }

    public function update(Request $request)
    {   
        $data = \DB::transaction(function () use ($request){
           
            $data = ListExpense::findOrFail($request->id);
            $data->update($request->except('editable'));
            $data = ListExpense::with('expenditure')->where('id',$request->id)->first();

            return [
                'data' => $data,
                'message' => 'Expense updated successfully. Thanks',
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
        $data = ListExpense::all();
        return $data;
    }
}
