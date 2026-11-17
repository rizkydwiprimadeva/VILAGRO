<?php

namespace Tests\Feature;

use App\Models\DiseaseReport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiseaseReportHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_when_opening_scan_history(): void
    {
        $this->get(route('scan-history.index'))
            ->assertRedirectToRoute('login');
    }

    public function test_farmer_sees_only_their_reports_in_newest_first_order(): void
    {
        $farmer = User::factory()->create();
        $otherFarmer = User::factory()->create();
        $olderReport = $this->createReport($farmer, [
            'disease_name' => 'Busuk Batang Lama',
        ], now()->subDay());
        $newerReport = $this->createReport($farmer, [
            'disease_name' => 'Hawar Daun Baru',
        ], now());
        $this->createReport($otherFarmer, [
            'disease_name' => 'Laporan Petani Lain',
        ]);

        $response = $this->actingAs($farmer)->get(route('scan-history.index'));

        $response->assertOk()
            ->assertSeeInOrder(['Hawar Daun Baru', 'Busuk Batang Lama'])
            ->assertDontSee('Laporan Petani Lain')
            ->assertDontSee('disease-reports/private-leaf.jpg')
            ->assertDontSee('-6.2000000');
        $response->assertViewHas('reports', fn ($reports): bool => $reports->total() === 2
            && $reports->first()->is($newerReport)
            && $reports->last()->is($olderReport)
            && ! array_key_exists('image_path', $reports->first()->getAttributes())
            && ! array_key_exists('latitude', $reports->first()->getAttributes()));
    }

    public function test_farmer_sees_an_empty_state_when_they_have_no_scan_history(): void
    {
        $farmer = User::factory()->create();

        $this->actingAs($farmer)
            ->get(route('scan-history.index'))
            ->assertSee('Belum ada riwayat scan.');
    }

    public function test_scan_history_shows_ten_reports_on_the_first_page(): void
    {
        $farmer = User::factory()->create();

        for ($reportNumber = 1; $reportNumber <= 11; $reportNumber++) {
            $this->createReport($farmer, [
                'disease_name' => "Laporan {$reportNumber}",
            ], now()->subMinutes($reportNumber));
        }

        $firstPage = $this->actingAs($farmer)->get(route('scan-history.index'));

        $firstPage->assertSee('Laporan 1')
            ->assertDontSee('Laporan 11')
            ->assertViewHas('reports', fn ($reports): bool => $reports->count() === 10
                && $reports->total() === 11);
    }

    public function test_scan_history_shows_the_remaining_report_on_the_second_page(): void
    {
        $farmer = User::factory()->create();

        for ($reportNumber = 1; $reportNumber <= 11; $reportNumber++) {
            $this->createReport($farmer, [
                'disease_name' => "Laporan {$reportNumber}",
            ], now()->subMinutes($reportNumber));
        }

        $this->actingAs($farmer)
            ->get(route('scan-history.index', ['page' => 2]))
            ->assertSee('Laporan 11')
            ->assertDontSee('Laporan 10')
            ->assertViewHas('reports', fn ($reports): bool => $reports->count() === 1
                && $reports->total() === 11);
    }

    /**
     * @param array<string, mixed> $attributes
     */
    private function createReport(
        User $farmer,
        array $attributes = [],
        ?\DateTimeInterface $createdAt = null,
    ): DiseaseReport
    {
        $report = $farmer->diseaseReports()->create([
            'disease_class' => 'blight',
            'disease_name' => 'Hawar Daun',
            'status' => 'infected',
            'confidence' => 95.7,
            'image_path' => 'disease-reports/private-leaf.jpg',
            'latitude' => -6.2,
            'longitude' => 106.816,
            'location_consent_at' => now(),
            ...$attributes,
        ]);

        if ($createdAt !== null) {
            $report->created_at = $createdAt;
            $report->save();
        }

        return $report;
    }
}
