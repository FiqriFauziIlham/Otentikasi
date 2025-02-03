<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; color: #333;">Reset Password Anda</h2>
        <p>Halo,</p>
        <p>Anda telah meminta untuk mereset password akun Anda. Silakan gunakan kode berikut untuk melanjutkan proses reset password:</p>
        
        <h3 style="text-align: center; background: #007bff; color: white; padding: 10px; border-radius: 5px;">{{ $token }}</h3>
        
        <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        <p>Terima kasih,</p>
        <p><b>Tim Autentikasi</b></p>
    </div>
</body>
</html>
