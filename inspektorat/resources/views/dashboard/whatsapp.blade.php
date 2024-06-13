@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {!! session('msg') !!}
                            <img id="qrcode" src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif"
                                alt="WhatsApp Scan" title="WhatsApp Scan">
                            <div id="msg"></div>
                        </div>
                    </div>
                </div>
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
