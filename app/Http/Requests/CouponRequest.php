<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:80', 'unique:coupons,code'],
            'type' => ['required', 'string', 'max:255', 'in:fixed,percentage'],
            'value'=>'required|integer',
            'quantity' => 'required|integer',
            'expiration_date' => 'required|date',
        ];
    }
}
