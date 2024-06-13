@extends('dashboard.template')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i class="fa-brands fa-whatsapp"></i></div>
                                WHATSAPP STATUS & SCAN
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            <div class="card">
                <div class="card-header text-uppercase" style="vertical-align: middle;">
                    {{ $title_bar }}
                    {{-- <a href="/dashboard/whatsapp/reset" class="btn btn-sm btn-danger float-end"
                    onclick="return confirm('Yakin ingin melanjutkan?');">Reset WA</a> --}}
                </div>
                <div class="card-body">
                    {!! session('msg') !!}
                    <img id="qrcode" src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif" alt="WhatsApp Scan" title="WhatsApp Scan">
                    <div id="msg"></div>
                </div>
            </div>
        </div>
    </main>
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