<!DOCTYPE html>
<html lang="sr">

<?php require base('views/partials/shared/head.php'); ?>

<body style="min-height: 100vh;">

<?php require base('views/partials/shared/nav-bar.php'); ?>

<div class="container h-100 d-flex flex-column align-items-center justify-content-center">
    <h1 class="display-1 fw-bold text-secondary mb-3">404</h1>
    <h3 class="fw-semibold mb-3">
        Stranica nije pronađena
    </h3>
    <p class="text-muted mb-4">
        Stranica koju tražite ne postoji ili je uklonjena.
    </p>
    <a href="/" class="btn btn-info btn-lg">
        Početna
    </a>
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
