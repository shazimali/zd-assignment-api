<?php

namespace App\Http\Requests\API;

use App\Http\Requests\API\JsonFormRequest;

class StoreTaskRequest extends JsonFormRequest
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
            'title' => 'required',
            'desc' => 'nullable',
            'image_path' => 'nullable|mimes:jpeg,png', //500 KB
            'user_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'image_path.mimes' => 'The image should in png or jpeg format.',
            // 'image_path.size' => 'The image size should be lower than 500 kilo bytes.',
            'user_id.required' => 'The assigned user is required.',
        ];
    }
}
