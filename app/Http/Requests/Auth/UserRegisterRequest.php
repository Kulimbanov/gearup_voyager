<?php

namespace App\Http\Requests\Auth;

use App\DTO\Auth\UserDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRegisterRequest
 * @package App\Http\Requests\Auth
 *
 * @property string name
 * @property string email
 * @property string password
 */
class UserRegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|unique:users|email',
            'password' => 'required|string',
        ];
    }

    public function getUserDto(): UserDto
    {
        return (new UserDto)
            ->setName($this->name)
            ->setEmail($this->email)
            ->setPassword(Hash::make($this->password));
    }
}
