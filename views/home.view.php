<!DOCTYPE html>
<html lang="sr">

<?php require base('views/partials/shared/head.php'); ?>

<body>

<?php require base('views/partials/shared/nav-bar.php'); ?>

<div class="container my-5">

    <h2 class="text-center fw-bold mb-5">POLOVNI AUTOMOBILI</h2>

    <?php require base('views/partials/home/search-bar.php'); ?>

    <div class="d-flex flex-column gap-3 col-12 col-md-8 mx-auto">
        <?php foreach ($ads as $ad): ?>
            <a href="/ads/show?id=<?= $ad->id ?>" class="text-decoration-none">
                <div class="car-card p-3 d-flex gap-3 text-dark">
                    <div style="width: 160px;">
                        <div class="ratio ratio-4x3 border rounded overflow-hidden">
                            <img
                                    src="/<?= $ad->thumbnail ?>"
                                    alt="Slika oglasa"
                                    class="img-fluid object-fit-cover"
                            >
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="car-title"><?= $ad->brand . ' ' . $ad->model ?></div>
                        <div class="text-success fw-semibold"><?= $ad->price ?>€</div>
                        <div class="text-muted small"><?= $ad->year . ' | ' . $ad->mileage . ' | ' . $ad->location ?></div>
                        <div class="small mt-1"><?= $ad->description ?></div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled"><a class="page-link">‹</a></li>
            <li class="page-item disabled"><a class="page-link">1</a></li>
            <li class="page-item disabled"><a class="page-link">2</a></li>
            <li class="page-item disabled"><a class="page-link">3</a></li>
            <li class="page-item disabled"><a class="page-link">›</a></li>
        </ul>
    </nav>

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
