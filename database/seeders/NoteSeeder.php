<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Note;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notes')->insert([
            'id' => 1,
            'user_id' => 1,
            'title' => 'SEEDER IN LARAVEL',
            'content' => ' -> $ php artisan make:seeder TestSeeder',
        ]);

        //factories
        Note::factory(2)->create();
    }
}
