<?php

namespace App\Services\ContactForm;

use App\DTO\Contact\ContactFormMail;
use App\DTO\Page\ContactFormDto;
use App\ENUM\SendTypes;
use App\Repository\ContactRepository;
use App\Services\Mail\ISendService;

class ContactFormService implements IContactFormService
{
    private ContactRepository $contactRepository;
    private ISendService $sendService;

    public function __construct()
    {
        $this->contactRepository = resolve(ContactRepository::class);
        $this->sendService = resolve(ISendService::class);
    }

    public function storeContactForm(ContactFormDto $contactFormDto): ContactFormDto
    {
        $model = $this->contactRepository->create($contactFormDto);
        if (empty($model)) {
            $contactFormDto->setResponse(setting('site.contact_form_ops'));
        }

        $contactFormDto->setResponse(setting('site.contact_form_thank_you'));
        $this->queueSendForm($contactFormDto);

        return $contactFormDto;
    }

    private function queueSendForm(ContactFormDto $contactFormDto): void
    {
        $contactFormMail = new ContactFormMail($contactFormDto);

        $this->sendService->send(SendTypes::MAIl, $contactFormMail);
    }

}
