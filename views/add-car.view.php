<!DOCTYPE html>
<html lang="sr">

<?php require base('views/partials/shared/head.php'); ?>

<body>

<?php require base('views/partials/shared/nav-bar.php'); ?>

<div class="container my-5">

    <h2 class="text-center fw-bold mb-5">Postavi Oglas</h2>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">

                    <form method="POST" action="/add-car" enctype="multipart/form-data">

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
                                <span class="text-muted">(max 3)</span>
                            </label>

                            <input
                                    type="file"
                                    name="images[]"
                                    class="form-control"
                                    accept="image/*"
                                    multiple
                                    required
                            >

                            <span class="form-text">
                                Dozvoljeni formati: JPG i PNG
                            </span>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100">
                            Postavi oglas
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<?php require base('views/partials/shared/footer.php'); ?>


</body>
</html>
