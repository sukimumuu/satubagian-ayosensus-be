<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputFamilyRequest extends FormRequest
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
            'user_id' => 'nullable',
            'no_kk' => 'nullable',
            'address' => 'nullable',
            'rw' => 'nullable',
            'rt' => 'nullable',
            'kode_desa' => 'nullable',
            'zipcode' => 'nullable',
            'housings.ownership_status' => 'nullable',
            'housings.electricity' => 'nullable',
            'housings.water' => 'nullable',
            'housings.toilet' => 'nullable',
            'housings.floor' => 'nullable',
        ];
    }
}
