<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'first_name' => 'Nadir',
            'last_name' => 'Bakri',
            'email' => 'nadirbakri@test.com',
            'password' => bcrypt('123321'),
        ]);
    }
}
