<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    
    public function createBundle(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'start_time' => 'required',
            'duration' => 'required',
            'category_id' => 'integer|exists:categories,id',
            'description' => 'string|max:1000',
        ]);
        $bundle = new Bundle();
        $bundle->name = $validated['name'];
        $bundle->start_time = $validated['start_time'];
        $bundle->duration = $validated['duration'];
        $bundle->category_id = $validated['category_id'];
        $bundle->description = $validated['description'];

        try{
            $bundle->save();
            return response()->json($bundle);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'failed to createbundle',
                'message' => $exception->getMessage()
            ]);
        }

    }
    public function readAllBundles(){
        try{
            $bundles = Bundle::join('categories','bundles.category_id','=','categories.id')
            ->select('bundles.*','categories.name as category_name')
            ->get();



            return response()->json($bundles);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'failed to fetchbundles',
                'message' => $exception->getMessage()
            ]);
        }
        }
        public function readBundle($id){
            try{
                            $bundle = Bundle::join('categories','bundles.category_id','=','categories.id')
            ->select('bundles.*','categories.name as category_name')
            ->where('bundles.id',$id)
            ->first();
            
                $bundle = Bundle::findOrFail($id);
                return response()->json($bundle);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to fetchbundle',                    
                    'message' => $exception->getMessage()
                ]);
            }
        }
        public function updateBundle(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|string',
            'start_time' => 'required',
            'duration' => 'required',
            'category_id' => 'integer|exists:categories,id',
            'description' => 'string|max:1000',
        ]);
         $bundle = new Bundle();
        $bundle->name = $validated['name'];
        $bundle->start_time = $validated['start_time'];
        $bundle->duration = $validated['duration'];
        $bundle->category_id = $validated['category_id'];
        $bundle->description = $validated['description'];
            try{
                $bundle =Bundle::findOrFail($id);
                $bundle->name = $validated['name'];
                $bundle->start_time = $validated['start_time'];
                $bundle->duration = $validated['duration'];
                $bundle->category_id = $validated['category_id'];
                $bundle->description = $validated['description'];
                $bundle->save();
                return response()->json($bundle);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to updatebundle',
                    'message' => $exception->getMessage()
                ]);
            }

        }
        public function deleteBundle($id){
            try{
                $bundle =Bundle::findOrFail($id);
                $bundle->delete();
                return response("Bundle deleted succesfully");
            }
            catch(\Exception $exception){
                return response()->json([
                    
                    'error' => 'failed to deletebundle',
                    'message' => $exception->getMessage()
                ]);
            }
        }
}
