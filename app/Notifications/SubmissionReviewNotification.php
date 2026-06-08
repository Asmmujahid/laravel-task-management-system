<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SubmissionReviewNotification extends Notification
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

            'title' => 'Task Review Update',

            'task' =>
                $this->submission->task->title ?? '-',

            'review' =>
                $this->submission->review,

            'status' =>
                $this->submission->status,

            'message' =>
                'Review added on task "' .
                ($this->submission->task->title ?? '-') .
                '"',

        ];
    }
}