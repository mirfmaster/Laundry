<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Receipt Transaksi</title>

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
        <table>
            <tr>
                <td width="120">No Faktur</td>
                <td width="10">:</td>
                <td>{{ $data->no_faktur }}</td>
            </tr>
            <tr>
                <td>Total Belanja</td>
                <td width="10">:</td>
                <td>{{ $data->total }}</td>
            </tr>
            <tr>
                <td>Customer</td>
                <td width="10">:</td>
                <td>{{ $data->customer->nama }}</td>
            </tr>
            <tr>
                <td>Petugas</td>
                <td width="10">:</td>
                <td>{{ $data->user->nama }}</td>
            </tr>
            <tr>
                <td>Tanggal Transaksi</td>
                <td width="10">:</td>
                <td>{{ $data->created_at }}</td>
            </tr>
        </table>
    </div>
    <br>
    <table class="tg" style="width:80%;margin-left:auto;margin-right:auto">
        <thead>
            <tr>
                <th class="tg-3wr7">Nama Sukucadang</th>
                <th class="tg-3wr7">Harga</th>
                <th class="tg-3wr7">Jumlah</th>
                <th class="tg-3wr7">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data->details as $detail)
            <tr>
                <td>{{$detail->sukucadang->nama}}</td>
                <td>{{$detail->harga_jual}}</td>
                <td>{{$detail->jumlah}}</td>
                <td>{{$detail->total}}</td>
            <tr>
                @endforeach
        </tbody>
    </table>
    <div class="page-break"></div>
</body>
</head>

</html>