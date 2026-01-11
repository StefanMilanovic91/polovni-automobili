<form class="row g-2 justify-content-center mb-4" id="search-bar-form">
    <div class="col-md-2">
        <select id="brand-selector" name="brand_id" class="form-select">
            <option value="">Marka</option>
            <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand->id; ?>">
                    <?= $brand->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <select id="model-selector" name="model_id" class="form-select" disabled>
            <option value="">Model</option>
        </select>
    </div>
    <div class="col-md-2">
        <input
                type="number"
                name="price_from"
                class="form-select"
                placeholder="Cena od (EUR)"
        >
    </div>
    <div class="col-md-2">
        <input
                type="number"
                name="price_to"
                class="form-select"
                placeholder="Cena do (EUR)"
        >
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-info w-100">Pretraži</button>
    </div>
</form>
