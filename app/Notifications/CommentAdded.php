<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CommentAdded extends Notification
{
    use Queueable;

    protected $task;
    protected $comment;
    protected $user;

    public function __construct($task, $comment, $user)
    {
        $this->task = $task;
        $this->comment = $comment;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [

            'task_id' => $this->task->id,

            'title' => 'Task Submission',

            'message' =>
                $this->user->name .
                ' submitted task "' .
                $this->task->title . '"',

            'comment' => $this->comment->comment,
        ];
    }
}