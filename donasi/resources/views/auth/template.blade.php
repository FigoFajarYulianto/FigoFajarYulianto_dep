<?php $setting = \App\Models\Setting::firstWhere('id', 1); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ $title_bar }}</title>
    <link rel="icon" type="image/png" href="/storage/{{ $setting->favicon }}">
    <link href="/assets/css/styles.css" rel="stylesheet" />
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
        .g-recaptcha {
            display: inline-block;
        }
    </style>
</head>

<body style="background-color: #302c51">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="/assets/js/scripts.js"></script>
    @yield('script')
</body>

</html>
