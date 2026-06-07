<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Fiksi',
                'description' => 'Buku-buku fiksi, novel, dan cerita rekaan',
            ],
            [
                'name'        => 'Non-Fiksi',
                'description' => 'Buku berdasarkan fakta, biografi, dan sejarah',
            ],
            [
                'name'        => 'Sains & Teknologi',
                'description' => 'Buku ilmu pengetahuan alam dan teknologi',
            ],
            [
                'name'        => 'Pendidikan',
                'description' => 'Buku pelajaran dan referensi akademik',
            ],
            [
                'name'        => 'Agama & Filsafat',
                'description' => 'Buku keagamaan, spiritual, dan filsafat',
            ],
        ];

        foreach ($categories as $category) {
            Category::create(array_merge($category, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}