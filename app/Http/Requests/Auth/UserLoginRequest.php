<?php

namespace App\Http\Requests\Auth;

use App\DTO\Auth\UserDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserRegisterRequest
 * @package App\Http\Requests\Auth
 *
 * @property string email
 * @property string password
 */
class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function getUserDto(): UserDto
    {
        return (new UserDto)
            ->setEmail($this->email)
            ->setPassword($this->password);
    }
}
