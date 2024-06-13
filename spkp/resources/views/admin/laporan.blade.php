<!DOCTYPE html>
<html>

<head>

    <link href="/baru/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    {{--  <link href="/baru/assets/css/main.css" rel="stylesheet" type="text/css" />  --}}

    <style>
        table {
            border-spacing: 0;
            width: 100%;
        }

        th {
            background: #404853;
            background: green;
            border-left: 3px solid rgba(0, 0, 0, 0.2);
            border-right: 3px solid rgba(255, 255, 255, 0.1);
            color: black;
            padding: 8px;
            text-align: center;
            text-transform: uppercase;
        }

        th:first-child {
            border-top-left-radius: 4px;
            border-left: 0;
        }

        th:last-child {
            border-top-right-radius: 4px;
            border-right: 0;
        }

        td {
            border-right: 1px solid #c6c9cc;
            border-bottom: 1px solid #c6c9cc;
            padding: 8px;
        }

        td:first-child {
            border-left: 1px solid #c6c9cc;
        }

        tr:first-child td {
            border-top: 0;
        }

        tr:nth-child(even) td {
            background: #e8eae9;
        }

        tr:last-child td:first-child {
            border-bottom-left-radius: 4px;
        }

        tr:last-child td:last-child {
            border-bottom-right-radius: 4px;
        }



        .center {
            text-align: center;
        }
    </style>

    <title>Laporan spkp</title>
</head>

<body>
    <img src="logo.PNG" alt="" style="width: 15%; margin-left:7%">
    <h4>POLRI DAERAH JAWA TIMUR</h4>
    <h4 style="margin-top:-15px; margin-left:3%;">RESOR TRENGGALEK</h4>
    <h4 style="margin-top:-15px; margin-left:5%;">SEKTOR TUGU</h4>
    <p style="margin-top:-15px;">Jalan Raya Tugu 12, Tugu 66352</p>
    <hr width="30%" style="margin-left:-1%; margin-top:-2%;">
    <br>
    <h2 class="center">LAPORAN URUTAN REKOMENDASI CALON PENYIDIK POLISI TERBAIK</h2>
    <br>
    <table class="display expandable-table">
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
    <br>
    <p style="color:red">CATATAN:</p>
    <p>Pemilihan Calon Anggota Penyidik Berdasarkan Urutan Nilai Dari Yang Terbersar</p>

    <div class="col">

        <div class="col-6" style="margin-top:1%">
            <h4 class="mb-5">Tugu ,...............</h4>
            <p>Yang bertanda tangan</p>
            <br>
            <br>
            <br>
            <hr width="20%" style="margin-left:1%;">



        </div>
        <div class="col-6" style="margin-left:45%; margin-top:-60%">
            <img src="stampel_polsek.PNG" alt="">
        </div>
    </div>
</body>

</html>
