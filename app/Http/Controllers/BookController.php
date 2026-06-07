<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Book::with('category')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'published_year' => 'nullable|integer|min:1900|max:'.date('Y'),
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $book = Book::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Buku ditambahkan',
            'data' => $book->load('category'),
        ], 201);
    }

    public function show($id)
    {
        $book = Book::with('category')->find($id);
        if (! $book) {
            return response()->json(['success' => false, 'message' => 'Buku tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $book]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (! $book) {
            return response()->json(['success' => false, 'message' => 'Buku tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'isbn' => 'sometimes|string|unique:books,isbn,'.$id,
            'stock' => 'sometimes|integer|min:0',
            'category_id' => 'sometimes|exists:categories,id',
            'published_year' => 'nullable|integer|min:1900|max:'.date('Y'),
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $book->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Buku diperbarui',
            'data' => $book->load('category'),
        ]);
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        if (! $book) {
            return response()->json(['success' => false, 'message' => 'Buku tidak ditemukan'], 404);
        }
        $book->delete();

        return response()->json(['success' => true, 'message' => 'Buku dihapus']);
    }
}
