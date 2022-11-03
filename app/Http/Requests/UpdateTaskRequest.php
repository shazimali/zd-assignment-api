<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            // 'image_path.size' => 'The image must be 500 kilobytes.',
            'image_path.mimes' => 'The image should in png or jpeg format.',
            'user_id.required' => 'The assigned user is required.',
        ];
    }
}
