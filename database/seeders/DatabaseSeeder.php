<?php

namespace Database\Seeders;

use App\Models\Items;
use App\Models\Price;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Items::factory()->count(10000)->has(Price::factory()->count(100))->create();
    }
}
