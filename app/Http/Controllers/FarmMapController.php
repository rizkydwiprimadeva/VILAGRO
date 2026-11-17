<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFarmLocationRequest;
use App\Models\DiseaseReport;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FarmMapController extends Controller
{
    public function index(): View
    {
        $reports = DiseaseReport::query()
            ->where('status', 'infected')
            ->where('created_at', '>=', now()->subDays(30))
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->limit(200)
            ->get(['id', 'disease_name', 'confidence', 'latitude', 'longitude', 'created_at']);

        $farms = User::query()
            ->where('show_farm_on_map', true)
            ->whereNotNull('farm_latitude')
            ->whereNotNull('farm_longitude')
            ->get(['id', 'farm_latitude', 'farm_longitude'])
            ->map(fn (User $farmer): array => [
                'latitude' => round((float) $farmer->farm_latitude, 2),
                'longitude' => round((float) $farmer->farm_longitude, 2),
            ]);

        $mapData = [
            'reports' => $reports->map(fn (DiseaseReport $report): array => [
                'name' => $report->disease_name,
                'confidence' => $report->confidence === null ? null : (float) $report->confidence,
                'latitude' => (float) $report->latitude,
                'longitude' => (float) $report->longitude,
                'created_at' => $report->created_at->format('d M Y, H:i'),
            ])->all(),
            'farms' => $farms->values()->all(),
        ];

        return view('pages.map', compact('farms', 'mapData', 'reports'));
    }

    public function updateLocation(UpdateFarmLocationRequest $request): RedirectResponse
    {
        $request->user()->update([
            'farm_latitude' => $request->validated('latitude'),
            'farm_longitude' => $request->validated('longitude'),
            'receive_disease_alerts' => $request->boolean('receive_disease_alerts'),
            'show_farm_on_map' => $request->boolean('show_farm_on_map'),
        ]);

        return redirect()
            ->route('farm-map')
            ->with('farm_location_saved', 'Lokasi kebun dan pengaturan peringatan berhasil disimpan.');
    }
}
