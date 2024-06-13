<!DOCTYPE html>
<html>

<head>
    <title>Notifikasi Pendaftaran</title>
</head>

<body>
    <p>Yth. <b>Admin</b>, terdapat pendaftaran akun baru.</p>
    <br>
    Nama : {{ $data['name'] }}
    <br>
    Email : {{ $data['email'] }}
    <br>
    Nomor Telepon : {{ $data['no_phone'] }} <br>
    <p>Segera lakukan verifikasi pada akun tersebut.</p>
    <br>
    <em>
        <a
            href="{{ env('APP_URL') }}/dashboard/users/{{ $data['id'] }}/edit">{{ env('APP_URL') }}/dashboard/users/{{ $data['id'] }}/edit</a>
    </em>
</body>

</html>
