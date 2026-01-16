<dialog id="loginDialog" class="border-0 rounded-4 p-0">
	<form method="POST" action="/auth/login" class="p-4" style="min-width: 360px;">

		<div class="text-end mb-2">
			<button type="button" class="btn-close" onclick="loginDialog.close()"></button>
		</div>

		<div class="tab-content login">
			<h3 class="fw-bold mb-3 text-center">Prijava</h3>

			<div class="mb-3">
				<label for="login-email" class="form-label">Email</label>
				<input id="login-email" type="email" name="email" class="form-control" required>
			</div>

			<div class="mb-3">
				<label for="login-password" class="form-label">Lozinka</label>
				<input id="login-password" type="password" name="password" class="form-control" required>
			</div>

			<div id="errorMessageBox" style="font-size: 14px; display:none;" class="alert alert-danger">
				<p class="mb-1 fw-bold" style="color:red;">Pogrešan email ili lozinka.</p>
			</div>
			<div id="successMessageBox" style="font-size: 14px; display:none;" class="alert alert-success">
				<p class="mb-1 fw-bold">Registracija je uspešna. Prijavite se.</p>
			</div>

			<button type="submit" class="btn btn-primary w-100">Login</button>
		</div>

	</form>
</dialog>
