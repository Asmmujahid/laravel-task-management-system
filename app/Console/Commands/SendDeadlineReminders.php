<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Notifications\DeadlineReminder;

class SendDeadlineReminders extends Command
{
    protected $signature = 'deadline:reminder';

    protected $description = 'Send task deadline reminders';

    public function handle()
    {
        $today = now()->toDateString();

        $tasks = Task::with([
            'assignedUser',
            'team.lead'
        ])
        ->whereDate('due_date', $today)
        ->get();

        if ($tasks->count() == 0) {

            $this->info('No task found for today.');

            return;
        }

        foreach ($tasks as $task) {

            /*
            |--------------------------------------------------------------------------
            | TEAM MEMBER NOTIFICATION
            |--------------------------------------------------------------------------
            */

            if ($task->assignedUser) {

                $task->assignedUser->notify(
                    new DeadlineReminder($task)
                );

                $this->info(
                    'Notification sent to Team Member: '
                    . $task->assignedUser->name
                );
            }

            /*
            |--------------------------------------------------------------------------
            | TEAM LEAD NOTIFICATION
            |--------------------------------------------------------------------------
            */

            if ($task->team && $task->team->lead) {

                $task->team->lead->notify(
                    new DeadlineReminder($task)
                );

                $this->info(
                    'Notification sent to Team Lead: '
                    . $task->team->lead->name
                );
            }
        }

        $this->info('Deadline reminders sent successfully.');
    }
}