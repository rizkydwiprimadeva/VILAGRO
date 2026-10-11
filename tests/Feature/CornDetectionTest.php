<?php

namespace Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CornDetectionTest extends TestCase
{
    public function test_no_detection_is_not_reported_as_healthy(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            '127.0.0.1:5001/predict' => Http::response([
                'success' => true,
                'detections' => [],
                'total' => 0,
            ]),
        ]);

        $this->withoutVite();
        $response = $this->post(route('corn.detect'), [
            'image' => UploadedFile::fake()->image('leaf.jpg'),
        ]);

        $response->assertOk()->assertViewHas('result', function (array $result): bool {
            return $result['enriched']['status'] === 'no_detection'
                && $result['enriched']['disease']['indonesian_name'] === 'Belum Teridentifikasi'
                && $result['enriched']['confidence'] === null;
        });
        Http::assertSent(fn (Request $request): bool => $request->url() === 'http://127.0.0.1:5001/predict'
            && $request->isMultipart()
            && $request->hasFile('image'));
    }

    public function test_low_confidence_detection_is_marked_uncertain(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            '127.0.0.1:5001/predict' => Http::response([
                'success' => true,
                'detections' => [[
                    'class_name' => 'blight',
                    'confidence' => 0.52,
                ]],
                'total' => 1,
            ]),
        ]);

        $this->withoutVite();
        $response = $this->post(route('corn.detect'), [
            'image' => UploadedFile::fake()->image('leaf.jpg'),
        ]);

        $response->assertOk()->assertViewHas('result', function (array $result): bool {
            return $result['enriched']['status'] === 'uncertain'
                && $result['enriched']['disease']['indonesian_name'] === 'Kandidat: Hawar Daun (Blight)'
                && $result['enriched']['confidence'] === 52.0;
        });
    }

    public function test_confident_detection_uses_the_trained_class_mapping(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            '127.0.0.1:5001/predict' => Http::response([
                'success' => true,
                'detections' => [[
                    'class_name' => 'blight',
                    'confidence' => 0.957,
                ]],
                'total' => 1,
            ]),
        ]);

        $this->withoutVite();
        $response = $this->post(route('corn.detect'), [
            'image' => UploadedFile::fake()->image('leaf.jpg'),
        ]);

        $response->assertOk()->assertViewHas('result', function (array $result): bool {
            return $result['enriched']['status'] === 'infected'
                && $result['enriched']['disease']['indonesian_name'] === 'Hawar Daun (Blight)'
                && $result['enriched']['confidence'] === 95.7;
        });
    }
}
