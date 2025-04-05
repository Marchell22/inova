$(document).ready(function () {
    // Form validation
    $('#login-form').on('submit', function (e) {
        let isValid = true;

        // Validate username
        const username = $('#loginform-username').val().trim();
        if (username === '') {
            showError('#loginform-username', 'Username tidak boleh kosong');
            isValid = false;
        } else {
            removeError('#loginform-username');
        }

        // Validate password
        const password = $('#loginform-password').val();
        if (password === '') {
            showError('#loginform-password', 'Password tidak boleh kosong');
            isValid = false;
        } else {
            removeError('#loginform-password');
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Helper functions
    function showError(selector, message) {
        const $field = $(selector);
        const $parent = $field.closest('.form-group');

        // Add error class to form-group and field
        $parent.addClass('has-error');
        $field.addClass('is-invalid');

        // If error container doesn't exist, create it
        if ($parent.find('.invalid-feedback').length === 0) {
            $field.after('<div class="invalid-feedback">' + message + '</div>');
        } else {
            $parent.find('.invalid-feedback').text(message);
        }
    }

    function removeError(selector) {
        const $field = $(selector);
        const $parent = $field.closest('.form-group');

        $parent.removeClass('has-error');
        $field.removeClass('is-invalid');
        $parent.find('.invalid-feedback').remove();
    }
});