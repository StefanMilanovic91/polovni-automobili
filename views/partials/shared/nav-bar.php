<nav class="navbar navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">LOGO</a>

        <div class="ms-auto d-flex gap-3">
            <?php if (isLoggedIn()): ?>

                <a href="/auth/logout" class="btn btn-info">
                    Izloguj se
                </a>

            <?php else: ?>
                <button class="btn btn-info" onclick="loginDialog.showModal()">
                    Uloguj se
                </button>
                <button class="btn btn-info" onclick="registerDialog.showModal()">
                    Registruj se
                </button>
            <?php endif; ?>
        </div>
    </div>
</nav>
