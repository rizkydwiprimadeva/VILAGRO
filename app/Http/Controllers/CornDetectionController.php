<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
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
        return view('home');
    }

    /**
     * Proses deteksi gambar.
     */
    public function detect(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
        ], [
            'image.required' => 'Silakan unggah gambar terlebih dahulu.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 10MB.',
        ]);

        try {
            $image = $request->file('image');
            $conf = (float) config('services.ai.inference_confidence', 0.25);

            $response = Http::timeout(120)
                ->attach(
                    'image',
                    file_get_contents($image->getRealPath()),
                    $image->getClientOriginalName()
                )
                ->post("{$this->aiServiceUrl}/predict", [
                    'conf' => $conf,
                ]);

            if (! $response->successful()) {
                Log::error('AI service error', ['body' => $response->body()]);

                return back()->with('error', 'AI service gagal merespons: '.$response->status());
            }

            $result = $response->json();

            // Enrich dengan info dari config (nama latin, gejala, SOP)
            $result['enriched'] = $this->enrichResult($result['detections'] ?? []);

            return view('home', [
                'result' => $result,
            ]);

        } catch (ConnectionException $e) {
            Log::error('AI connection failed: '.$e->getMessage());

            return back()->with('error', 'Tidak dapat terhubung ke AI service. Pastikan Python service sudah berjalan di port 5001.');
        } catch (\Exception $e) {
            Log::error('Detection error: '.$e->getMessage());

            return back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    /**
     * Enrich hasil deteksi dengan data gejala, latin name, dan SOP treatment.
     */
    protected function enrichResult(array $detections): array
    {
        $diseaseDb = config('corn_diseases');
        $minConfidence = (float) config('services.ai.minimum_confidence', 0.65);
        $detections = array_values(array_filter($detections, static function ($detection) {
            return isset($detection['class_name'], $detection['confidence'])
                && is_string($detection['class_name'])
                && is_numeric($detection['confidence']);
        }));

        if (empty($detections)) {
            return [
                'status' => 'no_detection',
                'disease' => [
                    'indonesian_name' => 'Belum Teridentifikasi',
                    'pathogen_latin' => '—',
                    'symptoms' => 'Model tidak menemukan penyakit yang dikenali. Ini bukan konfirmasi bahwa tanaman sehat atau bahwa gambar sesuai dengan objek yang didukung.',
                    'treatments' => [
                        'Pastikan foto menampilkan tanaman jagung dengan jelas dan area gejala terlihat fokus.',
                        'Ambil foto ulang dengan pencahayaan cukup dan hindari latar yang terlalu ramai.',
                    ],
                ],
                'confidence' => null,
                'total' => 0,
                'all' => [],
            ];
        }

        usort($detections, static fn ($a, $b) => (float) $b['confidence'] <=> (float) $a['confidence']);
        $top = $detections[0];
        $className = (string) $top['class_name'];
        $confidence = (float) $top['confidence'];
        $info = $diseaseDb[$className] ?? null;

        if ($confidence < $minConfidence || $info === null) {
            $candidateName = $info['indonesian_name'] ?? 'kelas yang belum dipetakan';

            return [
                'status' => 'uncertain',
                'disease' => [
                    'indonesian_name' => $info ? 'Kandidat: '.$candidateName : 'Perlu Foto Ulang',
                    'pathogen_latin' => $info['pathogen_latin'] ?? '—',
                    'symptoms' => $info
                        ? 'Model mendeteksi kandidat '.$candidateName.' dengan skor '.round($confidence * 100, 1).'%, di bawah ambang identifikasi '.round($minConfidence * 100).'%. Hasil ini belum cukup pasti untuk menjadi diagnosis.'
                        : 'Model menghasilkan kelas yang belum memiliki keterangan penyakit di aplikasi. Periksa kembali foto atau perbarui mapping kelas model.',
                    'treatments' => [
                        'Ambil foto ulang dengan jarak 15–30 cm dan fokuskan pada area gejala.',
                        'Pastikan pencahayaan cukup dan tanaman jagung memenuhi sebagian besar gambar.',
                    ],
                ],
                'confidence' => round($confidence * 100, 2),
                'class_name' => $className,
                'total' => count($detections),
                'all' => $detections,
            ];
        }

        return [
            'status' => 'infected',
            'disease' => $info,
            'confidence' => round($confidence * 100, 2),
            'class_name' => $className,
            'total' => count($detections),
            'all' => $detections,
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
            'F1-Confidence Curve' => 'F1_curve.png',
            'Precision-Recall Curve' => 'PR_curve.png',
            'Precision-Confidence' => 'P_curve.png',
            'Recall-Confidence' => 'R_curve.png',
            'Confusion Matrix' => 'confusion_matrix.png',
            'Confusion Matrix (Norm)' => 'confusion_matrix_normalized.png',
            'Label Distribution' => 'labels.jpg',
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
