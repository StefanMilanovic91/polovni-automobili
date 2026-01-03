window.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const dialogParam = params.get('dialog');
    const hasValidationError = params.get('hasValidationError') === 'true';

    if (dialogParam === 'register' || dialogParam === 'login') {
        const dialog = document.getElementById(`${dialogParam}Dialog`);


        if (dialog) {
            dialog.showModal();

            if (hasValidationError) {
                const errorMessageBox = dialog.querySelector('#errorMessageBox');

                errorMessageBox.style.display = 'block';
            }

            dialog.onclose = function () {
                const url = window.location.origin + window.location.pathname;
                window.history.replaceState(null, null, url);
            }
        }
    }
});