<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindLobbyRequest extends FormRequest
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
            'sex' => 'required|string',
            'nickname' => 'required|string',
            'categoriesIds' => 'required|array|min:1',
        ];
    }
}
