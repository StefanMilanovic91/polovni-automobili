<!DOCTYPE html>
<html lang="sr">

<?php require base('views/partials/shared/head.php'); ?>

<body>

<?php require base('views/partials/shared/nav-bar.php'); ?>

<div class="container my-5">

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <?php if (isLoggedIn() && $ad->user_id === $_SESSION['user']['id']): ?>
                <a href="/ads/edit?id=<?= $ad->id ?>"
                   class="btn btn-secondary mb-3">
                    Izmeni
                </a>
                <button id="remove-ad-btn" data-ad-id="<?= $ad->id ?>" class="btn btn-danger mb-3">
                    Obriši
                </button>
            <?php endif; ?>
            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">

                    <div class="row g-4">
                        <div class="col-12 col-md-7">

                            <h3 class="fw-bold mb-2">
                                <?= $ad->brand ?> <?= $ad->model ?>
                            </h3>

                            <p class="text-muted mb-4">
                                <?= $ad->location ?>
                            </p>

                            <div class="row mb-4">
                                <div class="col-6 mb-2">
                                    <strong>Godište:</strong><br>
                                    <?= $ad->year ?>
                                </div>
                                <div class="col-6 mb-2">
                                    <strong>Kilometraža:</strong><br>
                                    <?= $ad->mileage ?> km
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold">Opis</h6>
                                <p class="mb-0">
                                    <?= $ad->description ?>
                                </p>
                            </div>

                        </div>

                        <div class="col-12 col-md-5">

                            <div class="border rounded p-3 mb-4 bg-light">
                                <div class="fs-4 fw-bold text-success">
                                    <?= $ad->price ?>€
                                </div>
                                <div class="text-muted small">
                                    Cena
                                </div>
                            </div>

                            <div class="border rounded p-3">
                                <h6 class="fw-bold mb-2">Prodavac</h6>

                                <div class="mb-1">
                                    <?= $ad->owner ?>
                                </div>

                                <div class="text-muted small">
                                    Lokacija: <?= $ad->location ?>
                                </div>
                            </div>

                        </div>

                    </div>
                    <?php if (count($images) > 0): ?>
                        <hr class="my-4">
                        <h5 class="fw-bold mb-3">Galerija</h5>

                        <div class="row g-3">
                            <?php foreach ($images as $img): ?>
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="ratio ratio-4x3 border rounded overflow-hidden">
                                        <img
                                                src="/<?= $img->path ?>"
                                                alt="Slika oglasa"
                                                class="img-fluid object-fit-cover"
                                        >
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

</div>

<?php require base('views/partials/shared/footer.php'); ?>

<?php
if (!isLoggedIn()) {
    require base('views/partials/shared/dialogs/register.php');
    require base('views/partials/shared/dialogs/login.php');
}
?>

</body>
</html>

