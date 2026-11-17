<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use UnexpectedValueException;

class CornDiseaseDetector
{
    /**
     * @return array{
     *     status: string,
     *     disease_class: ?string,
     *     disease_name: string,
     *     pathogen_latin: string,
     *     symptoms: string,
     *     treatments: array<int, string>,
     *     confidence: ?float
     * }
     *
     * @throws ConnectionException
     * @throws RequestException
     * @throws UnexpectedValueException
     */
    public function detect(UploadedFile $image): array
    {
        $imageContents = file_get_contents($image->getRealPath());

        if ($imageContents === false) {
            throw new UnexpectedValueException('The uploaded image could not be read.');
        }

        $baseUrl = rtrim((string) config('services.ai.url', 'http://127.0.0.1:5001'), '/');
        $response = Http::timeout((int) config('services.ai.timeout', 120))
            ->attach('image', $imageContents, $image->getClientOriginalName())
            ->post($baseUrl.'/predict', [
                'conf' => (float) config('services.ai.inference_confidence', 0.25),
            ]);

        $response->throw();

        $payload = $response->json();

        if (
            ! is_array($payload)
            || ($payload['success'] ?? null) !== true
            || ! is_array($payload['detections'] ?? null)
        ) {
            throw new UnexpectedValueException('The AI service returned an invalid response.');
        }

        if ($payload['detections'] === []) {
            return [
                'status' => 'no_detection',
                'disease_class' => null,
                'disease_name' => 'Belum Teridentifikasi',
                'pathogen_latin' => '—',
                'symptoms' => 'Model tidak menemukan penyakit yang dikenali. Hasil ini bukan konfirmasi bahwa tanaman sehat.',
                'treatments' => [
                    'Pastikan foto menampilkan tanaman jagung dan area gejala terlihat jelas.',
                    'Ambil foto ulang dengan pencahayaan cukup dan fokus pada bagian tanaman yang bergejala.',
                ],
                'confidence' => null,
            ];
        }

        $detections = array_values(array_filter(
            $payload['detections'],
            static fn (mixed $detection): bool => is_array($detection)
                && is_string($detection['class_name'] ?? null)
                && $detection['class_name'] !== ''
                && is_numeric($detection['confidence'] ?? null)
                && (float) $detection['confidence'] >= 0
                && (float) $detection['confidence'] <= 1,
        ));

        if ($detections === []) {
            throw new UnexpectedValueException('The AI service returned no valid detections.');
        }

        usort(
            $detections,
            static fn (array $first, array $second): int => (float) $second['confidence'] <=> (float) $first['confidence'],
        );

        $topDetection = $detections[0];
        $className = $topDetection['class_name'];
        $confidence = (float) $topDetection['confidence'];
        $minimumConfidence = (float) config('services.ai.minimum_confidence', 0.65);
        $disease = config('corn_diseases', [])[$className] ?? null;

        if (! is_array($disease)) {
            return [
                'status' => 'uncertain',
                'disease_class' => $className,
                'disease_name' => 'Kelas belum dikenali aplikasi',
                'pathogen_latin' => '—',
                'symptoms' => 'Model mengembalikan kelas yang belum memiliki keterangan penyakit di aplikasi. Hasil ini belum dapat dipastikan.',
                'treatments' => [
                    'Ambil foto ulang dengan fokus pada area gejala.',
                    'Minta pemeriksaan lanjutan dari petugas pertanian setempat.',
                ],
                'confidence' => round($confidence * 100, 2),
            ];
        }

        if ($confidence < $minimumConfidence) {
            return [
                'status' => 'uncertain',
                'disease_class' => $className,
                'disease_name' => 'Kandidat: '.$disease['indonesian_name'],
                'pathogen_latin' => $disease['pathogen_latin'],
                'symptoms' => 'Skor model berada di bawah ambang identifikasi '.round($minimumConfidence * 100).'%. Hasil ini belum cukup pasti untuk menjadi diagnosis.',
                'treatments' => [
                    'Ambil foto ulang dengan pencahayaan cukup dan area gejala terlihat jelas.',
                    'Konfirmasikan gejala dengan petugas pertanian sebelum melakukan tindakan pengendalian.',
                ],
                'confidence' => round($confidence * 100, 2),
            ];
        }

        return [
            'status' => $className === 'healthy' ? 'healthy' : 'infected',
            'disease_class' => $className,
            'disease_name' => $disease['indonesian_name'],
            'pathogen_latin' => $disease['pathogen_latin'],
            'symptoms' => $disease['symptoms'],
            'treatments' => $disease['treatments'],
            'confidence' => round($confidence * 100, 2),
        ];
    }
}
