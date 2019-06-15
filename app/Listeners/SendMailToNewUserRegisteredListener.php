<?php

namespace App\Listeners;

use App\Mail\UserRegisteredMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMailToNewUserRegisteredListener
{
    public function handle($event)
    {
       Mail::to ( $event->user->email )->send ( new UserRegisteredMail() );
    }
}
