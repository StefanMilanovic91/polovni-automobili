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

                    <?php if (isset($_SESSION['ad_id']) && !empty($_SESSION['ad_id'])): ?>
                        <?php require base('views/partials/ads/create/success.php'); ?>
                    <?php unset($_SESSION['ad_id']); ?>
                    <?php else: ?>
                        <?php require base('views/partials/ads/create/form.php'); ?>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>

</div>

<?php require base('views/partials/shared/footer.php'); ?>


</body>
</html>
