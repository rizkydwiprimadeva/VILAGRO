<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'user_id',
    'disease_class',
    'disease_name',
    'status',
    'confidence',
    'image_path',
    'latitude',
    'longitude',
    'location_consent_at',
])]
class DiseaseReport extends Model
{
    protected function casts(): array
    {
        return [
            'confidence' => 'decimal:2',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'location_consent_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
