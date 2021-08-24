<?php

namespace App\Http\Requests;

use App\DTO\Page\ContactFormDto;
use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => [
                'required',
                'regex:/^((00)?\+?[389]{3})?[\/\-\s*\.]?(((\(0\))|0)?\s*7\d{1})[\/\-\s*\.\,]?([\d]{3})[\/\-\s*\.\,]?([\d]{3})$/'
            ],
            'subject' => 'required',
            'message' => 'required'
        ];
    }

    public function getContactDto(): ContactFormDto
    {
        return (new ContactFormDto)
            ->setName($this->get('name'))
            ->setPhone($this->get('phone'))
            ->setEmail($this->get('email'))
            ->setSubject($this->get('subject'))
            ->setMessage($this->get('message'));
    }
}
