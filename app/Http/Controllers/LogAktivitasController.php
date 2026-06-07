<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitasModel;

class LogAktivitasController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => LogAktivitasModel::orderBy('created_at', 'desc')->get(),
        ]);
    }
}
