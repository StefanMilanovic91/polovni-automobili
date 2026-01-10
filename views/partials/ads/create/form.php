<form method="POST" action="/ads/create" enctype="multipart/form-data">

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="brand-selector" class="form-label">Marka</label>
            <select id="brand-selector" name="brand_id" class="form-select" required>
                <option value="">Izaberite marku</option>
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
                <option value="">Izaberite model</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Cena (EUR)</label>
        <input
                type="number"
                name="price"
                class="form-control"
                placeholder="10500"
                required
        >
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="year-selector" class="form-label">Godište</label>
            <select id="year-selector" name="year" class="form-select" required>
                <option value="">Izaberite godinu</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Kilometraža (km)</label>
            <input
                    type="number"
                    name="mileage"
                    class="form-control"
                    placeholder="180000"
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
                placeholder="Grad / Mesto"
                required
        >
    </div>

    <div class="mb-4">
        <label class="form-label">Kratak opis</label>
        <textarea
                name="description"
                class="form-control"
                rows="4"
                placeholder="Stanje, boja, tip motora, oprema..."
                required
        ></textarea>
    </div>

    <div class="mb-4">
        <label class="form-label">
            Slike vozila
        </label>
        <input
                type="file"
                name="images[]"
                class="form-control"
                accept="image/*"
                multiple
                required
        >
        <span class="form-text">Dozvoljeni formati: JPG i PNG</span>
    </div>

    <div id="errorMessageBox" style="font-size: 14px; display:none;" class="alert alert-danger">
        <p class="mb-1 fw-bold" style="color:red;">Greška prilikom validacije.</p>
        <p class="mb-0" style="color:gray;"><strong>Marka</strong> - obavezno izaberite marku</p>
        <p class="mb-0" style="color:gray;"><strong>Model</strong> - obavezno izaberite model</p>
        <p class="mb-0" style="color:gray;"><strong>Cena</strong> - obavezno upisite cenu</p>
        <p class="mb-0" style="color:gray;"><strong>Godište</strong> - obavezno upisite godište</p>
        <p class="mb-0" style="color:gray;"><strong>Kilometraža</strong> - obavezno upisite kilometražu</p>
        <p class="mb-0" style="color:gray;"><strong>Lokacija</strong> - obavezno upisite lokaciju</p>
        <p class="mb-0" style="color:gray;"><strong>Kratak opis</strong> - obavezno dodajte kratak opis</p>
        <p class="mb-0" style="color:gray;"><strong>Slike vozila</strong> - minimum jedna a maksimum tri slike</p>
    </div>

    <button type="submit" class="btn btn-success btn-lg w-100">
        Postavi oglas
    </button>
</form>
