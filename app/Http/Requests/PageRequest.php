<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PageRequest
 * @package App\Http\Requests
 *
 * @property string slug
 * @property string child
 */
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
        ];
    }

    public function getSlug(): ?string
    {
        return $this->route('slug') ;
    }
}
