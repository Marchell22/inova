$(document).ready(function () {
    // Form validation
    $('#register-form').on('submit', function (e) {
        let isValid = true;

        // Validate fullname
        const fullname = $('#signupform-fullname').val().trim();
        if (fullname === '') {
            showError('#signupform-fullname', 'Nama lengkap tidak boleh kosong');
            isValid = false;
        } else if (fullname.length < 2) {
            showError('#signupform-fullname', 'Nama lengkap minimal 2 karakter');
            isValid = false;
        } else {
            removeError('#signupform-fullname');
        }

        // Validate email
        const email = $('#signupform-email').val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            showError('#signupform-email', 'Email tidak boleh kosong');
            isValid = false;
        } else if (!emailRegex.test(email)) {
            showError('#signupform-email', 'Email tidak valid');
            isValid = false;
        } else {
            removeError('#signupform-email');
        }

        // Validate username
        const username = $('#signupform-username').val().trim();
        if (username === '') {
            showError('#signupform-username', 'Username tidak boleh kosong');
            isValid = false;
        } else if (username.length < 2) {
            showError('#signupform-username', 'Username minimal 2 karakter');
            isValid = false;
        } else {
            removeError('#signupform-username');
        }

        // Validate password
        const password = $('#signupform-password').val();
        if (password === '') {
            showError('#signupform-password', 'Password tidak boleh kosong');
            isValid = false;
        } else if (password.length < 6) {
            showError('#signupform-password', 'Password minimal 6 karakter');
            isValid = false;
        } else {
            removeError('#signupform-password');
        }

        // Validate confirm password
        const confirmPassword = $('#signupform-confirmpassword').val();
        if (confirmPassword === '') {
            showError('#signupform-confirmpassword', 'Konfirmasi password tidak boleh kosong');
            isValid = false;
        } else if (confirmPassword !== password) {
            showError('#signupform-confirmpassword', 'Password tidak cocok');
            isValid = false;
        } else {
            removeError('#signupform-confirmpassword');
        }

        // Validate terms
        if (!$('#signupform-terms').is(':checked')) {
            showError('#signupform-terms', 'Anda harus menyetujui syarat dan ketentuan');
            isValid = false;
        } else {
            removeError('#signupform-terms');
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