<?php

namespace App\DTO\Contact;

use App\DTO\Page\ContactFormDto;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    protected ContactFormDto $contactFormDto;
    protected $message;

    public function __construct(ContactFormDto $contactFormDto)
    {
        $this->contactFormDto = $contactFormDto;
        $this->message = $contactFormDto->getMessage();
    }

    public function build(): ContactFormMail
    {
        return $this->markdown('emails.contact.form')
                    ->subject($this->contactFormDto->getSubject())
                    ->with([
                        'name' => $this->contactFormDto->getName(),
                        'phone' => $this->contactFormDto->getPhone(),
                        'from' => $this->contactFormDto->getEmail(),
                        //'subject' => $this->contactFormDto->getSubject(),
                        //'message' => $this->contactFormDto->getMessage(),
                        'messages' => $this->message
                    ]);
    }
}
