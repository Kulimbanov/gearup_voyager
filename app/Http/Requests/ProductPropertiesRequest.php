<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductPropertiesRequest
 * @package App\Http\Requests
 *
 * @property int? product_id
 * @property int? category_id
 */
class ProductPropertiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required_without:category_id',
            'category_id' => 'required_without:product_id',
        ];
    }

    public function getProductId(): ?int
    {
        return $this->get('product_id');
    }

    public function getCategoryId(): ?int
    {
        return $this->get('category_id');
    }
}
