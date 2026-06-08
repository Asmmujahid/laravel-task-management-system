<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            TeamSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            TaskSeeder::class,
        ]);
    }
}
