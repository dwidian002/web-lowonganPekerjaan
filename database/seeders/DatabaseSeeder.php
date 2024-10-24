<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            // 'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('asdasd'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            // 'name' => 'Test User',
            'email' => 'widyahia2004@gmail.com',
            'password' => Hash::make('asdasd'),
            'role' => 'applicant',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            // 'name' => 'Test User',
            'email' => 'dwi.dian.s@mail.ukrim.ac.id',
            'password' => Hash::make('asdasd'),
            'role' => 'company',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
