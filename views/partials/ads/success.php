<div class="alert alert-success display-6 mb-0 text-center py-5 d-flex flex-column align-items-center">
    <span>
        <?php
        if (getPath() === '/ads/create') {
            echo "Uspešno postavljen oglas";
        } else if(getPath() === '/ads/edit') {
            echo "Uspešno izmenjen oglas";
        }
        ?>
    </span>
    <svg height="220px" width="220px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 600">
        <path fill="#008000"
              d="M530.8 134.1C545.1 144.5 548.3 164.5 537.9 178.8L281.9 530.8C276.4 538.4 267.9 543.1 258.5 543.9C249.1 544.7 240 541.2 233.4 534.6L105.4 406.6C92.9 394.1 92.9 373.8 105.4 361.3C117.9 348.8 138.2 348.8 150.7 361.3L252.2 462.8L486.2 141.1C496.6 126.8 516.6 123.6 530.9 134z"/>
    </svg>
    <div class="pt-5">
        <a href="/ads/show?id=<?= $_SESSION['ad_id']; ?>" class="btn btn-success">
            Pogledaj oglas
        </a>
        <a href="/ads/create" class="btn btn-success">
            Postavi oglas
        </a>
    </div>
</div>