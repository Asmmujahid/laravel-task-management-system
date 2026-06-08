<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TeamLeadSubmissionNotification extends Notification
{
    use Queueable;

    protected $comment;
    protected $teamLead;

    public function __construct($comment, $teamLead)
    {
        $this->comment = $comment;
        $this->teamLead = $teamLead;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [

            'submission_id' => $this->comment->id,

            'title' => 'Task Submission',

            'message' =>
                $this->teamLead->name .
                ' submitted task "' .
                ($this->comment->task->title ?? '-') .
                '" to Admin.',

            'comment' => $this->comment->comment,

            'member' =>
                $this->comment->user->name ?? '-',

            'task' =>
                $this->comment->task->title ?? '-',

            'status' => 'submitted',
        ];
    }
}