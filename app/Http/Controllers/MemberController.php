<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        return response()->json(['success' => true, 'data' => Member::all()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:members',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status'  => 'in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $member = Member::create($request->all());
        return response()->json(['success' => true, 'message' => 'Anggota ditambahkan', 'data' => $member], 201);
    }

    public function show($id)
    {
        $member = Member::with('loans.book')->find($id);
        if (!$member) {
            return response()->json(['success' => false, 'message' => 'Anggota tidak ditemukan'], 404);
        }
        return response()->json(['success' => true, 'data' => $member]);
    }

    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        if (!$member) {
            return response()->json(['success' => false, 'message' => 'Anggota tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'    => 'sometimes|string|max:255',
            'email'   => 'sometimes|email|unique:members,email,' . $id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status'  => 'in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $member->update($request->all());
        return response()->json(['success' => true, 'message' => 'Anggota diperbarui', 'data' => $member]);
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        if (!$member) {
            return response()->json(['success' => false, 'message' => 'Anggota tidak ditemukan'], 404);
        }
        $member->delete();
        return response()->json(['success' => true, 'message' => 'Anggota dihapus']);
    }
}