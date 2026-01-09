<!DOCTYPE html>
<html lang="sr">

<?php require base('views/partials/shared/head.php'); ?>

<body>

<?php require base('views/partials/shared/nav-bar.php'); ?>

<div class="container my-5">

    <?= empty($_SESSION['ad_id']) ? "<h2 class='text-center fw-bold mb-5'>Izmeni Oglas</h2>" : '' ?>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <?php
                    if (empty($_SESSION['ad_id'])) {
                        require base('views/partials/ads/edit/form.php');
                        // TODO: Premesti ovaj btn u edit/form.php.
                        echo "
                            <button
                                type='button'
                                data-ad-id=\"$ad->id\"
                                id='remove-ad-btn'
                                class='btn btn-danger btn-lg w-100 mt-3'>
                                    Obrisi oglas
                            </button>";
                    } else {
                        require base('views/partials/ads/success.php');
                        unset($_SESSION['ad_id']);
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>

</div>

<?php require base('views/partials/shared/footer.php'); ?>


</body>
</html>
