<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePendudukRequest extends FormRequest
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
            'name' => 'required',
            'nik' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
            'id_provinsi' => 'required',
            'id_kabupaten' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'birth_date.required' => 'Tanggal Lahir tidak boleh kosong',
            'gender.required' => 'Jenis Kelamin tidak boleh kosong',
            'id_provinsi.required' => 'Provinsi tidak boleh kosong',
            'id_kabupaten.required' => 'Kabupaten tidak boleh kosong',
        ];
    }
}
