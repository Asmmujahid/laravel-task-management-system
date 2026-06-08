<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DeadlineReminder extends Notification
{
    use Queueable;

    protected $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [

            'title' => 'Deadline Reminder',

            'task' => $this->task->title,

            'message' =>
                'Task "' .
                $this->task->title .
                '" deadline is today.',

            'status' => 'deadline_reminder',

        ];
    }
}