<?php

namespace App\Listeners;

use Carbon\Carbon;

class StoreLastLoginDateListener
{
    public function handle($event)
    {
       $event->user->last_logged_at = Carbon::now ();
       $event->user->save();
    }
}
