<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCornScanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'publish_location_consent' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'Silakan unggah foto tanaman terlebih dahulu.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format foto harus JPG, PNG, atau WEBP.',
            'image.max' => 'Ukuran foto maksimal 10 MB.',
            'latitude.required' => 'Pilih lokasi tanaman pada peta atau gunakan lokasi perangkat.',
            'latitude.numeric' => 'Koordinat latitude harus berupa angka.',
            'latitude.between' => 'Koordinat latitude harus berada antara -90 dan 90.',
            'longitude.required' => 'Pilih lokasi tanaman pada peta atau gunakan lokasi perangkat.',
            'longitude.numeric' => 'Koordinat longitude harus berupa angka.',
            'longitude.between' => 'Koordinat longitude harus berada antara -180 dan 180.',
            'publish_location_consent.accepted' => 'Persetujuan untuk menampilkan titik laporan pada peta wajib diberikan.',
        ];
    }
}
