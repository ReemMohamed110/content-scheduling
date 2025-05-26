<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use PHPUnit\Util\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //register
    public function register(Request $request)
    {
        //  dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),

        ]);

        try {
            $token = $user->createToken('auth_token')->plainTextToken;
        } catch (Exception $e) {
            return response()->json(['error' => 'could not create token']);
        }
        return response()->json([new UserResource($user), 'token' => $token]);
    }
    //login
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token, new UserResource($user)]);
        }

        return response()->json(['error' => 'fail to login'], 401);
    }
    //update
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'user not found']);
        }
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['nullable', 'string'],
            'current_password' => ['required_with:password', 'string', 'nullable'],

        ]);
        $data = [];
        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        if (!empty($data)) {
            $user->update($data);


            return response()->json(['successful' => 'profile  updated successfully', new UserResource($user)]);
        }

        return response()->json(['error' => 'can not update profile']);
    }



    //logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['successfully' => 'you have successfully logged out']);
    }
}
