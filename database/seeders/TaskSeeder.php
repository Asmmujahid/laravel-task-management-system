<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run()
    {
        Task::create([
            'title' => 'Fix Login Bug',
            'description' => 'Users cannot login under certain conditions.',
            'assigned_to' => 3, // Team Member id
            'created_by' => 1, // Admin id
            'category_id' => 1, // Bug
            'status' => 'pending',
            'due_date' => Carbon::now()->addDays(3),
        ]);

        Task::create([
            'title' => 'Add Dark Mode',
            'description' => 'Implement dark mode for the dashboard.',
            'assigned_to' => 3,
            'created_by' => 2, // Team Lead
            'category_id' => 2, // Feature
            'status' => 'in_progress',
            'due_date' => Carbon::now()->addDays(7),
        ]);

        // Optional: generate 5 random tasks
        Task::factory(5)->create();
    }
}
