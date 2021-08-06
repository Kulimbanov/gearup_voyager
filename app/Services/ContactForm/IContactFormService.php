<?php

namespace App\Services\ContactForm;

use App\DTO\Page\ContactFormDto;

interface IContactFormService
{
    public function storeContactForm(ContactFormDto $contactFormDto): ContactFormDto;
}
