const scanForm = document.getElementById("corn-detection-form");
const imageInput = document.getElementById("corn-image-input");
const uploadPrompt = document.getElementById("upload-prompt");
const previewWrapper = document.getElementById("image-preview-wrapper");
const previewImage = document.getElementById("image-preview");
const previewFilename = document.getElementById("preview-filename");
const reuploadButton = document.getElementById("btn-reupload");
const scanningStatus = document.getElementById("scanning-status");
const scanSubmitButton = document.getElementById("scan-submit-button");

function showImagePreview(file) {
    if (!file || !previewImage || !previewWrapper || !uploadPrompt) {
        return;
    }

    const reader = new FileReader();
    reader.addEventListener("load", () => {
        previewImage.src = String(reader.result);
        previewWrapper.classList.remove("hidden");
        uploadPrompt.classList.add("hidden");

        if (previewFilename) {
            previewFilename.textContent = file.name;
        }

        reuploadButton?.classList.remove("hidden");
    });
    reader.addEventListener("error", () => {
        window.alert("Foto tidak dapat dibaca. Silakan pilih file gambar lain.");
    });
    reader.readAsDataURL(file);
}

if (imageInput) {
    imageInput.addEventListener("change", () => {
        showImagePreview(imageInput.files?.[0]);
    });
}

reuploadButton?.addEventListener("click", () => {
    if (!imageInput || !previewImage || !previewWrapper || !uploadPrompt) {
        return;
    }

    imageInput.value = "";
    previewImage.src = "";
    previewWrapper.classList.add("hidden");
    uploadPrompt.classList.remove("hidden");
    reuploadButton.classList.add("hidden");
});

if (scanForm) {
    scanForm.addEventListener("submit", (event) => {
        if (!imageInput?.files?.length) {
            event.preventDefault();
            imageInput?.reportValidity();
            return;
        }

        if (scanningStatus) {
            scanningStatus.classList.remove("hidden");
            scanningStatus.classList.add("flex");
        }

        if (scanSubmitButton) {
            scanSubmitButton.disabled = true;
            scanSubmitButton.setAttribute("aria-disabled", "true");
        }
    });
}

window.triggerPresetDiagnosis = function () {
    const scanner = document.getElementById("ai-scanner");

    scanner?.scrollIntoView({ behavior: "smooth", block: "start" });
    imageInput?.focus({ preventScroll: true });
};

document.querySelectorAll(".faq-item").forEach((item) => {
    const toggle = item.querySelector(".faq-toggle");
    const content = item.querySelector(".faq-content");
    const icon = item.querySelector(".faq-icon");

    if (!toggle || !content || !icon) {
        return;
    }

    toggle.addEventListener("click", () => {
        const isHidden = content.classList.contains("hidden");

        document.querySelectorAll(".faq-item").forEach((other) => {
            other.querySelector(".faq-content")?.classList.add("hidden");
            const otherIcon = other.querySelector(".faq-icon");
            if (otherIcon) {
                otherIcon.style.transform = "rotate(0deg)";
            }
        });

        if (isHidden) {
            content.classList.remove("hidden");
            icon.style.transform = "rotate(180deg)";
        }
    });
});

const contactForm = document.getElementById("contact-form");

if (contactForm) {
    contactForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        const submitButton = document.getElementById("contact-submit-btn");
        const messageBox = document.getElementById("contact-success-msg");
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        if (!submitButton || !messageBox || !csrfToken) {
            return;
        }

        submitButton.disabled = true;
        submitButton.classList.add("opacity-70");

        try {
            const response = await fetch(contactForm.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
                body: new FormData(contactForm),
            });
            const data = await response.json();

            if (!response.ok) {
                const errors = Object.values(data.errors ?? {})
                    .flat()
                    .join("\n");
                throw new Error(errors || "Permintaan tidak dapat dikirim.");
            }

            contactForm.reset();
            submitButton.classList.add("hidden");
            messageBox.textContent = `✓ ${data.message}`;
            messageBox.classList.remove("hidden");
        } catch (error) {
            console.error(error);
            window.alert(
                error instanceof Error
                    ? error.message
                    : "Terjadi kesalahan jaringan. Coba lagi.",
            );
            submitButton.disabled = false;
            submitButton.classList.remove("opacity-70");
        }
    });
}
