<!DOCTYPE html>
<html>

<head>
    <title>Lupa Password</title>
</head>

<body>

    <p>Yth. <b>{{ $data['name'] }}</b>, permintaan perubahan password Anda telah diterima oleh sistem.</p>
    <p>Silahkan klik link berikut ini untuk memperbarui password:</p>
    <p>
        <em>
            <a
                href="{{ env('APP_URL') }}/auth/confirm?user={{ $data['username'] }}&token={{ $data['remember_token'] }}">{{ env('APP_URL') }}/auth/confirm?user={{ $data['username'] }}&token={{ $data['remember_token'] }}</a>
        </em>
    </p>
</body>

</html>
