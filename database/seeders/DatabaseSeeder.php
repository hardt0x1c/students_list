<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Abiturent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         Abiturent::factory(150)->create();
    }
}
