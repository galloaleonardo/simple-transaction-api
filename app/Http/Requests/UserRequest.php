<?php

namespace App\Http\Requests;

use App\Rules\DocumentValid;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('user') ?? 0;

        return [
            'full_name' => 'bail|required|string',
            'user_type' => 'bail|required|in:person,company',
            'document'  => [
                'bail',
                'required',
                'integer',
                'unique:users,document,'. $id,
                new DocumentValid($this->request->get('user_type'))
            ],
            'email' => [
                'bail',
                'required',
                'email:rfc,dns',
                'unique:users,email,' . $id
            ],
            'password'  => ['bail', 'required', Password::min(8)]
        ];
    }
}
