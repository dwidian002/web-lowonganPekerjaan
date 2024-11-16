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
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('locations')->insert([
            'name' => 'DI Yogyakarta'
        ]);

        DB::table('job_categories')->insert([
            'name' => 'Work From Home'
        ]);

        DB::table('fields_of_work')->insert([
            'name' => 'Sales'
        ]);

        DB::table('type_company')->insert([
            'name' => 'Swasta'
        ]);

        DB::table('industry')->insert([
            'name' => 'Education & Training'
        ]);

        

        $this->call(EmailTemplateSeeder::class);
        
    }
}
