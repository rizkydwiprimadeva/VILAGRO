<?php

namespace App\Notifications;

use App\Models\DiseaseReport;
use Illuminate\Notifications\Notification;

class NearbyDiseaseAlert extends Notification
{
    public function __construct(public DiseaseReport $report) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'report_id' => $this->report->id,
            'disease_name' => $this->report->disease_name,
            'confidence' => $this->report->confidence,
            'message' => 'Ada laporan '.$this->report->disease_name.' dalam radius 5 km dari kebun Anda.',
        ];
    }
}
