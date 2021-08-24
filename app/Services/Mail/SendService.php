<?php

namespace App\Services\Mail;

use App\ENUM\SendTypes;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class SendService implements ISendService
{
    public function send(string $type, Mailable $mailable)
    {
        switch ($type) {
            case SendTypes::MAIl :
                Mail::to(setting('admin.contact_admin'))->send($mailable);
        }
    }
}
