handleDialogs();
handleBrandAndModelSelectors(); // TODO: This is necessary only on the /ads page. Include it only there.
handleYearSelector(); // TODO: This is necessary only on the /ads page. Include it only there.

function handleDialogs() {
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
}

function handleBrandAndModelSelectors() {
    const brandSelector = document.querySelector('#brand-selector');
    const modelSelector = document.querySelector('#model-selector');

    if (!brandSelector || !modelSelector) return;

    brandSelector.addEventListener('change', function (e) {
        const brandId = this.value;

        if (!brandId) {
            modelSelector.innerHTML = '<option value="">Izaberite model</option>';

            return;
        }

        function displayModels(models) {
            if (!models?.length) return;

            modelSelector.removeAttribute('disabled');

            let options = '<option value="">Izaberite model</option>';

            models.forEach(function (model) {
                options += '<option value="' + model.id + '">' + model.name + '</option>';
            });

            modelSelector.innerHTML = options;
        }

        fetch(`/get-models?brand_id=${brandId}`)
            .then(response => response?.json?.())
            .then(displayModels);

    });
}

function handleYearSelector() {
    const selector = document.querySelector('#year-selector');

    if (!selector) return;

    const startYear = 1900;
    const endYear = 2026;

    for (let i = endYear; i >= startYear; i--) {
        const option = document.createElement('option');

        option.value = String(i);
        option.textContent = String(i);

        selector.appendChild(option);
    }
}