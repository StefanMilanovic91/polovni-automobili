<nav class="navbar navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">LOGO</a>

        <div class="ms-auto d-flex gap-3">
            <?php if (isLoggedIn()): ?>
                <a href="/" class="btn btn-info">
                    Početna
                </a>
                <a href="/ads/create" class="btn btn-info">
                    Postavi oglas
                </a>
                <a href="/auth/logout" class="btn btn-secondary">
                    Izloguj se
                </a>
            <?php else: ?>
                <a href="/" class="btn btn-info">
                    Početna
                </a>
                <button type="button" class="btn btn-info" onclick="loginDialog.showModal()">
                    Postavi oglas
                </button>
                <button type="button" class="btn btn-info" onclick="loginDialog.showModal()">
                    Uloguj se
                </button>
                <button type="button" class="btn btn-info" onclick="registerDialog.showModal()">
                    Registruj se
                </button>
            <?php endif; ?>
        </div>
    </div>
</nav>
