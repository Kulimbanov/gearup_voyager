<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'slug' => 'nullable',
            'child' => 'nullable|required_with:slug',
        ];
    }

    public function getSlug(): ?string
    {
        return $this->slug . '/' . $this->child;
    }
}
