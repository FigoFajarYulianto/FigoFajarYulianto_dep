<!DOCTYPE html>
<html>

<head>
    <title>Notifikasi Verifikasi Pendaftaran</title>
</head>

<body>
    <p>Yth. <b>{{ $data['name'] }}</b>, Akun anda telah diverifikasi oleh admin. <br>
        Silahkan Login menggunakan username dan password yang telah didaftarkan sebelumnya.
    </p>
    <br>
    <em>
        <a href="{{ env('APP_URL') }}/auth">{{ env('APP_URL') }}/auth</a>
    </em>
</body>

</html>
