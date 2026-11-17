<?php

namespace App\Services;

use App\Models\DiseaseReport;
use App\Models\User;
use App\Notifications\NearbyDiseaseAlert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Notification;

class NotifyNearbyFarmers
{
    public function notify(DiseaseReport $report): int
    {
        if ($report->status !== 'infected' || $report->latitude === null || $report->longitude === null) {
            return 0;
        }

        $latitude = (float) $report->latitude;
        $longitude = (float) $report->longitude;
        $radiusKilometers = (float) config('services.farm_alert_radius_km', 5);
        $latitudeRange = $radiusKilometers / 111.045;
        $longitudeRange = min(
            180,
            $radiusKilometers / (111.045 * max(abs(cos(deg2rad($latitude))), 0.000001)),
        );
        $minimumLongitude = $longitude - $longitudeRange;
        $maximumLongitude = $longitude + $longitudeRange;

        $candidates = User::query()
            ->select(['id', 'farm_latitude', 'farm_longitude'])
            ->where('receive_disease_alerts', true)
            ->whereNotNull('farm_latitude')
            ->whereNotNull('farm_longitude')
            ->where('id', '!=', $report->user_id)
            ->whereBetween('farm_latitude', [
                max(-90, $latitude - $latitudeRange),
                min(90, $latitude + $latitudeRange),
            ])
            ->where(function (Builder $query) use ($minimumLongitude, $maximumLongitude): void {
                if ($minimumLongitude < -180) {
                    $query->where('farm_longitude', '>=', 360 + $minimumLongitude)
                        ->orWhere('farm_longitude', '<=', $maximumLongitude);
                } elseif ($maximumLongitude > 180) {
                    $query->where('farm_longitude', '>=', $minimumLongitude)
                        ->orWhere('farm_longitude', '<=', $maximumLongitude - 360);
                } else {
                    $query->whereBetween('farm_longitude', [$minimumLongitude, $maximumLongitude]);
                }
            })
            ->get()
            ->filter(fn (User $farmer): bool => $this->distanceInKilometers(
                $latitude,
                $longitude,
                (float) $farmer->farm_latitude,
                (float) $farmer->farm_longitude,
            ) <= $radiusKilometers)
            ->values();

        if ($candidates->isNotEmpty()) {
            Notification::send($candidates, new NearbyDiseaseAlert($report));
        }

        return $candidates->count();
    }

    private function distanceInKilometers(float $latitude, float $longitude, float $otherLatitude, float $otherLongitude): float
    {
        $latitudeDifference = deg2rad($otherLatitude - $latitude);
        $longitudeDifference = deg2rad($otherLongitude - $longitude);
        $haversine = sin($latitudeDifference / 2) ** 2
            + cos(deg2rad($latitude)) * cos(deg2rad($otherLatitude)) * sin($longitudeDifference / 2) ** 2;

        return 6371 * 2 * asin(min(1, sqrt($haversine)));
    }
}
