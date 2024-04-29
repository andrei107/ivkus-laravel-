<?php

namespace App\Listeners;

use App\Events\CreateReceiptEvent;
use SendEmail;

class CreateUserListening
{
    public function __construct()
    {
        //
    }

    public function handle(CreateReceiptEvent $event)
    {
		    Mail::to('admin-ivkus@yandex.ru')->send(new SendEmail($event->name));
    }

}
