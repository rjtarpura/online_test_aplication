<?php

namespace App\Notifications;

use App\Mail\TestResultEmail;
use App\UserTest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TestCompletedNotification extends Notification
{
    use Queueable;

    /**
     * @var \App\UserTest  $userTest
     */
    public $userTest;

    /**
     * Create a new notification instance.
     *
     * @param \App\UserTest  $userTest
     * @return void
     */
    public function __construct(UserTest $userTest)
    {
        $this->userTest = $userTest;
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
    public function toMail($notifiable)
    {
        return (new TestResultEmail($this->userTest))->to($notifiable);
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
