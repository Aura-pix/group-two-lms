/**
 * Basic client-side form validation
 * -----------------------------------
 * Attach the class "validate-form" to any <form> that should be
 * checked before submission. Add "required" attributes to fields
 * that must not be empty.
 *
 * This does NOT replace server-side PHP validation — it just gives
 * the user instant feedback before the page even submits.
 */

document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".validate-form");

    forms.forEach(function (form) {
        form.addEventListener("submit", function (e) {
            let isValid = true;

            // Clear old error messages
            form.querySelectorAll(".error").forEach(el => el.remove());

            // Check all required fields
            form.querySelectorAll("[required]").forEach(function (field) {
                if (!field.value.trim()) {
                    isValid = false;
                    showError(field, "This field is required.");
                }
            });

            // Basic email format check
            form.querySelectorAll('input[type="email"]').forEach(function (field) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (field.value.trim() && !emailPattern.test(field.value.trim())) {
                    isValid = false;
                    showError(field, "Enter a valid email address.");
                }
            });

            // Basic numeric check (e.g. total_copies)
            form.querySelectorAll('input[type="number"]').forEach(function (field) {
                if (field.value !== "" && Number(field.value) < 0) {
                    isValid = false;
                    showError(field, "Value cannot be negative.");
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    });

    function showError(field, message) {
        const error = document.createElement("div");
        error.className = "error";
        error.textContent = message;
        field.insertAdjacentElement("afterend", error);
    }
});