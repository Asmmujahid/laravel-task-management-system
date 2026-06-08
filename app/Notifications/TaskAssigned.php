<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskAssigned extends Notification
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

            'message' => auth()->user()->name .
                ' assigned you a task: ' .
                $this->task->title,

            'status' => $this->task->status,
        ];
    }
}