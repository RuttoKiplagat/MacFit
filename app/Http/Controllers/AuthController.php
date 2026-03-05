<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserOtp;
use App\Mail\OtpMail;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
     public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:40',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:4|max:15|confirmed',
            'user_image' => 'nullable|image|max:255|mimes:jpg,jpeg,png',
            'is_active' => 'boolean',
            'role_id' => 'required|integer|exists:roles,id',
        ]);
        if ($request->role_id) {
            $role_id = $request->role_id;}
            else {
                $role = Role::where('name', 'User')->first();
                $role_id = $role->id;

             }
            
            
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_id = $role_id;
        $user->password = Hash::make($validated['password']);
        

        if ($request->hasFile('user_image')) {
            $filename = $request->file('user_image')->store('users', 'public');
            $user->user_image = $filename;
           } else{
                $filename = null;
            }

        
        try {
            $user->save();
             $signedUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id, 
            'hash' => sha1($user->email)
            ]
        );

        $user->notify(new VerifyEmailNotification($signedUrl));
        return response()->json([
            'message' => 'Verification email resent successfully.'
        ], 200);
       

        } catch (\Exception $exception) {
            return response()->json([
                'Error' => 'Registration failed.',
                'Message' => $exception->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4'
        ]);

        try {
            $user = User::where('email', $validated['email'])->first();

            if (!$user || !Hash::check($validated['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'error' => ['The provided credentials are incorrect.'],
                ], 401);
            }
            if (!$user->is_active) {
                return response()->json([
                    'message' => 'Your account is inactive. Please verify your email address.'
                ], 403);
            }
            $otp = rand(100000, 999999);
            $expiresAt = now()->addMinutes(5);

            UserOtp::updateOrCreate([
                'user_id'=>$user->id,
                'otp'=>$otp,
                'expires_at'=>$expiresAt
            ]);

            Mail::to($user->email)->send(new OtpMail($otp));

            

            return response()->json([
                'message' => 'OTP sent to your email. Please verify login',
      
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'Error' => 'Invalid Credentials.'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Log Out Successful.'
        ]);
    }
    public function userInfo(){
        return response()->json(auth());
    }
    }

