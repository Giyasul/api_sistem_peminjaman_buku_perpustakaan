<?php

namespace App\Http\Middleware;

use App\Models\LogAktivitasModel;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogAktivitas
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            $user = JWTAuth::parseToken()->authenticate();
            $email = $user ? $user->email : 'guest';
        } catch (\Exception $e) {
            $email = 'guest';
        }

        $method = $request->method();
        $path = $request->path();

        $actionMap = [
            'GET' => 'READ',
            'POST' => 'CREATE',
            'PUT' => 'UPDATE',
            'PATCH' => 'UPDATE',
            'DELETE' => 'DELETE',
        ];

        LogAktivitasModel::create([
            'user_email' => $email,
            'action' => $actionMap[$method] ?? $method,
            'resource' => $path,
            'description' => $method.' '.$request->fullUrl(),
            'ip_address' => $request->ip(),
        ]);

        return $response;
    }
}
