<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCornScanRequest;
use App\Models\DiseaseReport;
use App\Services\CornDiseaseDetector;
use App\Services\NotifyNearbyFarmers;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use UnexpectedValueException;

class CornDetectionController extends Controller
{
    public function __construct(
        private CornDiseaseDetector $detector,
        private NotifyNearbyFarmers $nearbyFarmers,
    ) {}

    public function detect(StoreCornScanRequest $request): RedirectResponse
    {
        try {
            $result = $this->detector->detect($request->file('image'));
        } catch (ConnectionException|RequestException $exception) {
            Log::warning('Corn AI service request failed.', [
                'user_id' => $request->user()->id,
                'exception' => $exception->getMessage(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['image' => 'Layanan AI belum dapat dihubungi. Pastikan Python service berjalan di port 5001, lalu coba lagi.']);
        } catch (UnexpectedValueException $exception) {
            Log::error('Corn AI service returned an invalid result.', [
                'user_id' => $request->user()->id,
                'exception' => $exception->getMessage(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['image' => 'Layanan AI mengembalikan hasil yang tidak valid. Coba lagi atau ambil foto baru.']);
        }

        $imagePath = $request->file('image')->store('disease-reports', 'local');

        if ($imagePath === false) {
            Log::error('Corn scan image could not be stored.', ['user_id' => $request->user()->id]);

            return back()
                ->withInput()
                ->withErrors(['image' => 'Foto tidak dapat disimpan. Silakan coba lagi.']);
        }

        [$report, $recipientCount] = DB::transaction(function () use ($request, $result, $imagePath): array {
            $report = $request->user()->diseaseReports()->create([
                'disease_class' => $result['disease_class'],
                'disease_name' => $result['disease_name'],
                'status' => $result['status'],
                'confidence' => $result['confidence'],
                'image_path' => $imagePath,
                'latitude' => $request->validated('latitude'),
                'longitude' => $request->validated('longitude'),
                'location_consent_at' => now(),
            ]);

            $recipientCount = $this->nearbyFarmers->notify($report);

            return [$report, $recipientCount];
        });

        $flashResult = [
            ...$result,
            'report_id' => $report->id,
            'recipient_count' => $recipientCount,
        ];

        if ($result['status'] === 'infected') {
            $message = $recipientCount > 0
                ? "Laporan tersimpan dan peringatan dikirim ke {$recipientCount} petani dalam radius 5 km."
                : 'Laporan tersimpan, tetapi belum ada petani lain dalam radius 5 km yang mengaktifkan notifikasi.';
        } else {
            $message = 'Hasil scan tersimpan. Tidak ada notifikasi penyakit yang dikirim.';
        }

        return redirect()
            ->route('scanner')
            ->with('scan_result', $flashResult)
            ->with('scan_message', $message);
    }
}
