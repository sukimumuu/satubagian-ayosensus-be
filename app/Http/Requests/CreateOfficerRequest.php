<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfficerRequest extends FormRequest
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
            'data' => 'required|array',
            'data.*.name' => 'required|unique:users,name',
            'data.*.password' => 'required|min:6',
            'data.*.kode_desa' => 'required|exists:villages,kode',
        ];
    }

    public function messages()
    {
        return [
            'data.*.name.required' => 'Nama tidak boleh kosong',
            'data.*.name.unique' => 'Nama pengguna sudah terdaftar',
            'data.*.password.required' => 'Password tidak boleh kosong',
            'data.*.password.min' => 'Password minimal 6 karakter',
            'data.*.kode_desa.required' => 'Desa tidak boleh kosong',
            'data.*.kode_desa.exists' => 'Desa tidak ditemukan',
        ];
    }
}
