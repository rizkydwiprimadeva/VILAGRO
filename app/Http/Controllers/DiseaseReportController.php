<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DiseaseReportController extends Controller
{
    public function index(Request $request): View
    {
        $reports = $request->user()
            ->diseaseReports()
            ->latest()
            ->orderByDesc('id')
            ->paginate(10, [
                'id',
                'disease_class',
                'disease_name',
                'status',
                'confidence',
                'created_at',
            ]);

        return view('pages.scan-history', compact('reports'));
    }
}
