<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Metrik Training Model</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-8 bg-gray-100">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">📊 Metrik Training Model YOLOv8n</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            @foreach($charts as $title => $file)
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="font-semibold mb-2">{{ $title }}</h2>
                    <img src="{{ route('corn.chart', $file) }}" 
                        alt="{{ $title }}" class="w-full rounded">
                </div>
            @endforeach
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-semibold mb-2">📈 Epoch Terakhir</h2>
            @php $last = end($metrics); @endphp
            @if($last)
                <ul class="grid grid-cols-2 gap-2 text-sm">
                    <li><b>Precision:</b> {{ $last['metrics/precision(B)'] ?? '-' }}</li>
                    <li><b>Recall:</b> {{ $last['metrics/recall(B)'] ?? '-' }}</li>
                    <li><b>mAP@50:</b> {{ $last['metrics/mAP50(B)'] ?? '-' }}</li>
                    <li><b>mAP@50-95:</b> {{ $last['metrics/mAP50-95(B)'] ?? '-' }}</li>
                </ul>
            @endif
        </div>

        <a href="{{ route('corn.index') }}" 
            class="inline-block mt-6 bg-blue-600 text-white px-4 py-2 rounded">
            ← Kembali ke Deteksi
        </a>
    </div>
</body>
</html>