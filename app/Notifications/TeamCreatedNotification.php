<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TeamCreatedNotification extends Notification
{
    use Queueable;

    protected $team;

    public function __construct($team)
    {
        $this->team = $team;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [

            'title' => 'Added To Team',

            'message' =>
                'You have been added to team "' .
                $this->team->name .
                '" by Team Lead.',

            'team' => $this->team->name,

            'status' => 'team_created',

        ];
    }
}