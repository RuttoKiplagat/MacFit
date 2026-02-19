<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
        public function createUser(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);
    
            try {
                $user = new User();
                $user->name = $validated['name'];
                $user->email = $validated['email'];
                $user->password = bcrypt($validated['password']);
                $user->save();
    
                return response()->json($user, 201);
            } catch (\Exception $exception) {
                return response()->json([
                    'error' => 'Failed to create user',
                    'message' => $exception->getMessage()
                ], 500);
            }
        }
        public function readAllUsers(){
        try{
            $users = User::all();
            return response()->json($users);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'failed to fetch users',
                'message' => $exception->getMessage()
            ]);
        }
        }
        public function readUser($id){
            try{
                $user = User::findOrFail($id);
                return response()->json($user);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to fetch user',                    
                    'message' => $exception->getMessage()
                ]);
            }
        }
        public function updateUser(Request $request, $id){
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
        ]);
                $user = new User();
                $user->name = $validated['name'];
                $user->email = $validated['email'];
                $user->password = bcrypt($validated['password']);
                $user->save();
            try{
                $user = User::findOrFail($id);
                $user->name = $validated['name'];
                $user->email = $validated['email'];
                $user->password = bcrypt($validated['password']);
                $user->save();
                return response()->json($user);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to update user',
                    'message' => $exception->getMessage()
                ]);
            }

        }
        public function deleteUser($id){
            try{
                $user = User::findOrFail($id);
                $user->delete();
                return response("User deleted succesfully");
            }
            catch(\Exception $exception){
                return response()->json([
                    
                    'error' => 'failed to delete user',
                    'message' => $exception->getMessage()
                ]);
            }
        }
}
