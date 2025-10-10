<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputFamilyMemberRequest extends FormRequest
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
    public function rules()
    {
        return [
            'household_id'    => 'required',
            'full_name'       => 'nullable|string|max:255',
            'nik'             => 'nullable|digits:16|',
            'address'         => 'nullable|string',
            'stay'            => 'nullable|integer|min:0',
            'gender'          => 'nullable|in:male,female',
            'birth_place'     => 'nullable|string|max:100',
            'birth_date'      => 'nullable|date|before:today',
            'nationality'     => 'nullable|in:wni,wna',
            'tribes'          => 'nullable|string|max:100',
            'religion'        => 'nullable|in:islam,kristen,katolik,hindu,budha,konghucu,lainnya',
            'used_language'   => 'nullable|string|max:100',
            'family_status'   => 'nullable|string|max:20',
            'marital_status'  => 'nullable|in:married,single',
            'works.activity' => 'nullable|string',
            'works.job' => 'nullable|string',
            'works.job_status' => 'nullable|string',
            'educations.education' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'household_id.required' => 'Household wajib diisi.',
            'household_id.exists'   => 'Household tidak ditemukan.',
            
            'nik.digits'            => 'NIK harus 16 digit angka.',
            'nik.unique'            => 'NIK sudah terdaftar.',
            
            'stay.integer'          => 'Lama tinggal harus berupa angka.',
            'stay.min'              => 'Lama tinggal minimal 0.',
            
            'gender.in'             => 'Jenis kelamin harus male atau female.',
            'birth_date.date'       => 'Tanggal lahir tidak valid.',
            'birth_date.before'     => 'Tanggal lahir harus sebelum hari ini.',
            
            'nationality.in'        => 'Kewarganegaraan harus WNI atau WNA.',
            'religion.in'           => 'Agama tidak valid.',
            'marital_status.in'     => 'Status pernikahan tidak valid.',
        ];
    }

}
