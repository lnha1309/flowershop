document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('login-form');
    if (!form) {
        return;
    }

    const emailInput = document.getElementById('emailInput');
    const passwordInput = document.getElementById('passwordInput');
    const error1 = document.querySelector('.error1');
    const error2 = document.querySelector('.error2');
    const error3 = document.querySelector('.error3');

    const hideErrors = () => {
        [error1, error2, error3].forEach(err => err && err.classList.add('d-none'));
    };

    hideErrors();

    form.addEventListener('submit', (e) => {
        hideErrors();

        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();
        const validEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // simple general validation
        const validPassword = /^.{6,}$/; // at least 6 characters

        let hasError = false;

        if (!validEmail.test(email) && error1) {
            error1.classList.remove('d-none');
            hasError = true;
        }
        if (!validPassword.test(password) && error2) {
            error2.classList.remove('d-none');
            hasError = true;
        }
        if (!validEmail.test(email) && !validPassword.test(password) && error3) {
            error3.classList.remove('d-none');
        }

        if (hasError) {
            e.preventDefault();
        }
    });
});
