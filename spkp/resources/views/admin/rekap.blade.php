@extends('layouts.admin')
@section('content')
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
    <section class="content-header">
        <h1>
            Data Rekap
        </h1>
        <form action="/admin/rekaps" method="get">
            <div class="row">
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Data Rekap</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-9">
                            <select class="form-control" name="periode" id="periode">
                                <option value="" selected>- Pilih -</option>
                                <option value="2023"{{ request('periode') == '2023' ? 'selected' : '' }}>2023</option>
                                <option value="2024"{{ request('periode') == '2024' ? 'selected' : '' }}>2024</option>
                                <option value="2025"{{ request('periode') == '2025' ? 'selected' : '' }}>2025</option>
                                <option value="2026"{{ request('periode') == '2026' ? 'selected' : '' }}>2026</option>
                                <option value="2027"{{ request('periode') == '2027' ? 'selected' : '' }}>2027</option>
                                <option value="2028"{{ request('periode') == '2028' ? 'selected' : '' }}>2028</option>
                                <option value="2029"{{ request('periode') == '2029' ? 'selected' : '' }}>2029</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-body">
                        <div class="table table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="20vh">No</th>
                                        <th>Nama</th>
                                        @foreach ($kriteria as $krit)
                                            <th>{{ $krit->nama }}</th>
                                        @endforeach
                                        <th>Periode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @if (!empty($kandidat))
                                        {{-- variable $kandidat berisi nilai dari setiap kriteria per mahasiswa --}}
                                        @foreach ($kandidat as $kdt)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $kdt->nama }}</td>
                                                @if (count($kdt->nilai) == 0)
                                                    @foreach ($kriteria as $krit)
                                                        <td><i>Tidak ada data</i></td>
                                                    @endforeach
                                                @endif
                                                @foreach ($kdt->nilai as $nilai)
                                                    <td>{{ $nilai->nilai }}</td>
                                                @endforeach
                                                <td>
                                                    {{ $kdt->periode }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <form action="/admin/rekap_perhitungan" method="get">
                            <input type="hidden" name="periode" id="periode" value="{{ request('periode') }}">
                            <button type="submit" class="margin-bottom-2 btn btn-primary btn-sm btn-rounded btn-fw"><span
                                    class="glyphicon glyphicon-eye-open"></span> Perhitungan MWP</button>
                        </form>
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
@push('javascript')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: 'yy'
            });
        });
    </script>
@endpush
