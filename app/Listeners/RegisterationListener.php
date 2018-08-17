<?php

namespace App\Listeners;

use App\Notifications\AccountVerificationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterationListener
{
    /**
     * Handle the event.
     *
     * @param  Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;

        $user->notify(new AccountVerificationNotification($user));
    }
}
