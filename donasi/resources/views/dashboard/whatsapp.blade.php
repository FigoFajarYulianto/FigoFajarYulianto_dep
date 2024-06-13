@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase" style="vertical-align: middle;">
                <a href="/dashboard/whatsapp" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                {{ $title_bar }}
                {{-- <a href="/dashboard/whatsapp/reset" class="btn btn-sm btn-danger float-end"
                    onclick="return confirm('Yakin ingin melanjutkan?');">Reset WA</a> --}}
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <img id="qrcode" src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif" alt="WhatsApp Scan"
                    title="WhatsApp Scan">
                <div id="msg"></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            qrCode();
        });

        function qrCode() {
            $.ajax({
                url: "/dashboard/whatsapp/auth",
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.authenticated) {
                        $('#qrcode').hide();
                        $('#msg').show();
                        $('#msg').html(
                            `<p class="mb-0"><i class="fas fa-circle me-2 text-success"></i> WhatsApp is Online</p>`
                        );
                    } else {
                        $('#msg').show();
                        $('#msg').html(
                            `<p class="mb-0 mt-3">Silahkan scan dan tunggu sampai status online.</p>`
                        );
                        $('#qrcode').show();
                        $('#qrcode').attr('src', response.qrcode);
                        $('#qrcode').attr('alt', response.message);
                        $('#qrcode').attr('title', response.message);
                    }
                    setTimeout(function() {
                        qrCode();
                    }, 5000);
                },
                error: function(err) {
                    setTimeout(function() {
                        qrCode();
                    }, 5000);
                }
            });
        }
    </script>
@endsection
