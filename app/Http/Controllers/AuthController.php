<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitasModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        LogAktivitasModel::create([
            'user_email' => $user->email,
            'action' => 'REGISTER',
            'resource' => 'auth',
            'description' => 'User baru terdaftar: '.$user->email,
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'data' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        LogAktivitasModel::create([
            'user_email' => $request->email,
            'action' => 'LOGIN',
            'resource' => 'auth',
            'description' => 'User login: '.$request->email,
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,
        ]);
    }

    public function logout(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            LogAktivitasModel::create([
                'user_email' => $user->email,
                'action' => 'LOGOUT',
                'resource' => 'auth',
                'description' => 'User logout: '.$user->email,
                'ip_address' => $request->ip(),
            ]);
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (\Exception $e) {
        }

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }

    public function me()
    {
        return response()->json([
            'success' => true,
            'data' => JWTAuth::parseToken()->authenticate(),
        ]);
    }
}
