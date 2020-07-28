<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Laundry</title>

<body>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            border-color: #ccc;
            width: 100%;
        }

        .tg td {
            font-family: Arial;
            font-size: 12px;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #ccc;
            color: #333;
            background-color: #fff;
        }

        .tg th {
            font-family: Arial;
            font-size: 14px;
            font-weight: normal;
            padding: 10px 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
            border-color: #ccc;
            color: #333;
            background-color: #f0f0f0;
        }

        .tg .tg-3wr7 {
            font-weight: bold;
            font-size: 12px;
            font-family: "Arial", Helvetica, sans-serif !important;
            ;
            text-align: center
        }

        .tg .tg-ti5e {
            font-size: 10px;
            font-family: "Arial", Helvetica, sans-serif !important;
            ;
            text-align: center
        }

        .tg .tg-rv4w {
            font-size: 10px;
            font-family: "Arial", Helvetica, sans-serif !important;
        }

        .page-break {
            page-break-after: always;
        }

    </style>

    <div style="font-family:Arial; font-size:12px;">
    </div>
    <br>
    <table class="tg" style="width:80%;margin-left:auto;margin-right:auto">
        <thead>
            <tr>
                <th class="tg-3wr7">Nama Pelanggan</th>
                <th class="tg-3wr7">Nomor Telpon</th>
                <th class="tg-3wr7">Jenis Layanan</th>
                <th class="tg-3wr7">Harga</th>
                <th class="tg-3wr7">Berat</th>
                <th class="tg-3wr7">Total</th>
                <th class="tg-3wr7">Status</th>
                <th class="tg-3wr7">Tanggal Laundry</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $laundry)
            <tr>
                <td>{{ $laundry->nama_pelanggan }}</td>
                <td>{{ $laundry->telp }}</td>
                <td>{{ $laundry->layanan->nama }}</td>
                <td>{{ $laundry->layanan->harga }}</td>
                <td>{{ $laundry->berat }}</td>
                <td>{{ $laundry->berat * $laundry->layanan->harga }}</td>
                <td>{{ $laundry->flagSelesai ? "Selesai" : "On Proses" }}</td>
                <td>{{ date('d-M-Y H:i', strtotime($laundry->created_at)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</head>

</html>
