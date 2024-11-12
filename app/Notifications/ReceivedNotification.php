<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReceivedNotification extends Notification
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
        return [
            'pengaju_id' => $this->pengaju->id,
            'user_id' => $this->pengaju->user_id,
            'nama_pengaju' => $this->pengaju->nama_pengaju,
            'received_at' => $this->pengaju->received_at,
            'messages' => $this->message. ' Sudah Menerima Dana',
            'url' => route('bendahara.laporan', $this->pengaju->id)
        ];
    }
}