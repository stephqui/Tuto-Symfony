<?php

namespace App\Event;

use App\Contact\ContactDTO;

class ContactRequestEvent
{
    public function __construct(public readonly ContactDTO $data)
    {
        
    }
}