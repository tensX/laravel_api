<?php

namespace App\Http\Controllers;
use App\Models\Drag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DragController extends Controller
{
    public function update(Request $request)
    {


        $row = Drag::all();

        $data = $request->all();

        if(count($row) < 1){

            $validator = Validator::make($data, [
                'cell_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response(['error' => $validator->errors(), 'Validation Error']);
            }

            $data = Drag::create($data);
            return response(['data' => $data, 'message' => 'Cell created successfully'], 201);
        }
        

        $row = $row->first();
        
        $validator = Validator::make($data, [
        'cell_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $drag = Drag::find($row->id);
        $drag->update($data);
        
        return response(['data' => $drag, 'message' => 'Cell updated successfully'], 201);
    
        

        
    }
}
