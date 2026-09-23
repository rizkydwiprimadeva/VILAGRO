<section class="max-w-7xl mx-auto px-margin-mobile md:px-margin lg:px-margin-desktop py-20" id="kontak">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg">

        <div class="lg:col-span-6 flex flex-col justify-between" id="faq">
            <div>
                <span class="font-label-md text-label-md uppercase tracking-wider text-secondary font-bold">Tanya Jawab Deteksi AI</span>
                <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-primary font-bold mb-space-md">
                    Pertanyaan Sering Diajukan Seputar Scanner AI
                </h2>
                <div class="space-y-space-sm" id="faq-accordion">

                    <div class="faq-item bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-surface-container-high">
                        <button class="faq-toggle w-full p-space-md flex items-center justify-between text-left font-label-lg text-label-lg font-bold text-primary focus:outline-none" type="button">
                            <span>Apakah scanner AI ini membutuhkan koneksi internet berkecepatan tinggi?</span>
                            <span class="material-symbols-outlined faq-icon transition-transform duration-200">expand_more</span>
                        </button>
                        <div class="faq-content hidden px-space-md pb-space-md text-body-sm text-on-surface-variant font-body-sm">
                            Model AI kami dikompresi menggunakan teknologi <em>Edge Inference</em> ringan. Foto secara otomatis diperkecil sebelum dianalisis, sehingga dapat beroperasi mulus bahkan dengan sinyal seluler 3G di pelosok perkebunan.
                        </div>
                    </div>

                    <div class="faq-item bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-surface-container-high">
                        <button class="faq-toggle w-full p-space-md flex items-center justify-between text-left font-label-lg text-label-lg font-bold text-primary focus:outline-none" type="button">
                            <span>Bagaimana cara membedakan gejala Bulai dengan kekurangan unsur hara seng (Zn)?</span>
                            <span class="material-symbols-outlined faq-icon transition-transform duration-200">expand_more</span>
                        </button>
                        <div class="faq-content hidden px-space-md pb-space-md text-body-sm text-on-surface-variant font-body-sm">
                            Gejala Bulai memiliki batas klorotik yang sangat tegas sejajar tulang daun dan disertai lapisan jamur halus seperti tepung putih di bagian bawah daun pada pagi hari bersuhu lembab. Sedangkan klorosis defisiensi hara Zn umumnya menyebar simetris tanpa adanya miselium jamur. AI VILAGRO telah dilatih membedakan kedua pola mikroskopis ini.
                        </div>
                    </div>

                    <div class="faq-item bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-surface-container-high">
                        <button class="faq-toggle w-full p-space-md flex items-center justify-between text-left font-label-lg text-label-lg font-bold text-primary focus:outline-none" type="button">
                            <span>Apakah ada biaya untuk menggunakan platform diagnosa ini?</span>
                            <span class="material-symbols-outlined faq-icon transition-transform duration-200">expand_more</span>
                        </button>
                        <div class="faq-content hidden px-space-md pb-space-md text-body-sm text-on-surface-variant font-body-sm">
                            Layanan AI Scanner VILAGRO 100% GRATIS dan bebas kuota scan tanpa batas bagi seluruh petani jagung di Indonesia demi menjaga ketahanan pangan dan kestabilan pasokan panen nasional.
                        </div>
                    </div>

                    <div class="faq-item bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-surface-container-high">
                        <button class="faq-toggle w-full p-space-md flex items-center justify-between text-left font-label-lg text-label-lg font-bold text-primary focus:outline-none" type="button">
                            <span>Bagaimana jika hasil diagnosis menunjukkan persentase keyakinan rendah (&lt;70%)?</span>
                            <span class="material-symbols-outlined faq-icon transition-transform duration-200">expand_more</span>
                        </button>
                        <div class="faq-content hidden px-space-md pb-space-md text-body-sm text-on-surface-variant font-body-sm">
                            Bila foto buram atau gejala kurang khas, Anda dapat menekan tombol "Konsultasi Agronomis" untuk mengirimkan sampel foto langsung ke agronomis VILAGRO melalui WhatsApp. Kami akan memverifikasi secara manual dalam waktu kurang dari 2 jam kerja.
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-space-lg p-space-md bg-surface-container rounded-xl flex items-center gap-space-md border border-surface-container-high">
                <span class="material-symbols-outlined text-secondary text-[32px]">support</span>
                <div>
                    <p class="font-label-lg text-label-lg font-bold text-on-surface">Hotline Darurat Hama &amp; Penyakit</p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Kirim foto gejala via WhatsApp Agronomis: <span class="font-semibold text-primary">+62 811-2345-6789</span></p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-6 bg-surface-container-lowest p-space-lg md:p-space-xl rounded-3xl shadow-md border border-surface-container-high">
            <div class="mb-space-md">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">Layanan Agronomis Lapangan</span>
                <h3 class="font-headline-sm text-headline-sm text-primary font-bold mt-1">
                    Ajukan Verifikasi Manual &amp; Resep Lapangan
                </h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                    Kirimkan detail lahan Anda jika mengalami indikasi wabah penyakit luas agar tim PPL VILAGRO menjadwalkan inspeksi langsung.
                </p>
            </div>

            <form class="space-y-space-md" id="contact-form" method="POST" action="{{ route('contact.submit') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <div>
                        <label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-name">Nama Petani / Ketua Kelompok *</label>
                        <input class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-name" name="name" placeholder="Contoh: Pak Slamet" required type="text" />
                    </div>
                    <div>
                        <label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-phone">Nomor WhatsApp Aktif *</label>
                        <input class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-phone" name="phone" placeholder="0812-xxxx-xxxx" required type="tel" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <div>
                        <label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-location">Kabupaten &amp; Desa *</label>
                        <input class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-location" name="location" placeholder="Contoh: Tuban, Jatim" required type="text" />
                    </div>
                    <div>
                        <label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-variety">Varietas Jagung yang Ditanam</label>
                        <input class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-variety" name="variety" placeholder="Contoh: VIL-Gold / Hibrida lokal" type="text" />
                    </div>
                </div>

                <div>
                    <label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-disease-type">Dugaan Penyakit / Hama</label>
                    <select class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-disease-type" name="disease_type">
                        <option value="bulai">Penyakit Bulai (Daun Garis Kuning / Klorosis)</option>
                        <option value="busuk-batang">Busuk Batang / Busuk Tongkol</option>
                        <option value="karat-daun">Karat Daun (Bintik Pustul Cokelat)</option>
                        <option value="ulat-grayak">Ulat Grayak FAW (Daun Pucuk Bolong)</option>
                        <option value="belum-tahu">Belum Tahu / Butuh Bantuan Diagnosa AI</option>
                    </select>
                </div>

                <div>
                    <label class="block font-label-md text-label-md font-bold text-on-surface mb-1" for="contact-notes">Keterangan Gejala &amp; Luas Petak Terdampak</label>
                    <textarea class="w-full px-space-md py-space-sm rounded-lg bg-surface-container-low text-on-surface placeholder:text-outline font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary shadow-sm" id="contact-notes" name="notes" placeholder="Ceritakan umur tanaman (HST), luas area yang terserang, serta riwayat obat/fungisida yang sudah pernah disemprot..." rows="3"></textarea>
                </div>

                <button class="w-full py-space-md px-space-lg rounded-lg bg-primary text-on-primary font-label-lg text-label-lg font-bold shadow-md hover:bg-primary-container transition-all flex items-center justify-center gap-space-xs" id="contact-submit-btn" type="submit">
                    <span>Kirim Permohonan Resep &amp; Konsultasi</span>
                    <span class="material-symbols-outlined text-[18px]">send</span>
                </button>

                <div class="hidden p-space-sm rounded-lg bg-primary-fixed text-on-primary-fixed font-label-md text-label-md text-center" id="contact-success-msg">
                    ✓ Permohonan terkirim! Tim Agronomis VILAGRO segera memverifikasi data dan menghubungi WhatsApp Anda.
                </div>
            </form>
        </div>

    </div>
</section>