<!DOCTYPE html>
<html lang="sr">

<?php require base('views/partials/shared/head.php'); ?>

<body>

<?php require base('views/partials/shared/nav-bar.php'); ?>

<div class="container my-5">

    <h2 class="text-center fw-bold mb-5">POLOVNI AUTOMOBILI</h2>

    <?php require base('views/partials/home/search-bar.php'); ?>

    <div class="d-flex flex-column gap-3 col-12 col-md-8 mx-auto">

        <div class="car-card p-3 d-flex gap-3">
            <div style="width: 160px;">
                <div class="car-image">IMAGE</div>
            </div>
            <div class="flex-grow-1">
                <div class="car-title">Naziv Automobila</div>
                <div class="text-primary fw-semibold">Cena</div>
                <div class="text-muted small">Godište | Km | Lokacija</div>
                <div class="small mt-1">Kratak opis</div>
            </div>
        </div>

        <div class="car-card p-3 d-flex gap-3">
            <div style="width: 160px;">
                <div class="car-image">IMAGE</div>
            </div>
            <div class="flex-grow-1">
                <div class="car-title">Naziv Automobila</div>
                <div class="text-primary fw-semibold">Cena</div>
                <div class="text-muted small">Godište | Km | Lokacija</div>
                <div class="small mt-1">Kratak opis</div>
            </div>
        </div>

        <div class="car-card p-3 d-flex gap-3">
            <div style="width: 160px;">
                <div class="car-image">IMAGE</div>
            </div>
            <div class="flex-grow-1">
                <div class="car-title">Naziv Automobila</div>
                <div class="text-primary fw-semibold">Cena</div>
                <div class="text-muted small">Godište | Km | Lokacija</div>
                <div class="small mt-1">Kratak opis</div>
            </div>
        </div>

        <div class="car-card p-3 d-flex gap-3">
            <div style="width: 160px;">
                <div class="car-image">IMAGE</div>
            </div>
            <div class="flex-grow-1">
                <div class="car-title">Naziv Automobila</div>
                <div class="text-primary fw-semibold">Cena</div>
                <div class="text-muted small">Godište | Km | Lokacija</div>
                <div class="small mt-1">Kratak opis</div>
            </div>
        </div>

        <div class="car-card p-3 d-flex gap-3">
            <div style="width: 160px;">
                <div class="car-image">IMAGE</div>
            </div>
            <div class="flex-grow-1">
                <div class="car-title">Naziv Automobila</div>
                <div class="text-primary fw-semibold">Cena</div>
                <div class="text-muted small">Godište | Km | Lokacija</div>
                <div class="small mt-1">Kratak opis</div>
            </div>
        </div>

    </div>

    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled"><a class="page-link">‹</a></li>
            <li class="page-item active"><a class="page-link">1</a></li>
            <li class="page-item"><a class="page-link">2</a></li>
            <li class="page-item"><a class="page-link">3</a></li>
            <li class="page-item"><a class="page-link">›</a></li>
        </ul>
    </nav>

</div>

<?php require base('views/partials/shared/footer.php'); ?>

<?php require base('views/partials/shared/dialogs/login.php'); ?>
<?php require base('views/partials/shared/dialogs/register.php'); ?>

</body>
</html>
