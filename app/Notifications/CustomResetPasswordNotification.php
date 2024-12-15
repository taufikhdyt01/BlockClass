<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        
        $url = 'https://e-block.vercel.app/reset-password?token=' . $this->token . '&email=' . $notifiable->getEmailForPasswordReset();

        $expire = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');

        return (new MailMessage)
            ->subject('Reset Password e-Block')
            ->from(config('mail.from.address'), 'e-Block')
            ->greeting('Halo!')
            ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.')
            ->action('Reset Password', $url)
            ->line("Link reset password ini akan kadaluarsa dalam {$expire} menit.")
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.')
            ->salutation('Salam, e-Block Team');
    }
}