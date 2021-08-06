<?php

namespace App\Services\ContactForm;

use App\DTO\Page\ContactFormDto;
use App\Repository\ContactRepository;

class ContactFormService implements IContactFormService
{
    const THANK_YOU = "We have received your message and would like to thank you for writing to us.";
    const OOPS = "Ooops... We are sorry something went wrong. Try again later";

    private ContactRepository $contactRepository;

    public function __construct()
    {
        $this->contactRepository = resolve(ContactRepository::class);
    }

    public function storeContactForm(ContactFormDto $contactFormDto): ContactFormDto
    {
        $model = $this->contactRepository->create($contactFormDto);
        $contactFormDto->setResponse(empty($model) ? setting('site.contact_form_ops') : setting('site.contact_form_thank_you'));

        return $contactFormDto;
    }
}
