@extends('layouts.app', [
'elementActive' => 'laundry'
])


@section('content')
<div class="content">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Laundry</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('laundry.create') }}" class="btn btn-sm btn-primary">Add laundry</a>
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
                                <th scope="col">Berat</th>
                                <th scope="col">Selesai</th>
                                <th scope="col">Diambil oleh</th>
                                <th scope="col">Tanggal Laundry</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $laundry)
                            <tr>
                                <td>{{ $laundry->nama_pelanggan }}</td>
                                <td>{{ $laundry->berat }}</td>
                                <td>{{ $laundry->flagSelesai ? "Sudah Selesai" : "On Proses" }}</td>
                                <td>{{ $laundry->flagDiambil ? $laundry->pengambil : "Belum diambil" }}</td>
                                <td>{{ $laundry->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <button type="submit" class="btn" style="padding: 5px 6px;font-size:1.7rem" title="Details" onclick="handleDetail({{$laundry}})">
                                        <i class="nc-icon nc-bullet-list-67 text-warning"></i>
                                    </button>
                                    @if($laundry->flagSelesai && !$laundry->flagDiambil)
                                    <button type="submit" class="btn" style="padding: 5px 6px;font-size:1.7rem" onclick="handleAmbil({{$laundry->id}})">
                                        <i class="nc-icon nc-simple-remove text-info"></i>
                                    </button>
                                    @endif
                                    @if(!$laundry->flagSelesai)
                                    <button type="submit" class="btn" style="padding: 5px 6px;font-size:1.7rem" onclick="handleDone({{$laundry->id}})">
                                        <i class="nc-icon nc-simple-remove text-danger"></i>
                                    </button>
                                    @endif
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
                <h5 class="modal-title" id="exampleModalLabel">Detail Laundry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td id="nama_pelanggan"></td>
                        </tr>
                        <tr>
                            <td>Nomor Telpon</td>
                            <td id="telp"></td>
                        </tr>
                        <tr>
                            <td>Jenis Layanan</td>
                            <td id="layanan"></td>
                        </tr>
                        <tr>
                            <td>Berat</td>
                            <td id="berat"></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td id="harga"></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td id="total"></td>
                        </tr>
                    </thead>
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
        $('#nama_pelanggan').html(data.nama_pelanggan)
        $('#telp').html(data.telp)
        $('#layanan').html(data.layanan.nama)
        $('#berat').html(data.berat)
        $('#harga').html(data.layanan.harga)
        $('#total').html(data.berat * data.layanan.harga)

        $('#modalDetails').modal('show')
    }

    const handleDone = (id) => {
        Swal.fire({
            title: 'Laundry telah selesai?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return $.ajax({
                    url: `laundry/${id}`,
                    type: 'PATCH',
                    data: {
                        flagSelesai: 1,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        return data
                    },
                    error: function(e) {
                        console.log(e)
                    }
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: `Status telah diubah!`,
                    icon: "success"
                }).then(() => location.reload())
            }
        })

    }

    const handleAmbil = (id) => {
        Swal.fire({
            title: 'Laundry telah diambil siapa?',
            input: 'text',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true,
            preConfirm: (value) => {
                return $.ajax({
                    url: `laundry/${id}/`,
                    type: 'PATCH',
                    data: {
                        flagDiambil: 1,
                        pengambil: value,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        return data
                    },
                    error: function(e) {
                        console.log(e)
                    }
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: `Status telah diubah!`,
                    icon: "success"
                }).then(() => location.reload())
            }
        })

    }
</script>
@endpush