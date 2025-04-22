<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Translation::factory()->count(100000)->create();
    }
}
