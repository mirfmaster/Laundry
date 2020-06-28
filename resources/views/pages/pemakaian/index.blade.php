@extends('layouts.app', [
'elementActive' => $type
])


@section('content')
<div class="content">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Laporan Laundry</h3>
                        </div>
                        <div class="col-4 text-right">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Nomor Telpon</th>
                                <th scope="col">Jenis Layanan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Berat</th>
                                <th scope="col">Total</th>
                                <th scope="col">Tanggal Laundry</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $pemakaian)
                            <tr>
                                <td>{{ $pemakaian->nama_pelanggan }}</td>
                                <td>{{ $pemakaian->telp }}</td>
                                <td>{{ $pemakaian->layanan->nama }}</td>
                                <td>{{ $pemakaian->layanan->harga }}</td>
                                <td>{{ $pemakaian->berat }}</td>
                                <td>{{ $pemakaian->berat * $pemakaian->layanan->harga }}</td>
                                <td>{{ date('d-M-Y H:i', strtotime($pemakaian->created_at)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Nomor Faktur</td>
                            <td id="no_faktur"></td>
                        </tr>
                        <tr>
                            <td>Petugas</td>
                            <td id="petugas"></td>
                        </tr>
                        <tr>
                            <td>Waktu Pemakaian</td>
                            <td id="waktu"></td>
                        </tr>
                    </thead>
                </table>

                <table class="table">
                    <thead>
                        <tr>
                            <td>Item</td>
                            <td>Jumlah</td>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const handleDetail = (data) => {
        console.log(data)
        $('#no_faktur').html(data.no_faktur)
        $('#petugas').html(data.user.name)
        $('#waktu').html(data.created_at.toLocaleString())
        $('#tbody').empty()
        data.details.map((a) => {
            $('#tbody').append(`<tr>
            <td>${a.item.nama}</td>
            <td>${a.jumlah}</td>
        </tr>`)
        })

        $('#modalDetails').modal('show')
    }
</script>
@endpush