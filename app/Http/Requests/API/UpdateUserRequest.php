<?php

namespace App\Http\Requests\API;

use App\Http\Requests\API\JsonFormRequest;

class UpdateUserRequest extends JsonFormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => "required",
            // 'email' => "required|email|unique:users,email,{$this->id}",
            'type' => "required",
            'password' =>  "nullable|between:8,255|confirmed"
        ];
    }
}
