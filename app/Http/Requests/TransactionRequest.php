<?php

namespace App\Http\Requests;

use App\Rules\HasBalance;
use App\Rules\IsPerson;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payer_id' => [
                'bail',
                'required',
                'integer',
                'exists:users,id',
                new IsPerson()
            ],
            'payee_id' => [
                'bail',
                'required',
                'integer',
                'exists:users,id',
                'not_in:'.$this->request->get('payer_id')
            ],
            'value'    => [
                'bail',
                'required',
                'min:0.1',
                new HasBalance($this->request->get('payer_id'))
            ]
        ];
    }
}
