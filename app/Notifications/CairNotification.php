<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CairNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    private $pengaju;
    private $message;
    public function __construct($pengaju, $message)
    {
        $this->pengaju = $pengaju;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
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
        // Tentukan URL sesuai kondisi
        $url = match ($notifiable->role) {
            2 => route('pengaju.status', ['id' => $this->pengaju->id]), 
            3 => route('approval.laporan', ['id' => $this->pengaju->id]), 
        };

        return [
            'pengaju_id' => $this->pengaju->id,
            'user_id' => $this->pengaju->user_id,
            'id_statusdana' => $this->pengaju->id_statusdana,
            'messages' => 'Dana Sudah Dicairkan Oleh '. $this->message,
            'url' => $url
        ];
    }
}
