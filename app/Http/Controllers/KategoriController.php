<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        return response()->json(['success' => true, 'data' => Category::all()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $category = Category::create($request->only('name', 'description'));

        return response()->json(['success' => true, 'message' => 'Kategori ditambahkan', 'data' => $category], 201);
    }

    public function show($id)
    {
        $category = Category::with('books')->find($id);
        if (! $category) {
            return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (! $category) {
            return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $category->update($request->only('name', 'description'));

        return response()->json(['success' => true, 'message' => 'Kategori diperbarui', 'data' => $category]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (! $category) {
            return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan'], 404);
        }
        $category->delete();

        return response()->json(['success' => true, 'message' => 'Kategori dihapus']);
    }

    public function books($id)
    {
        $category = Category::with('books')->find($id);

        if (! $category) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'category' => $category->name,
            'total' => $category->books->count(),
            'data' => $category->books,
        ]);
    }
}
