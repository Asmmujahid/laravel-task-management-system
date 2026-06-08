<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run()
    {
        Team::create([
            'name' => 'Development Team',
            'lead_id' => 2, // Assuming Team Lead created above has id 2
        ]);

        Team::create([
            'name' => 'Design Team',
            'lead_id' => null,
        ]);
    }
}
