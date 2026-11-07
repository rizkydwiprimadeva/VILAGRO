@push('styles')
    @vite('resources/css/map.css')
@endpush

@push('scripts')
    @vite('resources/js/map.js')
@endpush

<section class="village-map" id="peta-sawah" aria-labelledby="village-map-title">
    <div class="village-map__content">
        <header class="village-map__heading">
            <span class="village-map__eyebrow">POTENSI PERTANIAN LOKAL</span>
            <h2 id="village-map-title">Peta Sawah Desa Jarak</h2>
            <p>Kecamatan Plosoklaten, Kabupaten Kediri, Jawa Timur</p>
        </header>

        <div class="village-map__card">
            <p class="village-map__hint">
                <span class="material-symbols-outlined" aria-hidden="true">touch_app</span>
                Klik petak berwarna untuk melihat informasi sawah.
            </p>
            <div class="village-map__layout">
                <div class="village-map__canvas">
                    <svg id="kediri-map" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 842 561">
                <g id="kediri-map-group">
                    
                    <!-- 1. Lapisan Dasar -->
                    <path fill="#e0f7e9" stroke="#000" stroke-width="0.5" d="M31.5 16H36l4.5-4L52 16l19.5 5 7.5 6.5h8l21 7 19 11 19.5 9.5 18 10.5 21.5 11 15 3.5 14 12 14.5 13 8.5 12 11 4.5 13 9 7 7.5 11 9.5 9 11.5 6.5 12.5L300 186l13.5 13.5 11 10.5 21 10.5 26.5 19 29 5h11l7.5 7.5 15 3.5 13 4.5 11 7 7.5 6 10 4 9.5-1.5 7 9 7 7.5 11.5 6.5h9.5l8.5 6.5 8.5 5 9.5 4 6 9.5 5.5 8v-.5l11.5 12 8.5 11 16 12.5 12.5 6 11-1.5 11 5 17 11 15 5 14.5 5 14 8 10.5 3.5 11 7 10 3 2.5 7.5 18.5 1.5 13 4 11 8.5 8.5 7h8l6-2.5h4.5l1.5 4 5 6h7l10.5 4 7.5 7 9 5 7.5 1.5 1 4-11 16.5-11.5 17-9 17.5-.5 5c2.667.833 8.1 2.6 8.5 3s7.5 3.167 11 4.5l6.5.5 1 3-3 5.5-3 7.5-2.5 4.5-15-5-19-9-17-4.5-22-7-13.5-5-17.5-1.5L699 525l-30.5-5-25-5.5-17.5-2h-19.5L585 509l-20.5-5.5L541 499l-20-3-26-3.5-18-4-24.5-16.5-28-13.5-20-4h-17 .5l-19.5-7-27-17.5-28.5-18-13.5-14v-13l-14-6-10.5-5h-8l-8.5-6.5L248 364h-15l-4-7.5-7-9-13.5-13.5-13-7h-6l-4 7h-5l-4-2.5-2-4.5 4-4 2-15.5v-14l-8-6h-9l-10-7-9.5-6.5-14-8.5-6.5-3.5-3-9-2.5-7 2.5-6.5 5.5-4.5 4-2.5 6-2.5v-10l4.5-15.5 3.5-9.5 4-12.5v-5h-24.5l-10 2-12-6.5-18-11-22-17.5L55 135l-6-12-5-14.5H34l-9.5-8-9.5-11-11-5-4-14 1.5-38L6 4l3-4 9 6.5 11.5 6L32 16z"/>
                    
                    <!-- 2. Lapisan Jalan -->
                    <path fill="none" stroke="#a0d8ef" stroke-width="1" d="M77 78l35-10 20 20 30 5 15 20 25 10 20 15 15 5 10 20 20 10 15 25 25 5 15 20 20 5 30 20 15 10 20 5M100 120l40 10 20 20 30 5 15 15 20 10 10 20 20 15 25 10 15 20 20 5 30 15 15 10 20 5M200 180l30 10 15 20 25 10 20 15 30 5 15 20 20 5M150 250l40 20 20 10 15 20 25 10 20 15 30 5 15 20 20 5M250 300l35 15 20 20 15 15 25 10 30 20 15 10M300 350l40 20 25 15 15 20 30 10 20 15 25 5M350 400l30 20 25 15 15 10 40 10 20 15 30 5M400 450l25 15 20 10 35 5 30 20 15 10 25 5M450 500l30 15 25 10 20 20 35 5 30 15 25 10M550 450l20 10 25 15 15 10 30 5 20 15 25 10 20 5M600 400l25 15 30 10 15 20 20 5 25 15 30 5 20 10M650 350l30 15 25 10 20 15 35 5 30 20 15 10 25 5M700 300l25 15 20 10 30 15 25 10 15 20 20 5 25 15M750 250l20 15 25 10 30 15 25 20 15 10 20 5M600 250l20 15 25 10 30 15 25 10 15 20 20 5 25 15 30 10 20 15M500 200l25 15 30 10 15 20 20 5 25 15 30 10 20 15 25 5"/>

                    <!-- 3. Area Berwarna (SETIAP PATH DAPAT DIKLIK) -->
                    <!-- Grup Oranye -->
                    <g class="sawah-oranye">
                        <path data-nama="Petak Oranye 1" data-deskripsi="Area persawahan oranye bagian atas." d="m424.5 267 3.5-8 35.5 16.5-9 14.5z"/>
                        <path data-nama="Petak Oranye 2" data-deskripsi="Area persawahan oranye bagian tengah." d="M453 291.5l-17-12-8.5 17-7.5 10-7 12.5 14.5 10 12-25z"/>
                        <path data-nama="Petak Oranye 3" data-deskripsi="Area persawahan oranye bagian kiri." d="M433 278.5l-8.5-7-26.5 35 11.5 9.5 11-17 5-11.5z"/>
                        <path data-nama="Petak Oranye 4" data-deskripsi="Area persawahan oranye bagian bawah." d="M422 269.5 404 257l-19.5 32 10 16z"/>
                        <path data-nama="Petak Oranye 5" data-deskripsi="Area persawahan oranye kecil." d="M378 271l-6.5-2.5 11 18 10-15.5z"/>
                        <path data-nama="Petak Oranye 6" data-deskripsi="Area persawahan oranye vertikal." d="M427 391.5v-53l-8.5 8-10 39.5z"/>
                        <path data-nama="Petak Oranye 7" data-deskripsi="Area persawahan oranye besar di kiri." d="m425 334.5-15-12-13.5 17.5-4 13.5L382 377l22.5 7 9.5-39.5z"/>
                        <path data-nama="Petak Oranye 8" data-deskripsi="Area persawahan oranye diagonal." d="M405.5 320 393 309.5 369 369l10 5 11-25 4-14z"/>
                        <path data-nama="Petak Oranye 9" data-deskripsi="Area persawahan oranye panjang." d="M389.5 307l-9.5-16.5-26.5 63.5 4 4v4.5l8.5 5z"/>
                        <path data-nama="Petak Oranye 10" data-deskripsi="Area persawahan oranye bawah." d="M426 397.5l-25-9.5-17 32.5-10.5 15-3 13 55.5 9z"/>
                        <path data-nama="Petak Oranye 11" data-deskripsi="Area persawahan oranye kecil di tengah." d="M397 387.5l-15.5-6L374 394l-8.5 14-11.5 17.5V436l11.5 7.5V441l4.5-7v-5l8-6.5z"/>
                        <path data-nama="Petak Oranye 12" data-deskripsi="Area persawahan oranye di atas." d="m351 251-12.5-12-12.5 14c-.5 2.667-1.6 8.1-2 8.5s-3.833 11.5-5.5 17l2.5 14 6.5 3.5 1-10.5z"/>
                        <path data-nama="Petak Oranye 13" data-deskripsi="Area persawahan oranye puncak." d="M367 268.5 353.5 254 331 286.5V297l13 5 1.5-10z"/>
                    </g>

                    <!-- Grup Biru -->
                    <g class="sawah-biru">
                        <path data-nama="Petak Biru 1" data-deskripsi="Area persawahan biru di tengah." d="m537.5 342-3 5 16 10h3l6-7 4-5-3-4-7-6-4-5-1-4-3 5-6 8-2 1z"/>
                        <path data-nama="Petak Biru 2" data-deskripsi="Area persawahan biru di kiri tengah." d="m528.5 349.5-16-10.5-26 35 18 14z"/>
                        <path data-nama="Petak Biru 3" data-deskripsi="Area persawahan biru di atas." d="M546.5 324l-13-12-18.5 23 15.5 10 3-3v-2l2-3 2-1z"/>
                        <path data-nama="Petak Biru 4" data-deskripsi="Area persawahan biru besar di kiri." d="m523.5 402-16-12 24-40 17 10z"/>
                        <path data-nama="Petak Biru 5" data-deskripsi="Area persawahan biru memanjang." d="M501.5 391l-19-15v9.5l-4.5 8-14.5 14.5-14 25-11 13.5-8.5 12 20.5 10.5z"/>
                        <path data-nama="Petak Biru 6" data-deskripsi="Area persawahan biru vertikal." d="M430.5 421v28l14-14 5.5-13.5 8.5-12 8-10 6.5-7 6-7v-5l-1.5-3.5 1.5-3-11.5-9-16.5 23.5-4 8z"/>
                        <path data-nama="Petak Biru 7" data-deskripsi="Area persawahan biru tengah." d="M497.5 327.5l-26 34.5 12.5 10 25.5-35.5z"/>
                        <path data-nama="Petak Biru 8" data-deskripsi="Area persawahan biru besar." d="m431 384.5-1 33 8.5-11.5 4.5-11 7-12 14.5-20.5L450 352l-4.5 13z"/>
                        <path data-nama="Petak Biru 9" data-deskripsi="Area persawahan biru di kanan." d="M495 325l-27 35-20-15.5h6l1.5-8.5 3-13 2-8 5.5-4.5 5-4.5z"/>
                        <path data-nama="Petak Biru 10" data-deskripsi="Area persawahan biru puncak." d="m500 295.5-9-9-6.5 6-3.5 6-5.5 7 36.5 27 17.5-23.5-10.5-7.5h-7z"/>
                        <path data-nama="Petak Biru 11" data-deskripsi="Area persawahan biru samping." d="M447 349.5l-16-13-.5 44 10.5-16z"/>
                        <path data-nama="Petak Biru 12" data-deskripsi="Area persawahan biru kecil." d="M441 308l-10.5 24.5 13.5 10 7-1 3-13.5 2.5-15 10.5-9-12-9z"/>
                        <path data-nama="Petak Biru 13" data-deskripsi="Area persawahan biru atas." d="M478.5 282.5 467 278l-9.5 14 15 11.5 4.5-5.5 2.5-6.5 6.5-5.5v-2.5z"/>
                    </g>
                    
                    <!-- Grup Merah -->
                    <g class="sawah-merah">
                        <path data-nama="Petak Merah 1" data-deskripsi="Petak sawah merah paling kanan." d="m580.5 508 15-33.5-9-8.5-25 37z"/>
                        <path data-nama="Petak Merah 2" data-deskripsi="Petak sawah merah besar di kanan." d="m515 493.5 47 8 25-35-35.5-35.5-7 7.5-7 22z"/>
                        <path data-nama="Petak Merah 3" data-deskripsi="Petak sawah merah tengah." d="m488 490 27 3.5 22.5-33L545 438l7-7-16-16.5-6.5 8.5-7 24-10 17-15 9.5z"/>
                        <path data-nama="Petak Merah 4" data-deskripsi="Petak sawah merah kiri." d="m470.5 480.5 18 9.5 8.5-18 13.5-8.5 9-13 5.5-15 3.5-12.5 6.5-8.5-16.5-12-17.5 31-8.5 17-11 7.5z"/>
                        <path data-nama="Petak Merah 5" data-deskripsi="Petak sawah merah memanjang." d="m468 479.5-15-9 4-7.5 8.5-13.5 10-15.5 10.5-14.5 10.5-15 7.5-12 12.5 9-27 48-8 5-3.5 5z"/>
                        <path data-nama="Petak Merah 6" data-deskripsi="Petak sawah merah atas." d="M629.5 410l-18-11-33 55.5 17 17.5z"/>
                        <path data-nama="Petak Merah 7" data-deskripsi="Petak sawah merah diagonal." d="M609.5 398.5l-22-14.5-27 52.5L577 453z"/>
                        <path data-nama="Petak Merah 8" data-deskripsi="Petak sawah merah kecil." d="m618 385.5-6 10.5 19 11.5 5.5-10.5z"/>
                        <path data-nama="Petak Merah 9" data-deskripsi="Petak sawah merah bawah." d="m558.5 434-16-16 34-40 9 5z"/>
                        <path data-nama="Petak Merah 10" data-deskripsi="Petak sawah merah tengah kanan." d="M573.5 376l-22-14-25.5 42 15 12.5z"/>
                        <path data-nama="Petak Merah 11" data-deskripsi="Petak sawah merah atas kanan." d="M581.5 362.5l-18-12.5-9 10 21 12.5z"/>
                        <path data-nama="Petak Merah 12" data-deskripsi="Petak sawah merah paling atas." d="m610 394.5-31.5-20 7.68-12 17.82 12 7.5 1 7.5-2 22 13.5-3 7.5-20.5-12.5-1.5-.5z"/>
                    </g>

                    <!-- Grup Hijau -->
                    <g class="sawah-hijau">
                        <path data-nama="Petak Hijau 1" data-deskripsi="Petak sawah hijau paling kanan." d="m660.5 397.5-16-7.5-10 19 20.5 11.5 3-9z"/>
                        <path data-nama="Petak Hijau 2" data-deskripsi="Petak sawah hijau besar di kanan." d="M655 427l-22.5-14.5-33.5 62 17 16.5z"/>
                        <path data-nama="Petak Hijau 3" data-deskripsi="Petak sawah hijau tengah." d="M670.5 443.5l-13.5-14-38 64.5 12 11.5 16-16.5 7.5-17.5z"/>
                        <path data-nama="Petak Hijau 4" data-deskripsi="Petak sawah hijau kecil." d="M609 492.5l-12.5-14-12 27.5 15 2z"/>
                        <path data-nama="Petak Hijau 5" data-deskripsi="Petak sawah hijau kiri." d="M681.5 479.5 661 472l-16 33-13 4 10.5 4 18.5 1.5 5.5-9.5z"/>
                        <path data-nama="Petak Hijau 6" data-deskripsi="Petak sawah hijau atas." d="M691 459.5 676 446l-9 17 19 7.5z"/>
                        <path data-nama="Petak Hijau 7" data-deskripsi="Petak sawah hijau diagonal." d="M707.5 475 694 462.5l-6 15 13.5 3.5z"/>
                        <path data-nama="Petak Hijau 8" data-deskripsi="Petak sawah hijau memanjang." d="M719.5 440.5 701 433l-4.5 25 13.5 13z"/>
                        <path data-nama="Petak Hijau 9" data-deskripsi="Petak sawah hijau kecil." d="M725 488.5l-14-11-4.5 5z"/>
                        <path data-nama="Petak Hijau 10" data-deskripsi="Petak sawah hijau bawah." d="M743.5 452.5l-19-10.5-11.5 31.5 15.5 13 13-17z"/>
                        <path data-nama="Petak Hijau 11" data-deskripsi="Petak sawah hijau tengah bawah." d="M700 486l-14.5-4.5-20.5 34 18 4.5z"/>
                        <path data-nama="Petak Hijau 12" data-deskripsi="Petak sawah hijau kanan bawah." d="M724 492.5l-19.5-6.5-18.5 35 19.5 3 9.5-20z"/>
                        <path data-nama="Petak Hijau 13" data-deskripsi="Petak sawah hijau paling bawah." d="M754 503l-26-9-8.5 10.5L710 525l29 2 4-6.5 8.5-4-.5-7z"/>
                        <path data-nama="Petak Hijau 14" data-deskripsi="Petak sawah hijau ujung kanan." d="m778 512.5-19.5-9-3.5 8 2 5.5-3 3.5-7 1.5-4.5 6.5 21 6.5 3.5-6 5.5-2.5 1-4.5z"/>
                        <path data-nama="Petak Hijau 15" data-deskripsi="Petak sawah hijau ujung." d="m775.5 528.5 2.5-4 3.391-8.721L791.5 525.5l14 7 9 4 8.5 3 10 5-7 12c-1.667-.667-5.2-2-6-2s-9-4.667-13-7l-12-5.5-10.5-2.5-17-4z"/>
                        <path data-nama="Petak Hijau 16" data-deskripsi="Petak sawah hijau atas kanan." d="m773.5 450.5-26-11 1.5 9.5-2.5 14-2.5 10-13 18 28.5 9.5 12-33 2-11z"/>
                    </g>
                    
                    <!-- 4. Lapisan Batas -->
                    <g fill="none" stroke="#555" stroke-width="1.5" pointer-events="none">
                        <path d="M31.5 16H36l4.5-4L52 16l19.5 5 7.5 6.5h8l21 7 19 11 19.5 9.5 18 10.5 21.5 11 15 3.5 14 12 14.5 13 8.5 12 11 4.5 13 9 7 7.5 11 9.5 9 11.5 6.5 12.5L300 186M300 186l13.5 13.5 11 10.5 21 10.5 26.5 19 29 5h11l7.5 7.5 15 3.5 13 4.5 11 7 7.5 6 10 4 9.5-1.5 7 9M492.5 284.5l7 7.5 11.5 6.5h9.5l8.5 6.5 8.5 5 9.5 4 6 9.5 5.5 8M558.5 331l11.5 12 8.5 11 16 12.5 12.5 6 11-1.5 11 5 17 11 15 5 14.5 5 14 8 10.5 3.5 11 7 10 3 2.5 7.5 18.5 1.5 13 4 11 8.5 8.5 7"/>
                        <path d="M774.5 447h8l6-2.5h4.5l1.5 4 5 6h7l10.5 4 7.5 7 9 5 7.5 1.5 1 4-11 16.5-11.5 17-9 17.5-.5 5c2.667.833 8.1 2.6 8.5 3s7.5 3.167 11 4.5l6.5.5 1 3-3 5.5-3 7.5-2.5 4.5-15-5-19-9-17-4.5-22-7-13.5-5-17.5-1.5L699 525l-30.5-5-25-5.5-17.5-2h-19.5L585 509l-20.5-5.5L541 499l-20-3-26-3.5-18-4-24.5-16.5-28-13.5-20-4h-17"/>
                        <path d="m388 454.5-19.5-7-27-17.5-28.5-18-13.5-14v-13l-14-6-10.5-5h-8l-8.5-6.5L248 364h-15l-4-7.5-7-9-13.5-13.5-13-7h-6l-4 7h-5l-4-2.5-2-4.5 4-4 2-15.5v-14l-8-6h-9l-10-7-9.5-6.5-14-8.5-6.5-3.5-3-9-2.5-7 2.5-6.5 5.5-4.5 4-2.5 6-2.5v-10l4.5-15.5 3.5-9.5 4-12.5v-5h-24.5l-10 2-12-6.5-18-11-22-17.5L55 135l-6-12-5-14.5H34l-9.5-8-9.5-11-11-5-4-14 1.5-38L6 4l3-4 9 6.5 11.5 6L32 16"/>
                    </g>

                </g>
                    </svg>
                </div>
                <aside id="info-panel" class="village-map__info" aria-live="polite" hidden>
                    <button id="close-btn" class="village-map__info-close" type="button" aria-label="Tutup informasi">&times;</button>
                    <span class="village-map__info-label">INFORMASI PETAK</span>
                    <h3 id="info-title">Informasi sawah</h3>
                    <p id="info-desc"></p>
                </aside>
            </div>

            <div class="village-map__legend" aria-label="Keterangan warna sawah">
                <h3>Keterangan warna petak sawah</h3>
                <div class="village-map__legend-items">
                    <span><i class="village-map__legend-swatch village-map__legend-swatch--green"></i>Hijau</span>
                    <span><i class="village-map__legend-swatch village-map__legend-swatch--red"></i>Merah</span>
                    <span><i class="village-map__legend-swatch village-map__legend-swatch--blue"></i>Biru</span>
                    <span><i class="village-map__legend-swatch village-map__legend-swatch--orange"></i>Oranye</span>
                </div>
                <p>Semua area berwarna pada peta merupakan petak sawah dan dapat dipilih.</p>
            </div>
        </div>
    </div>
</section>