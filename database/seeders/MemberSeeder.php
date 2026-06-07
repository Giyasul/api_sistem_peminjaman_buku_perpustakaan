<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'tio ssantoso',
                'email' => 'Tio@gmail.com',
                'phone' => '081234567890',
                'address' => 'Jl. Mawar No. 10, Mataram',
                'status' => 'active',
            ],
            [
                'name' => 'anshor seblak',
                'email' => 'Anshor@gmail.com',
                'phone' => '082345678901',
                'address' => 'Jl. Melati No. 5, Mataram',
                'status' => 'active',
            ],
            [
                'name' => 'giyasul mantap',
                'email' => 'Giyasul@gmail.com',
                'phone' => '083456789012',
                'address' => 'Jl. Kenanga No. 3, Lombok',
                'status' => 'active',
            ],
            [
                'name' => 'haidir bali',
                'email' => 'Haidir@gmail.com',
                'phone' => '084567890123',
                'address' => 'Jl. Dahlia No. 8, Mataram',
                'status' => 'active',
            ],
            [
                'name' => 'abin jempong',
                'email' => 'Abin@gmail.com',
                'phone' => '085678901234',
                'address' => 'Jl. Anggrek No. 12, Lombok',
                'status' => 'inactive',
            ],
            [
                'name' => 'kiki batu lingsar',
                'email' => 'Kiki@gmail.com',
                'phone' => '085678901234',
                'address' => 'Jl. Anggrek No. 12, Lombok',
                'status' => 'inactive',
            ],
        ];

        foreach ($members as $member) {
            Member::create(array_merge($member, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
