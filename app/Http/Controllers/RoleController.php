<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function createRole(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'description' => 'nullable|string|max:1000',
        ]);
        $role = new Role();
        $role->name = $validated['name'];
        $role->description = $validated['description'];

        try{
            $role->save();
            return response()->json($role);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'failed to create role',
                'message' => $exception->getMessage()
            ]);
        }

    }
    public function readAllRoles(){
        try{
            $roles = Role::all();
            return response()->json($roles);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'failed to fetch roles',
                'message' => $exception->getMessage()
            ]);
        }
        }
        public function readRole($id){
            try{
                $role = Role::findOrFail($id);
                return response()->json($role);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to fetch role',                    
                    'message' => $exception->getMessage()
                ]);
            }
        }
        public function updateRole(Request $request, $id){
              $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string|max:1000',
        ]);
        $role = new Role();
        $role->name = $validated['name'];
        $role->description = $validated['description'];
            try{
                $existingRole = Role::findOrFail($id);

                $existingRole->name = $validated['name'];
                $existingRole->description = $validated['description'];
                $existingRole->save();
                return response()->json($existingRole);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to update role',
                    'message' => $exception->getMessage()
                ]);
            }

        }
        public function deleteRole($id){
            try{
                $role = Role::findOrFail($id);
                $role->delete();
                return response("Role deleted succesfully");
            }
            catch(\Exception $exception){
                return response()->json([
                    
                    'error' => 'failed to delete role',
                    'message' => $exception->getMessage()
                ]);
            }
        }
    }

