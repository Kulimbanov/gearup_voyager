<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Services\ContactForm\IContactFormService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private IContactFormService $contactFormService;

    public function __construct()
    {
        $this->contactFormService = resolve(IContactFormService::class);
    }

    public function index(Request $request)
    {
        return view('contact');
    }

    public function store(ContactFormRequest $request)
    {
        return response()->json($this->contactFormService->storeContactForm($request->getContactDto()));
    }
}
