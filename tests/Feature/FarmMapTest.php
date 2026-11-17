<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\NearbyDiseaseAlert;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FarmMapTest extends TestCase
{
    use RefreshDatabase;

    public function test_farmer_can_save_location_and_alert_preferences(): void
    {
        $farmer = User::factory()->create();

        $response = $this->actingAs($farmer)->post(route('farm-location.update'), [
            'latitude' => -6.2,
            'longitude' => 106.816,
            'receive_disease_alerts' => '1',
            'show_farm_on_map' => '1',
        ]);

        $response->assertRedirectToRoute('farm-map')
            ->assertSessionHas('farm_location_saved');
        $this->assertDatabaseHas('users', [
            'id' => $farmer->id,
            'farm_latitude' => -6.2,
            'farm_longitude' => 106.816,
            'receive_disease_alerts' => 1,
            'show_farm_on_map' => 1,
        ]);
    }

    public function test_public_map_only_shows_farms_that_opted_in(): void
    {
        $reporter = User::factory()->create();
        $reporter->diseaseReports()->create([
            'disease_class' => 'blight',
            'disease_name' => 'Hawar Daun (Blight)',
            'status' => 'infected',
            'confidence' => 95.7,
            'image_path' => 'disease-reports/leaf.jpg',
            'latitude' => -6.2,
            'longitude' => 110.0,
            'location_consent_at' => now(),
        ]);
        User::factory()->create([
            'farm_latitude' => -6.2345678,
            'farm_longitude' => 106.8123456,
            'show_farm_on_map' => true,
        ]);
        User::factory()->create([
            'farm_latitude' => -7.2345678,
            'farm_longitude' => 107.8123456,
            'show_farm_on_map' => false,
        ]);

        $this->get(route('farm-map'))
            ->assertOk()
            ->assertSee('Laporan terdekat')
            ->assertSee('Hawar Daun (Blight)')
            ->assertSee('-6.23')
            ->assertSee('106.81')
            ->assertDontSee('-7.2345678')
            ->assertDontSee('107.8123456');
    }

    public function test_farmer_can_read_their_notification_but_other_users_cannot(): void
    {
        $owner = User::factory()->create();
        $otherFarmer = User::factory()->create();
        $report = $owner->diseaseReports()->create([
            'disease_class' => 'blight',
            'disease_name' => 'Hawar Daun (Blight)',
            'status' => 'infected',
            'confidence' => 95.7,
            'image_path' => 'disease-reports/leaf.jpg',
            'latitude' => -6.2,
            'longitude' => 106.816,
            'location_consent_at' => now(),
        ]);
        $owner->notify(new NearbyDiseaseAlert($report));
        $notificationId = $owner->notifications()->firstOrFail()->id;

        $this->actingAs($otherFarmer)
            ->post(route('notifications.read', $notificationId))
            ->assertNotFound();

        $this->assertDatabaseHas('notifications', [
            'id' => $notificationId,
            'notifiable_id' => $owner->id,
            'read_at' => null,
        ]);

        $this->actingAs($owner)
            ->post(route('notifications.read', $notificationId))
            ->assertRedirectToRoute('notifications.index');

        $this->assertNotNull($owner->notifications()->findOrFail($notificationId)->read_at);
    }
}
