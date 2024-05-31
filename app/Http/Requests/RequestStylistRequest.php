<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStylistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'saloon_name'=>['required','string','max:80'],
            'saloon_city'=>['required','max:255'],
            'saloon_address'=>['required','max:255'],
            'saloon_phone'=>['required','max:255'],
            //'user_id' => 'required|exists:users,id',
        ];
    }
}
