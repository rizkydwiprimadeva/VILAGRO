<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CornDetectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_submit_a_corn_scan(): void
    {
        $this->post(route('corn.detect'))
            ->assertRedirectToRoute('login');
    }

    public function test_successful_scan_is_stored_and_alerts_only_nearby_farmers(): void
    {
        $reporter = User::factory()->create();
        $nearbyFarmer = User::factory()->create([
            'farm_latitude' => -6.201,
            'farm_longitude' => 106.817,
            'receive_disease_alerts' => true,
        ]);
        User::factory()->create([
            'farm_latitude' => -6.4,
            'farm_longitude' => 106.8,
            'receive_disease_alerts' => true,
        ]);

        Storage::fake('local');
        Http::preventStrayRequests();
        Http::fake([
            'http://127.0.0.1:5001/predict' => Http::response([
                'success' => true,
                'detections' => [[
                    'class_name' => 'blight',
                    'confidence' => 0.957,
                ]],
            ]),
        ]);

        $response = $this->actingAs($reporter)->post(route('corn.detect'), [
            'image' => UploadedFile::fake()->image('leaf.jpg'),
            'latitude' => -6.2,
            'longitude' => 106.816,
            'publish_location_consent' => '1',
        ]);

        $response->assertRedirectToRoute('scanner')
            ->assertSessionHas('scan_result.status', 'infected')
            ->assertSessionHas('scan_result.recipient_count', 1);
        $this->assertDatabaseHas('disease_reports', [
            'user_id' => $reporter->id,
            'disease_class' => 'blight',
            'status' => 'infected',
        ]);
        $this->assertDatabaseCount('notifications', 1);

        $notification = $nearbyFarmer->notifications()->firstOrFail();
        $this->assertSame('Hawar Daun (Blight)', $notification->data['disease_name']);

        Http::assertSent(fn (Request $request): bool => $request->url() === 'http://127.0.0.1:5001/predict'
            && $request->isMultipart()
            && $request->hasFile('image'));

        $report = $reporter->diseaseReports()->firstOrFail();
        Storage::disk('local')->assertExists($report->image_path);
    }

    public function test_no_detection_is_saved_without_sending_alerts(): void
    {
        $reporter = User::factory()->create();
        User::factory()->create([
            'farm_latitude' => -6.201,
            'farm_longitude' => 106.817,
            'receive_disease_alerts' => true,
        ]);

        Storage::fake('local');
        Http::preventStrayRequests();
        Http::fake([
            'http://127.0.0.1:5001/predict' => Http::response([
                'success' => true,
                'detections' => [],
            ]),
        ]);

        $response = $this->actingAs($reporter)->post(route('corn.detect'), [
            'image' => UploadedFile::fake()->image('leaf.jpg'),
            'latitude' => -6.2,
            'longitude' => 106.816,
            'publish_location_consent' => '1',
        ]);

        $response->assertRedirectToRoute('scanner')
            ->assertSessionHas('scan_result.status', 'no_detection')
            ->assertSessionHas('scan_result.recipient_count', 0);
        $this->assertDatabaseHas('disease_reports', [
            'user_id' => $reporter->id,
            'status' => 'no_detection',
            'disease_name' => 'Belum Teridentifikasi',
        ]);
        $this->assertDatabaseCount('notifications', 0);
    }

    public function test_healthy_prediction_is_not_sent_as_a_disease_alert(): void
    {
        $reporter = User::factory()->create();
        User::factory()->create([
            'farm_latitude' => -6.201,
            'farm_longitude' => 106.817,
            'receive_disease_alerts' => true,
        ]);

        Storage::fake('local');
        Http::preventStrayRequests();
        Http::fake([
            'http://127.0.0.1:5001/predict' => Http::response([
                'success' => true,
                'detections' => [[
                    'class_name' => 'healthy',
                    'confidence' => 0.99,
                ]],
            ]),
        ]);

        $response = $this->actingAs($reporter)->post(route('corn.detect'), [
            'image' => UploadedFile::fake()->image('leaf.jpg'),
            'latitude' => -6.2,
            'longitude' => 106.816,
            'publish_location_consent' => '1',
        ]);

        $response->assertRedirectToRoute('scanner')
            ->assertSessionHas('scan_result.status', 'healthy');
        $this->assertDatabaseHas('disease_reports', [
            'user_id' => $reporter->id,
            'status' => 'healthy',
            'disease_class' => 'healthy',
        ]);
        $this->assertDatabaseCount('notifications', 0);
    }

    public function test_low_confidence_prediction_is_marked_uncertain_without_alerts(): void
    {
        $reporter = User::factory()->create();
        User::factory()->create([
            'farm_latitude' => -6.201,
            'farm_longitude' => 106.817,
            'receive_disease_alerts' => true,
        ]);

        Storage::fake('local');
        Http::preventStrayRequests();
        Http::fake([
            'http://127.0.0.1:5001/predict' => Http::response([
                'success' => true,
                'detections' => [[
                    'class_name' => 'blight',
                    'confidence' => 0.52,
                ]],
            ]),
        ]);

        $response = $this->actingAs($reporter)->post(route('corn.detect'), [
            'image' => UploadedFile::fake()->image('leaf.jpg'),
            'latitude' => -6.2,
            'longitude' => 106.816,
            'publish_location_consent' => '1',
        ]);

        $response->assertRedirectToRoute('scanner')
            ->assertSessionHas('scan_result.status', 'uncertain')
            ->assertSessionHas('scan_result.confidence', 52.0);
        $this->assertDatabaseHas('disease_reports', [
            'user_id' => $reporter->id,
            'status' => 'uncertain',
        ]);
        $this->assertDatabaseCount('notifications', 0);
    }

    public function test_scan_rejects_invalid_coordinates_before_calling_ai(): void
    {
        Http::preventStrayRequests();

        $response = $this->actingAs(User::factory()->create())
            ->from(route('scanner'))
            ->post(route('corn.detect'), [
                'image' => UploadedFile::fake()->image('leaf.jpg'),
                'latitude' => 91,
                'longitude' => 181,
                'publish_location_consent' => '1',
            ]);

        $response->assertRedirectBackWithErrors(['latitude', 'longitude']);
        $this->assertDatabaseCount('disease_reports', 0);
    }

    public function test_scan_requires_consent_to_publish_the_report_location(): void
    {
        Http::preventStrayRequests();

        $response = $this->actingAs(User::factory()->create())
            ->from(route('scanner'))
            ->post(route('corn.detect'), [
                'image' => UploadedFile::fake()->image('leaf.jpg'),
                'latitude' => -6.2,
                'longitude' => 106.816,
            ]);

        $response->assertRedirectBackWithErrors(['publish_location_consent']);
        $this->assertDatabaseCount('disease_reports', 0);
    }

    public function test_ai_service_failure_does_not_save_a_report(): void
    {
        Storage::fake('local');
        Http::preventStrayRequests();
        Http::fake([
            'http://127.0.0.1:5001/predict' => Http::response([], 503),
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->from(route('scanner'))
            ->post(route('corn.detect'), [
                'image' => UploadedFile::fake()->image('leaf.jpg'),
                'latitude' => -6.2,
                'longitude' => 106.816,
                'publish_location_consent' => '1',
            ]);

        $response->assertRedirectBackWithErrors(['image']);
        $this->assertDatabaseCount('disease_reports', 0);
        $this->assertDatabaseCount('notifications', 0);
        $this->assertSame([], Storage::disk('local')->allFiles('disease-reports'));
    }
}
