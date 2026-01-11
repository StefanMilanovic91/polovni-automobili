<form
        method="POST"
        action="<?= '/ads/edit?id=' . $ad->id ?>"
        enctype="multipart/form-data"
>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="brand-selector" class="form-label">Marka</label>
            <select id="brand-selector" name="brand_id" class="form-select" required>
                <option value="<?= $ad->brand_id ?>">
                    <?= $ad->brand ?>
                </option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?= $brand->id; ?>">
                        <?= $brand->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label for="model-selector" class="form-label">Model</label>
            <select id="model-selector" name="model_id" class="form-select" disabled required>
                <option value="<?= $ad->model_id ?>"><?= $ad->model ?></option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Cena (EUR)</label>
        <input
                type="number"
                name="price"
                class="form-control"
                value="<?= $ad->price ?>"
                required
        >
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="year-selector" class="form-label">Godište</label>
            <select id="year-selector" name="year" class="form-select" required>
                <option value="<?= $ad->year ?>"><?= $ad->year ?></option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Kilometraža (km)</label>
            <input
                    type="number"
                    name="mileage"
                    class="form-control"
                    value="<?= $ad->mileage ?>"
                    required
            >
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Lokacija</label>
        <input
                type="text"
                name="location"
                class="form-control"
                value="<?= $ad->location ?>"
                required
        >
    </div>

    <div class="mb-4">
        <label class="form-label">Kratak opis</label>
        <textarea
                name="description"
                class="form-control"
                rows="4"
                required
        ><?= $ad->description ?></textarea>
    </div>

    <!--TODO: Omoguci edit slika-->
    <!--    <div class="mb-4">-->
    <!--        <label class="form-label">-->
    <!--            Slike vozila-->
    <!--        </label>-->
    <!--        <input-->
    <!--                type="file"-->
    <!--                name="images[]"-->
    <!--                class="pe-none form-control"-->
    <!--                accept="image/*"-->
    <!--                multiple-->
    <!--        >-->
    <!--        <span class="form-text">Dozvoljeni formati: JPG i PNG</span>-->
    <!--    </div>-->

    <button type="submit" class="btn btn-success btn-lg w-100">
        Sačuvaj izmene
    </button>
    <button type="button"
            data-ad-id="<?= $ad->id ?>"
            id="remove-ad-btn"
            class="btn btn-danger btn-lg w-100 mt-3">
        Obriši oglas
    </button>
</form>
