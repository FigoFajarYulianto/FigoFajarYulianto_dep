@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Perhitungan Metode Weighted Product
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href=""> Nilai Kandidat</a></li>
            <li class="active">Perhitungan Metode Weighted Product</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Hasil Normalisasi Bobot Kriteria
                                        </a>
                                    </h4>
                                </div>
                                <div>
                                    <div class="box-body">
                                        <table class="table table-bordered" id="weight">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Kriteria
                                                    </th>
                                                    <th>
                                                        Weight
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kriteria as $k)
                                                    <tr>
                                                        <td>{{ $k->nama }}</td>
                                                        <td>{{ $data['weight'][$k->id] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            Nilai Vektor S
                                        </a>
                                    </h4>
                                </div>
                                <div>
                                    <div class="box-body">
                                        <table class="table table-bordered" id="svalue">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Kandidat
                                                    </th>
                                                    <th>
                                                        Nilai S
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($penerima as $p)
                                                    <tr>
                                                        <td>{{ $p->nama }}</td>
                                                        <td>
                                                            @foreach ($data['s'] as $d)
                                                                @if ($p->id == $d['penerima'])
                                                                    {{ $d['s'] }}&nbsp;
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-success">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Nilai Vektor V
                                        </a>
                                    </h4>
                                </div>
                                <div>
                                    <div class="box-body">
                                        <table class="table table-bordered" id="vector">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Kandidat
                                                    </th>
                                                    <th>
                                                        Nilai V
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($penerima as $p)
                                                    <tr>
                                                        <td>{{ $p->nama }}</td>
                                                        <td>
                                                            {{-- @if (array_key_exists($p->id, $data['v']))
                                                            {{ $data['v'][$p->id] }}
                                                        @endif --}}
                                                            <?php
                                                            if (array_key_exists($p->id, $data['v'])) {
                                                                $parcial = explode('|', $data['v'][$p->id]);
                                                                echo number_format($parcial[1], 4, ',', '.');
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="panel box box-success">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            Urutan Peringkat
                                        </a>
                                    </h4>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Calon Rekomendasi</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['v'] as $v)
                                                @php
                                                    $parcial = explode('|', $v);
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $parcial[0] }}</td>
                                                    <td>
                                                        {{ number_format($parcial[1], 4, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
