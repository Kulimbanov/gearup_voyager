<?php

namespace App\Services\Mail;

use Illuminate\Mail\Mailable;

interface ISendService
{
    public function send(string $type, Mailable $mailable);
}
