@extends('layouts.app', [
'elementActive' => laporan
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
                                <th scope="col">Nomor Faktur</th>
                                <th scope="col">Metode Bayar</th>
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Nomor Telpon</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $supplier)
                            <tr>
                                <td>{{ $supplier->no_faktur }}</td>
                                <td>{{ $supplier->metode_bayar }}</td>
                                <td>{{ $supplier->supplier->nama }}</td>
                                <td>{{ $supplier->supplier->telp }}</td>
                                <td>
                                    <button type="submit" class="btn" style="padding: 5px 6px;font-size:1.7rem" title="Details" onclick="handleDetail({{$supplier}})">
                                        <i class="nc-icon nc-bullet-list-67 text-warning"></i>
                                    </button>
                                </td>
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
                            <td>Metode Bayar</td>
                            <td id="metode_bayar"></td>
                        </tr>
                        <tr>
                            <td>Nama Supplier</td>
                            <td id="nama_supplier"></td>
                        </tr>
                        <tr>
                            <td>Nomor Telpon</td>
                            <td id="telp"></td>
                        </tr>
                        <tr>
                            <td>Total Pembelian</td>
                            <td id="total"></td>
                        </tr>
                    </thead>
                </table>

                <table class="table">
                    <thead>
                        <tr>
                            <td>Item</td>
                            <td>Harga Beli</td>
                            <td>Jumlah</td>
                            <td>Total</td>
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
        $('#no_surat_jalan').html(data.no_surat_jalan)
        $('#metode_bayar').html(data.metode_bayar)
        $('#nama_supplier').html(data.supplier && data.supplier.nama)
        $('#telp').html(data.supplier && data.supplier.telp)
        $('#total').html(data.total)
        $('#tbody').empty()
        data.details.map((item) => {
            $('#tbody').append(`<tr>
            <td>${item.item.nama}</td>
            <td>${item.harga_beli}</td>
            <td>${item.jumlah}</td>
            <td>${item.total}</td>
        </tr>`)
        })

        $('#modalDetails').modal('show')
    }
</script>
@endpush