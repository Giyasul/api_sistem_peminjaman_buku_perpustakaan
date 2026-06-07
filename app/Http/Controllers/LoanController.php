<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Loan::with(['member', 'book.category'])->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after:loan_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $book = Book::find($request->book_id);
        if ($book->stock < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Stok buku habis, tidak bisa dipinjam',
            ], 400);
        }

        $loan = Loan::create([
            'member_id' => $request->member_id,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date,
            'status' => 'borrowed',
        ]);

        $book->decrement('stock');

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil dicatat',
            'data' => $loan->load(['member', 'book']),
        ], 201);
    }

    public function show($id)
    {
        $loan = Loan::with(['member', 'book.category'])->find($id);
        if (! $loan) {
            return response()->json(['success' => false, 'message' => 'Data peminjaman tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $loan]);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);
        if (! $loan) {
            return response()->json(['success' => false, 'message' => 'Data peminjaman tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'return_date' => 'sometimes|date',
            'status' => 'sometimes|in:borrowed,returned,overdue',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Jika dikembalikan, tambah stok buku
        if ($request->status === 'returned' && $loan->status !== 'returned') {
            $loan->book->increment('stock');
        }

        $loan->update($request->only('return_date', 'status'));

        return response()->json([
            'success' => true,
            'message' => 'Status peminjaman diperbarui',
            'data' => $loan->load(['member', 'book']),
        ]);
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);
        if (! $loan) {
            return response()->json(['success' => false, 'message' => 'Data peminjaman tidak ditemukan'], 404);
        }
        $loan->delete();

        return response()->json(['success' => true, 'message' => 'Data peminjaman dihapus']);
    }

    public function overdue()
    {
        $loans = Loan::with(['member', 'book'])
            ->where('status', 'overdue')
            ->get();

        return response()->json([
            'success' => true,
            'total' => $loans->count(),
            'data' => $loans,
        ]);
    }

    public function aktif()
    {
        $loans = Loan::with(['member', 'book'])
            ->where('status', 'borrowed')
            ->get();

        return response()->json([
            'success' => true,
            'total' => $loans->count(),
            'data' => $loans,
        ]);
    }
}
