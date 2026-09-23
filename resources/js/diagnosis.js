/**
 * VILAGRO Agri-Vision AI — Interactive Diagnostic Script
 * Handles:
 *  - AI Scanner simulation (preset & file upload)
 *  - Scan animation pipeline
 *  - Disease database rendering
 *  - FAQ accordion
 *  - Contact form submission via Laravel AJAX
 */

(function () {
    "use strict";

    // ============================================================
    // 1. DATA MODEL — PRESET CORN DISEASES
    // ============================================================
    const DISEASE_DATABASE = {
        bulai: {
            name: "Penyakit Bulai Jagung",
            pathogen: "Peronosclerospora maydis / P. philippinensis",
            confidence: "98.4%",
            confidenceVal: 98.4,
            status: "Patogen Terdeteksi",
            statusColor: "bg-error text-on-error",
            image: "https://lh3.googleusercontent.com/aida-public/AB6AXuDyUzvEdLyELF2DFTr-kflCjKXxR9KIwCZLICS8itvZbW04jaJcJAYmqUtyQ1u3hcG49wypgAfpUhNWBOn2p__ih0f_Zc09ZoEj1X1ZhYwagGGLfWMx1d3-DkmbjHW-YxOAajI5PFZ0NWRokxZ7kjpcTxYdh-7Pgo6B87AiT0PkGTLuB0erlHlBLBhZHDKmIA2sTQA9Dq3mDz0a9-8dc2OyHhtnJUjyeBA8C4diwZzW05Y2De0jca9Z",
            symptoms:
                "Terdapat garis-garis klorotik kuning memanjang sejajar tulang daun. Daun mengalami kerdil, kaku, dan pada pagi hari bersuhu lembab tampak lapisan spora putih menyerupai tepung pada permukaan bawah daun.",
            treatments: [
                "<strong>Eradikasi Tanaman Terinfeksi:</strong> Cabut dan bakar tanaman bergejala sistemik parah agar konidia jamur tidak terbawa angin ke tanaman lain.",
                "<strong>Aplikasi Fungisida Sistemik:</strong> Semprot tanaman sekeliling menggunakan fungisida berbahan aktif <em>Metalaksil</em> atau <em>Dimetomorf</em> dosis 2-2.5 g/liter air.",
                "<strong>Pencegahan Musim Depan:</strong> Wajib gunakan benih bersertifikat tahan bulai seperti VIL-Gold 01 yang diberi perlakuan benih (seed-treatment).",
            ],
        },
        busuk: {
            name: "Penyakit Busuk Batang & Ruas",
            pathogen: "Fusarium verticillioides / Pythium aphanidermatum",
            confidence: "96.8%",
            confidenceVal: 96.8,
            status: "Patogen Terdeteksi",
            statusColor: "bg-error text-on-error",
            image: "https://lh3.googleusercontent.com/aida-public/AB6AXuCn5iYt3n31xYN1Uv6V5V8nnDc348cIo3MLt68IgSt5Xz47CCUNhJNuGoOJbNuzpoJyxTOEeZnaLJ1nBG_ertsTtJwg6ns6jf829s6wbKWJL3uCMr9Rolu_ULWq4kxMxEguAp3iV3bzttL7ofcJTWZM7zES2kak-Gx6rZ7_tumywQ2w6Q_RhHXLR7c2OxK21gyHkQMYqWs1tbJ5IHDptVNkxKw1rfc7_WKYlYaifcpfwbA6OrY_MWOC",
            symptoms:
                "Ruas batang 1–3 di atas permukaan tanah melunak, berubah warna kecokelatan kehitaman, empulur batang membusuk berongga, dan bau asam tercium saat batang dibelah.",
            treatments: [
                "<strong>Perbaikan Sanitasi & Drainase:</strong> Buat parit buangan air agar tanah tidak tergenang anaerob saat intensitas hujan tinggi.",
                "<strong>Aplikasi Agens Hayati:</strong> Kocor pangkal batang dengan suspensi jamur antagonis <em>Trichoderma harzianum</em> dosis 100 gram/tangki.",
                "<strong>Kurangi Nitrogen Berlebih:</strong> Seimbangkan pupuk N dengan unsur Kalium (KCl) untuk memperkuat dinding sel selulosa batang.",
            ],
        },
        karat: {
            name: "Penyakit Karat Daun Jagung",
            pathogen: "Puccinia sorghi Schwein",
            confidence: "97.2%",
            confidenceVal: 97.2,
            status: "Patogen Terdeteksi",
            statusColor: "bg-secondary text-on-secondary",
            image: "https://lh3.googleusercontent.com/aida-public/AB6AXuA7SUaVO5DkzUlHSQUf5rFLOZ4q7cTVIdy7FGBiiOwd19l2EMJpVJPbfoCirz7murwLZC2Fz8NuVF0pF0Uf3lDrqmfS8H9bS5O1GbRNLocNsf4AuGD9F7pMg0dhwc2wqF5jxIiDmulHkVmeKrvN5nfNEJ9ucG4_KixlC0sKEstmbW5nWwYKIh17Q1icBjvj4qFXAb1h3864h5CslI7vHSzw0h5D1TpoX1SekKATTSKnUjHR-gRPbxhF",
            symptoms:
                "Muncul bercak-bercak lepuh (pustul) kecil berbentuk bulat lonjong berwarna cokelat kemerahan atau cokelat tua di permukaan atas dan bawah helaian daun.",
            treatments: [
                "<strong>Semprot Fungisida Protektif-Kuratif:</strong> Semprotkan bahan aktif <em>Azoksistrobin</em> + <em>Difenokonazol</em> dosis 1.5 ml/liter air secara merata.",
                "<strong>Waktu Penyemprotan:</strong> Semprot pada pagi hari pukul 06.30–09.00 saat stomata terbuka dan angin tenang.",
                "<strong>Sanitasi Gulma:</strong> Bersihkan gulma rerumputan di sekitar pematang yang menjadi inang perantara urediospora.",
            ],
        },
        ulat: {
            name: "Serangan Ulat Grayak Jagung (FAW)",
            pathogen: "Spodoptera frugiperda (Lepidoptera: Noctuidae)",
            confidence: "99.1%",
            confidenceVal: 99.1,
            status: "Hama Kritis Aktif",
            statusColor: "bg-error text-on-error",
            image: "https://lh3.googleusercontent.com/aida-public/AB6AXuDoDrtX1133LbY1YD3ukd9U2GYlo_rcGoa-rBQp4Ty-QTzDLD5h_5nQnqCMM4rZI7q0hreyuUV-uXelZ0YchOh5Q3CVT776LG8qtIqkt9wPkjF9Xbh2IC1cydOlGnMn04cwRbWyLenAFCnjx8P5VntotuPK61Bl3UPgw7F0iDuCqLPYjQ1701J0DM3itBIBx5fykpJfqYtkEP3pJ-JuUL484ltmtEA_dkhMCwSYtUtVMH68rVKpHtia",
            symptoms:
                "Daun muda di pucuk tanaman robek bergerigi dan tampak transparan seperti jendela. Terdapat tumpukan serbuk kotoran menyerupai serbuk gergaji di dalam corong daun tempat ulat bersembunyi.",
            treatments: [
                "<strong>Aplikasi Insektisida Spesifik:</strong> Semprotkan insektisida berbahan aktif <em>Emamektin Benzoat</em> atau <em>Klorantraniliprol</em> tepat mengarah ke dalam titik tumbuh pucuk.",
                "<strong>Pemasangan Perangkap Feromon:</strong> Pasang 8-10 unit perangkap feromon seksual per hektar untuk menangkap ngengat jantan dewasa.",
                "<strong>Waktu Tindakan:</strong> Lakukan penyemprotan sore hari menjelang magrib saat larva mulai keluar dari celah corong daun untuk makan.",
            ],
        },
    };

    // ============================================================
    // 2. DOM REFERENCES
    // ============================================================
    const fileInput = document.getElementById("corn-image-input");
    const uploadPrompt = document.getElementById("upload-prompt");
    const previewWrapper = document.getElementById("image-preview-wrapper");
    const previewImg = document.getElementById("image-preview");
    const previewFilename = document.getElementById("preview-filename");
    const btnReupload = document.getElementById("btn-reupload");
    const laserBeam = document.getElementById("scan-laser");
    const scanStatus = document.getElementById("scanning-status");
    const scanProgressText = document.getElementById("scan-progress-text");

    const diseaseNameEl = document.getElementById("result-disease-name");
    const pathogenLatinEl = document.getElementById("result-pathogen-latin");
    const statusBadgeEl = document.getElementById("result-status-badge");
    const confidenceTextEl = document.getElementById("result-confidence-text");
    const confidenceBarEl = document.getElementById("result-confidence-bar");
    const symptomsEl = document.getElementById("result-symptoms");
    const treatmentEl = document.getElementById("result-treatment");

    // ============================================================
    // 3. SCAN ANIMATION & RENDER PIPELINE
    // ============================================================
    function runDiagnosticScan(
        diseaseData,
        customImageSrc = null,
        customFileName = null,
    ) {
        uploadPrompt.classList.add("hidden");
        previewWrapper.classList.remove("hidden");
        previewImg.src = customImageSrc || diseaseData.image;
        previewFilename.textContent =
            customFileName ||
            diseaseData.name.replace(/\s+/g, "-").toLowerCase() + ".jpg";

        laserBeam.classList.remove("hidden");
        scanStatus.classList.remove("hidden");
        scanProgressText.textContent = "Memindai Morfologi Daun...";

        const steps = [
            "Mendeteksi pola klorosis daun...",
            "Mengisolasi kontur tekstur bercak...",
            "Memverifikasi neural network patogen...",
            "Menyusun SOP resep penanganan...",
        ];

        let stepIndex = 0;
        const interval = setInterval(function () {
            if (stepIndex < steps.length) {
                scanProgressText.textContent = steps[stepIndex];
                stepIndex++;
            }
        }, 350);

        setTimeout(function () {
            clearInterval(interval);
            laserBeam.classList.add("hidden");
            scanStatus.classList.add("hidden");

            diseaseNameEl.textContent = diseaseData.name;
            pathogenLatinEl.textContent = diseaseData.pathogen;
            statusBadgeEl.textContent = diseaseData.status;
            statusBadgeEl.className =
                "px-space-sm py-0.5 rounded-full font-label-sm text-label-sm font-bold " +
                diseaseData.statusColor;
            confidenceTextEl.textContent = diseaseData.confidence;
            confidenceBarEl.style.width = diseaseData.confidenceVal + "%";
            symptomsEl.innerHTML = diseaseData.symptoms;

            let treatmentHtml = "";
            diseaseData.treatments.forEach(function (t) {
                treatmentHtml += `
          <div class="flex items-start gap-2">
            <span class="material-symbols-outlined text-[16px] text-secondary-fixed shrink-0">check_circle</span>
            <span>${t}</span>
          </div>
        `;
            });
            treatmentEl.innerHTML = treatmentHtml;
        }, 1500);
    }

    // ============================================================
    // 4. PRESET BUTTON HANDLERS
    // ============================================================
    const presetBtns = document.querySelectorAll(".preset-btn");
    presetBtns.forEach(function (btn) {
        btn.addEventListener("click", function () {
            const presetKey = btn.getAttribute("data-preset");
            const data = DISEASE_DATABASE[presetKey];
            if (!data) return;

            const scannerSec = document.getElementById("ai-scanner");
            if (scannerSec && window.innerWidth < 768) {
                scannerSec.scrollIntoView({ behavior: "smooth" });
            }
            runDiagnosticScan(data);
        });
    });

    // Global handler for Section 3 (Encyclopedia) buttons
    window.triggerPresetDiagnosis = function (key) {
        const data = DISEASE_DATABASE[key];
        const scannerSec = document.getElementById("ai-scanner");

        if (scannerSec) {
            scannerSec.scrollIntoView({ behavior: "smooth" });
        }
        if (data) {
            setTimeout(function () {
                runDiagnosticScan(data);
            }, 300);
        }
    };

    // ============================================================
    // 5. FILE UPLOAD HANDLER
    // ============================================================
    if (fileInput) {
        fileInput.addEventListener("change", function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (event) {
                const keys = ["bulai", "busuk", "karat", "ulat"];
                const randomKey = keys[Math.floor(Math.random() * keys.length)];
                const detectedData = Object.assign(
                    {},
                    DISEASE_DATABASE[randomKey],
                );

                runDiagnosticScan(detectedData, event.target.result, file.name);
            };
            reader.readAsDataURL(file);
        });
    }

    if (btnReupload) {
        btnReupload.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            fileInput.value = "";
            previewWrapper.classList.add("hidden");
            uploadPrompt.classList.remove("hidden");
        });
    }

    // ============================================================
    // 6. PDF DOWNLOAD SIMULATION
    // ============================================================
    const saveReportBtn = document.getElementById("btn-save-report");
    if (saveReportBtn) {
        saveReportBtn.addEventListener("click", function () {
            alert(
                "Laporan diagnosa AI (" +
                    diseaseNameEl.textContent +
                    ") berhasil dibuat! Mencetak lembar rekomendasi penyemprotan...",
            );
        });
    }

    // ============================================================
    // 7. FAQ ACCORDION LOGIC
    // ============================================================
    const faqItems = document.querySelectorAll(".faq-item");
    faqItems.forEach(function (item) {
        const toggle = item.querySelector(".faq-toggle");
        const content = item.querySelector(".faq-content");
        const icon = item.querySelector(".faq-icon");

        toggle.addEventListener("click", function () {
            const isHidden = content.classList.contains("hidden");

            faqItems.forEach(function (other) {
                other.querySelector(".faq-content").classList.add("hidden");
                other.querySelector(".faq-icon").style.transform =
                    "rotate(0deg)";
            });

            if (isHidden) {
                content.classList.remove("hidden");
                icon.style.transform = "rotate(180deg)";
            }
        });
    });

    // ============================================================
    // 8. CONTACT FORM SUBMISSION (Laravel AJAX)
    // ============================================================
    const contactForm = document.getElementById("contact-form");
    if (contactForm) {
        contactForm.addEventListener("submit", async function (e) {
            e.preventDefault();

            const submitBtn = document.getElementById("contact-submit-btn");
            const msgBox = document.getElementById("contact-success-msg");
            const formData = new FormData(contactForm);
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]',
            ).content;

            submitBtn.disabled = true;
            submitBtn.classList.add("opacity-70");
            submitBtn.innerHTML = "<span>Mengirimkan Data Lapangan...</span>";

            try {
                const response = await fetch(contactForm.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        Accept: "application/json",
                    },
                    body: formData,
                });

                const data = await response.json();

                if (response.ok) {
                    contactForm.reset();
                    submitBtn.classList.add("hidden");
                    msgBox.textContent = "✓ " + data.message;
                    msgBox.classList.remove("hidden");
                } else {
                    let errorMsg = "Validasi gagal:\n";
                    if (data.errors) {
                        Object.values(data.errors).forEach(function (errs) {
                            errorMsg += "- " + errs.join("\n- ") + "\n";
                        });
                    }
                    alert(errorMsg);
                    submitBtn.disabled = false;
                    submitBtn.classList.remove("opacity-70");
                    submitBtn.innerHTML =
                        '<span>Kirim Permohonan Resep & Konsultasi</span><span class="material-symbols-outlined text-[18px]">send</span>';
                }
            } catch (err) {
                console.error(err);
                alert("Terjadi kesalahan jaringan. Coba lagi.");
                submitBtn.disabled = false;
                submitBtn.classList.remove("opacity-70");
                submitBtn.innerHTML =
                    "<span>Kirim Permohonan Resep & Konsultasi</span>";
            }
        });
    }
})();
