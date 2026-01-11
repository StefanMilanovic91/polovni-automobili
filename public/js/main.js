handleDialogs();
handleBrandAndModelSelectors(); // TODO: This is necessary only on the /ads page. Include it only there.
handleYearSelector(); // TODO: This is necessary only on the /ads page. Include it only there.
handleRemoveAd(); // TODO: This is necessary only on the /ads page. Include it only there.
handleCreateAdValidationError(); // TODO: This is necessary only on the /ads page. Include it only there.
sanitizeSearchQueryForm(); // TODO: This is necessary only on the / page. Include it only there.
populateSearchFormFromQuery(); // TODO: This is necessary only on the / page. Include it only there.

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
        const isAdsCreatePage = window.location.pathname === '/ads/create';

        if (!brandId) {
            modelSelector.innerHTML = `<option value="">${isAdsCreatePage ? 'Izaberite model' : 'Model'}</option>`;
            modelSelector.setAttribute('disabled', '');

            return;
        }

        function displayModels(models) {
            if (!models?.length) return;

            modelSelector.removeAttribute('disabled');

            let options = `<option value="">${isAdsCreatePage ? 'Izaberite model' : 'Model'}</option>`;

            models.forEach(function (model) {
                options += '<option value="' + model.id + '">' + model.name + '</option>';
            });

            modelSelector.innerHTML = options;
        }

        fetch(`/models?brand_id=${brandId}`)
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

function handleRemoveAd() {
    const removeButton = document.getElementById('remove-ad-btn');

    if (!removeButton) return;

    removeButton.addEventListener('click', async (e) => {
        const id = removeButton.dataset?.adId;

        if (!id) return;

        try {
            const result = await fetch('/ads/delete', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id})
            }).then(response => response.json());

            if (result?.success === true) {
                handleAdDeletedSuccessful();
            } else {
                // TODO: Handle error UI here.
            }
        } catch (error) {
            console.log(error);
        }
    });
}

function handleAdDeletedSuccessful() {
    const adCard = document.querySelector("#ad-card");
    const updateButtons = document.querySelector('#ad-update-buttons');
    const title = document.querySelector('#ad-update-title');

    if (!adCard) return;

    adCard.innerHTML = `<div class="alert alert-success display-6 mb-0 text-center py-5 d-flex flex-column align-items-center">
                            <span>
                                Oglas je uspešno obrisan
                            </span>
                            <svg height="220px" width="220px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 600">
                                <path fill="#008000"
                                      d="M530.8 134.1C545.1 144.5 548.3 164.5 537.9 178.8L281.9 530.8C276.4 538.4 267.9 543.1 258.5 543.9C249.1 544.7 240 541.2 233.4 534.6L105.4 406.6C92.9 394.1 92.9 373.8 105.4 361.3C117.9 348.8 138.2 348.8 150.7 361.3L252.2 462.8L486.2 141.1C496.6 126.8 516.6 123.6 530.9 134z"/>
                            </svg>
                            <div class="pt-5">
                                <a href="/" class="btn btn-success">
                                    Početna
                                </a>
                                <a href="/ads/create" class="btn btn-success">
                                    Postavi oglas
                                </a>
                            </div>
                        </div>`;

    if (updateButtons) {
        updateButtons.style.display = 'none';
    }

    if (title) {
        title.style.display = 'none';
    }
}

function handleCreateAdValidationError() {
    const isAdsCreatePage = window.location.pathname === '/ads/create';

    if (!isAdsCreatePage) return;

    const params = new URLSearchParams(window.location.search);
    const hasValidationError = params.get('hasValidationError') === 'true';

    if (hasValidationError) {
        const errorMessageBox = document.querySelector('#errorMessageBox');

        if (errorMessageBox) {
            errorMessageBox.style.display = 'block';
        }
    }
}

// TODO: Rethink how to refactor the following sanitizeSearchQueryForm func
// NOTE: Try to select them with querySelectorAll('[name="brand_id"], [name="model_id"], [name="price_from"], [name="price_to"]')
function sanitizeSearchQueryForm() {
    const form = document.querySelector('#search-bar-form');

    if (!form) return;

    const brand = form.querySelector("[name='brand_id']");
    const model = form.querySelector("[name='model_id']");
    const priceFrom = form.querySelector("[name='price_from']");
    const priceTo = form.querySelector("[name='price_to']");

    if (!brand || !model || !priceFrom || !priceTo) return;

    form.addEventListener('submit', function (e) {
        if (!brand.value && !model.value && !priceFrom.value && !priceTo.value) {
            e.preventDefault();
            return;
        }

        if (!brand.value) brand.setAttribute('disabled', '');
        if (!model.value) model.setAttribute('disabled', '');
        if (!priceFrom.value) priceFrom.setAttribute('disabled', '');
        if (!priceTo.value) priceTo.setAttribute('disabled', '');
    });
}

// TODO: Refactor the following shit
function populateSearchFormFromQuery() {
    const form = document.querySelector('#search-bar-form');

    if (!form) return;

    const params = new URLSearchParams(window.location.search);


    const inputs = form.querySelectorAll('[name="brand_id"], [name="price_from"], [name="price_to"]');

    inputs.forEach(input => {
        const name = input.name;
        if (!name) return;

        // If URL has this parameter, set it as the input value
        if (params.has(name)) {
            input.value = params.get(name);
        }
    });

    if (params.has('brand_id')) {
        const modelSelector = document.querySelector('#model-selector');

        function displayModels(models) {
            if (!models?.length) return;


            let options = `<option value="">Model</option>`;

            models.forEach(function (model) {
                options += `<option value="${model.id}">${model.name}</option>`;
            });

            modelSelector.innerHTML = options;
            modelSelector.removeAttribute('disabled');

            if (params.has('model_id')) {
                modelSelector.value = params.get('model_id');
            }
        }

        fetch(`/models?brand_id=${params.get('brand_id')}`)
            .then(response => response?.json?.())
            .then(displayModels);
    }
}