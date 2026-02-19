<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    
    public function createEquipment(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'usage' => 'required|string',
            'model_no' => 'required|integer',
            'value' => 'required|string',
            'status' => 'required|string',
        ]);
        $equipment = new Equipment();
        $equipment->name = $validated['name'];
        $equipment->usage = $validated['usage'];
        $equipment->model_no = $validated['model_no'];
        $equipment->value = $validated['value'];
        $equipment->status = $validated['status'];

        try{
            $equipment->save();
            return response()->json($equipment);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'failed to create equipment',
                'message' => $exception->getMessage()
            ]);
        }

    }
    public function readAllEquipments(){
        try{
            $equipments = Equipment::all();
            return response()->json($equipments);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'failed to fetch equipments',
                'message' => $exception->getMessage()
            ]);
        }
        }
        public function readEquipment($id){
            try{
                $equipment = Equipment::findOrFail($id);
                return response()->json($equipment);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to fetch equipment',                    
                    'message' => $exception->getMessage()
                ]);
            }
        }
        public function updateEquipment(Request $request, $id){
                   $validated = $request->validate([
            'name' => 'required|string',
            'usage' => 'required|string',
            'model_no' => 'required|integer',
            'value' => 'required|string',
            'status' => 'required|string',
        ]);
           $equipment = new Equipment();
        $equipment->name = $validated['name'];
        $equipment->usage = $validated['usage'];
        $equipment->model_no = $validated['model_no'];
        $equipment->value = $validated['value'];
        $equipment->status = $validated['status'];
            try{
                $equipment = Equipment::findOrFail($id);
                $equipment->name = $validated['name'];
                $equipment->usage = $validated['usage'];
                $equipment->model_no = $validated['model_no'];
                $equipment->value = $validated['value'];
                $equipment->status = $validated['status'];
                $equipment->save();
                return response()->json($equipment);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to update equipment',
                    'message' => $exception->getMessage()
                ]);
            }

        }
        public function deleteEquipment($id){
            try{
                $equipment = Equipment::findOrFail($id);
                $equipment->delete();
                return response("Equipment deleted succesfully");
            }
            catch(\Exception $exception){
                return response()->json([
                    
                    'error' => 'failed to delete equipment',
                    'message' => $exception->getMessage()
                ]);
            }
        }
}
