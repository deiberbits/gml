<?php

namespace App\Listeners;

use App\Notifications\AdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdminListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Get AdminNotification class
        $notification = new AdminNotification();
        // Send notification to admin
        $eu =$event->user;
        $eu->email = env('MAIL_ADMIN_ADDRESS');
        $eu->notify($notification);
    }
}
