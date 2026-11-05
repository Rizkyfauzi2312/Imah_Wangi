<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Imah Wangi',
            'email' => 'admin@Imah_Wangi.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);
    }
}
