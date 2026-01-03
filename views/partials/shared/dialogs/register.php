<dialog id="registerDialog" class="border-0 rounded-4 p-0">
    <form method="POST" action="/auth/register" class="p-4" style="min-width: 360px;">

        <div class="text-end mb-2">
            <button type="button" class="btn-close" onclick="registerDialog.close()"></button>
        </div>

        <div class="tab-content register">
            <h3 class="fw-bold mb-3 text-center">Registracija</h3>

            <div class="mb-3">
                <label for="name" class="form-label">Ime</label>
                <input id="name" type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="register-email" class="form-label">Email</label>
                <input id="register-email" type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="register-password" class="form-label">Lozinka</label>
                <input id="register-password" type="password" name="password" class="form-control" required>
            </div>

            <div id="errorMessageBox" style="font-size: 14px; display:none;" class="alert alert-danger">
                <p class="mb-1 fw-bold" style="color:red;">Greška prilikom validacije.</p>
                <p class="mb-0" style="color:gray;"><strong>Ime</strong> - minimalna dužina 2 karaktera</p>
                <p class="mb-0" style="color:gray;"><strong>Email</strong> - email nije validan ili je već korišćen</p>
                <p class="mb-0" style="color:gray;"><strong>Lozinka</strong> - minimalna dužina 5 karaktera</p>
            </div>

            <button class="btn btn-success w-100">Register</button>
        </div>

    </form>
</dialog>
