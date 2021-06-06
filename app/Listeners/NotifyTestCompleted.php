<?php

namespace App\Listeners;

use App\Events\TestCompleted;
use App\Mail\TestResultEmail;
use App\Notifications\TestCompletedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NotifyTestCompleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TestCompleted  $event
     * @return void
     */
    public function handle(TestCompleted $event)
    {
        // Mail::to($event->userTest->user)->send(new TestResultEmail($event->userTest));
        // $event->userTest->user->notify(new TestCompletedNotification($event->userTest));
        Notification::send($event->userTest->user, new TestCompletedNotification($event->userTest));
    }
}
