<?php

namespace App\Notifications;

use App\Models\RoleRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RoleRequestProcessed extends Notification
{
    use Queueable;

    private RoleRequest $roleRequest;
    public function __construct(RoleRequest $roleRequest)
    {
        $this->roleRequest = $roleRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'role_request_id' => $this->roleRequest->id,
            'status' => $this->roleRequest->status,
            'message' => "Заявка на роль {$this->roleRequest->requested_role} закрыта"
        ];
    }
}
