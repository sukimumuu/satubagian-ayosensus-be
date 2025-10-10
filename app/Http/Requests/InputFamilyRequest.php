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
            'no_kk' => 'required',
            'address' => 'required',
            'rw' => 'required',
            'rt' => 'required',
            'kode_desa' => 'nullable',
            'zipcode' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'no_kk.required' => 'No KK harus diisi.',
            'address.required' => 'Alamat harus diisi.',
            'rw.required' => 'RW harus diisi.',
            'rt.required' => 'RT harus diisi.',
            'kode_desa.required' => 'Desa harus diisi.',
            'zip_code.required' => 'Kode Pos harus diisi.',
        ];
    }
}
