<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminSubmissionStatusNotification extends Notification
{
    use Queueable;

    protected $submission;

    public function __construct($submission)
    {
        $this->submission = $submission;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [

            'submission_id' => $this->submission->id,

            'title' => 'Submission Status Updated',

            'status' => $this->submission->status,

            'task' =>
                $this->submission->task->title ?? '-',

            'member' =>
                $this->submission->user->name ?? '-',

            'comment' =>
                $this->submission->comment,

            'review' =>
                $this->submission->review,

            'message' =>
                'Admin updated task "' .
                ($this->submission->task->title ?? '-') .
                '" status to "' .
                ucfirst($this->submission->status) .
                '"',

        ];
    }
}