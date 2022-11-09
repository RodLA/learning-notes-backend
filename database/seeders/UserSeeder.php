<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'id' => 1,
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('123')
        // ]);

        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'id' => 1,
            'name' => 'Admin L',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123')
        ]);
    }
}
