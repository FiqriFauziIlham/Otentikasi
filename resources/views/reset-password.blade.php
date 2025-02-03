<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2 class="text-center mb-4"><b>Reset Password</b></h2>
                <hr>

                <!-- Alert Error -->
                @if(Session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <b>Oops!</b> {{ Session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <!-- Alert Success -->
                @if(Session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <b>Berhasil!</b> {{ Session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <!-- Reset Password Form -->
                <form action="{{ route('reset-password.post') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password baru" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Masukkan ulang password" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Reset Password</button>
                    </div>
                </form>

                <hr>
                <p class="text-center">
                    <a href="{{ route('login') }}">Kembali ke Login</a>
                </p>
            </div>
        </div>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const password = document.querySelector("#password");
    const passwordConfirm = document.querySelector("#password_confirmation");

    form.addEventListener("submit", function (event) {
        let errors = [];

        if (password.value.length < 8) {
            errors.push("Password harus minimal 8 karakter.");
        }

        if (password.value !== passwordConfirm.value) {
            errors.push("Password dan konfirmasi password tidak cocok.");
        }

        if (errors.length > 0) {
            event.preventDefault();
            alert(errors.join("\n"));
        }
    });
});
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
