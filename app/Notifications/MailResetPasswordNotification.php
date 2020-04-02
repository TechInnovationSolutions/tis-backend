<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailResetPasswordNotification extends Notification
{
    use Queueable;
    public $token, $email;

   public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    


    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
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
    public function toMail( $notifiable ) {
   $link = url( "https://sophiesbathandbody.com/user/forgot-password?token=" . $this->token."&email=".$this->email );

   return ( new MailMessage )
      //->view('reset.emailer')
      //->from('info@example.com')
      ->subject( 'Reset your password' )
      ->greeting('Hello!')
      ->line( "You are receiving this email because we received a password reset request for your account." )
      ->action( 'Reset Password', $link )
      ->line( 'This password reset link will expire in 60 minutes.' )
      ->line( 'If you did not request a password reset, no further action is required.' )
      //->attach('reset.attachment')
      ->line( 'Thank you!' );
      
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
