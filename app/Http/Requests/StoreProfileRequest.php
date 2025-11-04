<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone'=>'required|string|max:25',
            'address'=>'nullable|string',
            'date_of_birth'=>'nullable|date',
            'bio'=>'nullable|string',
          'image' => 'required|mimes:png,jpg,jpeg,gif|max:2048',
        ];
    }
}
