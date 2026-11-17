<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'farm_latitude',
    'farm_longitude',
    'receive_disease_alerts',
    'show_farm_on_map',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'farm_latitude' => 'decimal:7',
            'farm_longitude' => 'decimal:7',
            'receive_disease_alerts' => 'boolean',
            'show_farm_on_map' => 'boolean',
        ];
    }

    public function diseaseReports(): HasMany
    {
        return $this->hasMany(DiseaseReport::class);
    }
}
