<?php
$is_successful_update = !empty($_SESSION['ad_id']);
?>

<!DOCTYPE html>
<html lang="sr">

<?php require base('views/partials/shared/head.php'); ?>

<body>

<?php require base('views/partials/shared/nav-bar.php'); ?>

<div class="container my-5">

    <?= $is_successful_update ? '' : "<h2 id='ad-update-title' class='edit-title'>Izmeni Oglas</h2>" ?>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <div id="ad-card" class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <?php
                    if ($is_successful_update) {
                        require base('views/partials/ads/success.php');
                        unset($_SESSION['ad_id']);
                    } else {
                        require base('views/partials/ads/edit/form.php');
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
