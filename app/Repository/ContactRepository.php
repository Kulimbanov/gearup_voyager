<?php

namespace App\Repository;

use App\DTO\Page\ContactFormDto;
use App\Models\Contact;

class ContactRepository
{
    public function create(ContactFormDto $contactFormDto): Contact
    {
        return (new Contact)->create([
            Contact::NAME => $contactFormDto->getName(),
            Contact::EMAIL => $contactFormDto->getEmail(),
            Contact::PHONE => $contactFormDto->getPhone(),
            Contact::SUBJECT => $contactFormDto->getSubject(),
            Contact::MESSAGE => $contactFormDto->getMessage(),
        ]);
    }
}
