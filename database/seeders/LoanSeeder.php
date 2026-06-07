<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;
use App\Models\Book;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        $loans = [
            // Dipinjam (borrowed)
            [
                'member_id'   => 1,
                'book_id'     => 1,
                'loan_date'   => '2026-05-01',
                'due_date'    => '2026-05-15',
                'return_date' => null,
                'status'      => 'borrowed',
            ],
            [
                'member_id'   => 2,
                'book_id'     => 3,
                'loan_date'   => '2026-05-10',
                'due_date'    => '2026-05-24',
                'return_date' => null,
                'status'      => 'borrowed',
            ],
            [
                'member_id'   => 3,
                'book_id'     => 5,
                'loan_date'   => '2026-05-20',
                'due_date'    => '2026-06-03',
                'return_date' => null,
                'status'      => 'borrowed',
            ],
            // Sudah dikembalikan (returned)
            [
                'member_id'   => 1,
                'book_id'     => 4,
                'loan_date'   => '2026-04-01',
                'due_date'    => '2026-04-15',
                'return_date' => '2026-04-13',
                'status'      => 'returned',
            ],
            [
                'member_id'   => 4,
                'book_id'     => 2,
                'loan_date'   => '2026-04-10',
                'due_date'    => '2026-04-24',
                'return_date' => '2026-04-22',
                'status'      => 'returned',
            ],
            // Overdue
            [
                'member_id'   => 5,
                'book_id'     => 6,
                'loan_date'   => '2026-04-01',
                'due_date'    => '2026-04-15',
                'return_date' => null,
                'status'      => 'overdue',
            ],
        ];

        foreach ($loans as $loan) {
            // Kurangi stok buku yang masih dipinjam / overdue
            if (in_array($loan['status'], ['borrowed', 'overdue'])) {
                Book::find($loan['book_id'])->decrement('stock');
            }

            Loan::create(array_merge($loan, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}