<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CornDetectionController extends Controller
{
    /**
     * URL Python AI microservice.
     */
    protected string $aiServiceUrl;

    public function __construct()
    {
        $this->aiServiceUrl = config('services.ai.url', 'http://127.0.0.1:5001');
    }

    /**
     * Halaman utama scanner.
     */
    public function index()
    {
        return view('corn-detection.scanner');
    }

    /**
     * Proses deteksi gambar.
     */
    public function detect(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'conf'  => 'nullable|numeric|min:0.05|max:0.95',
        ], [
            'image.required' => 'Silakan unggah gambar terlebih dahulu.',
            'image.image'    => 'File harus berupa gambar.',
            'image.max'      => 'Ukuran gambar maksimal 10MB.',
        ]);

        try {
            $image = $request->file('image');
            $conf  = (float) $request->input('conf', 0.25);

            $response = Http::timeout(120)
                ->attach(
                    'image',
                    file_get_contents($image->getRealPath()),
                    $image->getClientOriginalName()
                )
                ->post("{$this->aiServiceUrl}/predict", [
                    'conf' => $conf,
                ]);

            if (!$response->successful()) {
                Log::error('AI service error', ['body' => $response->body()]);
                return back()->with('error', 'AI service gagal merespons: ' . $response->status());
            }

            $result = $response->json();

            // Enrich dengan info dari config (nama latin, gejala, SOP)
            $result['enriched'] = $this->enrichResult($result['detections'] ?? []);

            return view('corn-detection.scanner', [
                'result' => $result,
            ]);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('AI connection failed: ' . $e->getMessage());
            return back()->with('error', 'Tidak dapat terhubung ke AI service. Pastikan Python service sudah berjalan di port 5001.');
        } catch (\Exception $e) {
            Log::error('Detection error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Enrich hasil deteksi dengan data gejala, latin name, dan SOP treatment.
     */
    protected function enrichResult(array $detections): array
    {
        $diseaseDb = config('corn_diseases');

        if (empty($detections)) {
            return [
                'status'     => 'healthy',
                'disease'    => $diseaseDb['healthy'] ?? [],
                'confidence' => 0,
            ];
        }

        // Ambil deteksi dengan confidence tertinggi
        usort($detections, fn($a, $b) => $b['confidence'] <=> $a['confidence']);
        $top = $detections[0];

        $className = $top['class_name'];
        $info = $diseaseDb[$className] ?? null;

        return [
            'status'     => 'infected',
            'disease'    => $info,
            'confidence' => round($top['confidence'] * 100, 2),
            'class_name' => $className,
            'total'      => count($detections),
            'all'        => $detections,
        ];
    }

    /**
     * Halaman metrik training.
     */
    public function metrics()
    {
        $modelPath = storage_path('app/ai-model');

        // Parse results.csv
        $metrics = [];
        $csvPath = "{$modelPath}/results.csv";
        if (file_exists($csvPath)) {
            $handle = fopen($csvPath, 'r');
            $headers = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== false) {
                if (count($row) === count($headers)) {
                    $metrics[] = array_combine($headers, $row);
                }
            }
            fclose($handle);
        }

        $charts = [
            'F1-Confidence Curve'      => 'F1_curve.png',
            'Precision-Recall Curve'   => 'PR_curve.png',
            'Precision-Confidence'     => 'P_curve.png',
            'Recall-Confidence'        => 'R_curve.png',
            'Confusion Matrix'         => 'confusion_matrix.png',
            'Confusion Matrix (Norm)'  => 'confusion_matrix_normalized.png',
            'Label Distribution'       => 'labels.jpg',
        ];

        return view('corn-detection.metrics', compact('metrics', 'charts'));
    }

    /**
     * Serve file gambar dari storage/app/ai-model.
     */
    public function showChart(string $filename)
    {
        $path = storage_path("app/ai-model/{$filename}");
        abort_unless(file_exists($path), 404);
        return response()->file($path);
    }
}