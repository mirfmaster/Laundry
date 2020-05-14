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

        <span>Laundry Receipt</span>
        <br>
        <br>
        <table>
            <tr>
                <td width="120">Nama Pelanggan</td>
                <td width="10">:</td>
                <td>{{ $data->nama_pelanggan }}</td>
            </tr>
            <tr>
                <td>Nomor Telpon</td>
                <td width="10">:</td>
                <td>{{ $data->telp }}</td>
            </tr>
            <tr>
                <td>Jenis Layanan</td>
                <td width="10">:</td>
                <td>{{ $data->layanan->nama }}</td>
            </tr>
            <tr>
                <td>Berat</td>
                <td width="10">:</td>
                <td>{{ $data->berat }}</td>
            </tr>
            <tr>
                <td>Harga</td>
                <td width="10">:</td>
                <td>{{ $data->layanan->harga }}</td>
            </tr>
            <tr>
                <td>Total</td>
                <td width="10">:</td>
                <td>{{ $data->berat * $data->layanan->harga }}</td>
            </tr>
        </table>
    </div>
    <br>
    <span style="font-size: 10px">
        Bawa struk ini saat pengambilan</span>
    <!-- <div class="page-break"></div> -->
</body>
</head>

</html>