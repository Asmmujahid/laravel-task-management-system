<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TaskUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected $oldStatus;
    protected $newStatus;

    public function __construct($task, $oldStatus, $newStatus)
    {
        $this->task = $task;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Task Status Updated: ' . $this->task->title)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('The task "' . $this->task->title . '" has been updated.')
            ->line('Status changed from **' . ucfirst($this->oldStatus) . '** to **' . ucfirst($this->newStatus) . '**.')
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Thank you for keeping your tasks up to date!');
    }

    public function toArray($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'message' => 'Task status changed from ' . $this->oldStatus . ' to ' . $this->newStatus,
        ];
    }
}
