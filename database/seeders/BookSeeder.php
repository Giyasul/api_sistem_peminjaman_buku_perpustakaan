<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            // Fiksi (category_id: 1)
            [
                'title'          => 'Laskar Pelangi',
                'author'         => 'Andrea Hirata',
                'isbn'           => '978-979-1037-72-7',
                'stock'          => 5,
                'category_id'    => 1,
                'published_year' => 2005,
            ],
            [
                'title'          => 'Bumi Manusia',
                'author'         => 'Pramoedya Ananta Toer',
                'isbn'           => '978-979-407-391-1',
                'stock'          => 3,
                'category_id'    => 1,
                'published_year' => 1980,
            ],
            [
                'title'          => 'Perahu Kertas',
                'author'         => 'Dee Lestari',
                'isbn'           => '978-979-780-430-6',
                'stock'          => 4,
                'category_id'    => 1,
                'published_year' => 2009,
            ],
            // Non-Fiksi (category_id: 2)
            [
                'title'          => 'Sapiens: Riwayat Singkat Umat Manusia',
                'author'         => 'Yuval Noah Harari',
                'isbn'           => '978-602-424-694-5',
                'stock'          => 3,
                'category_id'    => 2,
                'published_year' => 2014,
            ],
            [
                'title'          => 'Atomic Habits',
                'author'         => 'James Clear',
                'isbn'           => '978-602-06-3367-5',
                'stock'          => 6,
                'category_id'    => 2,
                'published_year' => 2018,
            ],
            // Sains & Teknologi (category_id: 3)
            [
                'title'          => 'Clean Code',
                'author'         => 'Robert C. Martin',
                'isbn'           => '978-0-13-235088-4',
                'stock'          => 2,
                'category_id'    => 3,
                'published_year' => 2008,
            ],
            [
                'title'          => 'The Pragmatic Programmer',
                'author'         => 'David Thomas & Andrew Hunt',
                'isbn'           => '978-0-13-595705-9',
                'stock'          => 3,
                'category_id'    => 3,
                'published_year' => 1999,
            ],
            // Pendidikan (category_id: 4)
            [
                'title'          => 'Pemrograman Web dengan Laravel',
                'author'         => 'Didik Setiawan',
                'isbn'           => '978-623-254-123-4',
                'stock'          => 8,
                'category_id'    => 4,
                'published_year' => 2021,
            ],
            [
                'title'          => 'Basis Data untuk Pemula',
                'author'         => 'Ir. Fathansyah',
                'isbn'           => '978-602-289-456-7',
                'stock'          => 5,
                'category_id'    => 4,
                'published_year' => 2015,
            ],
            // Agama & Filsafat (category_id: 5)
            [
                'title'          => 'La Tahzan',
                'author'         => 'Dr. Aidh Al-Qarni',
                'isbn'           => '978-979-592-150-1',
                'stock'          => 7,
                'category_id'    => 5,
                'published_year' => 2004,
            ],
        ];

        foreach ($books as $book) {
            Book::create(array_merge($book, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}