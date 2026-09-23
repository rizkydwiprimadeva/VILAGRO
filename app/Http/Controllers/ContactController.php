<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactSubmission;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function submit(StoreContactRequest $request): JsonResponse
    {
        ContactSubmission::create($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Permohonan terkirim! Tim Agronomis VILAGRO segera menghubungi WhatsApp Anda.',
        ]);
    }
}