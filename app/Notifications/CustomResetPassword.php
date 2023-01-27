<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{
    use Queueable;

    public $token;
    protected $title = 'パスワードリセット 通知';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
     public function __construct($token)
      {
          $this->token = $token;
      }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
     // public function toMail($notifiable)
     //    {
     //        return (new MailMessage)
     //            ->subject('パスワード再設定')
     //           ->line('下のボタンをクリックしてパスワードを再設定してください。')
     //           ->action('パスワード再設定', url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
     //           ->line('もし心当たりがない場合は、本メッセージは破棄してください。');
     //    }

        public function toMail($notifiable)
        {
            return (new MailMessage)
              ->subject($this->title)
              ->view(
                'mail.html.passwordreset',
                [
                  'reset_url' => url('password/reset', $this->token),
                ]);
        }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
