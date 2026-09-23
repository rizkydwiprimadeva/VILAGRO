<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:100',
            'phone'        => 'required|string|max:20',
            'location'     => 'required|string|max:150',
            'variety'      => 'nullable|string|max:100',
            'disease_type' => 'required|in:bulai,busuk-batang,karat-daun,ulat-grayak,belum-tahu',
            'notes'        => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'Nama wajib diisi.',
            'phone.required'        => 'Nomor WhatsApp wajib diisi.',
            'location.required'     => 'Lokasi kebun wajib diisi.',
            'disease_type.required' => 'Jenis penyakit wajib dipilih.',
            'disease_type.in'       => 'Jenis penyakit tidak valid.',
        ];
    }
}