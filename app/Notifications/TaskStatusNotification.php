<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class TaskStatusNotification extends Notification
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

            'task_id' => $this->task->id,

            'title' => $this->task->title,

            'status' => $this->task->status,

            'message' =>
                Auth::user()->name .
                ' updated task "' .
                $this->task->title .
                '" status to "' .
                ucfirst(str_replace('_', ' ', $this->task->status)) .
                '"',

        ];
    }
}