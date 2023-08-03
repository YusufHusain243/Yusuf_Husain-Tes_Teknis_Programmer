<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKabupatenRequest extends FormRequest
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
            'id_provinsi' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Kabupaten tidak boleh kosong',
            'id_provinsi.required' => 'Provinsi Harus Dipilih',
        ];
    }
}
