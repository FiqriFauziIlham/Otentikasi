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
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <b>Oops!</b> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <!-- Reset Form -->
                <form action="{{ route('forgot-password.verify-code') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email"value="{{ old('email') ?? request('email') }}" required>
                            <button type="button" class="btn btn-primary" onclick="sendResetCode()">Kirim Kode</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="token" class="form-label">Kode Reset</label>
                        <input type="text" name="token" id="token" class="form-control" placeholder="Masukkan kode reset" required>
                        @if(session('token_error'))
                        <small class="text-danger">{{ session('token_error') }}</small>
                        @endif
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Verifikasi Kode</button>
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
    function sendResetCode() {
        const email = document.querySelector('#email').value;

        if (!email) {
            alert('Harap masukkan email terlebih dahulu.');
            return;
        }

        fetch("{{ route('forgot-password.send-code') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                alert(data.status);
            } else if (data.error) {
                alert(data.error);
            } else {
                alert('Terjadi kesalahan yang tidak diketahui.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim kode.');
        });
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
