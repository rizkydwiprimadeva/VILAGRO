<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFarmLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'receive_disease_alerts' => ['nullable', 'boolean'],
            'show_farm_on_map' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'latitude.required' => 'Tentukan titik lokasi kebun pada peta.',
            'longitude.required' => 'Tentukan titik lokasi kebun pada peta.',
        ];
    }
}
