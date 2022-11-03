<?php

namespace App\Http\Requests\API;

use App\Http\Requests\API\JsonFormRequest;


class AuthTokenRequest extends JsonFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required',
        ];
    }
}
