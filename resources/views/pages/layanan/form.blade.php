@extends('layouts.app', [
'elementActive' => 'layanan'
])


@section('content')
<?php
// if (session("Message"))
// dd(session("Message"))
?>
<div class="content">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ isset($data->id) ? 'Edit' : 'Tambah'}} Layanan</h3>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <?php
                    $url = isset($data->id) ? route('layanan.update', $data->id) : route('layanan.store');
                    ?>
                    <form method="POST" action="{{ $url }}">
                        @csrf
                        @if(isset($data->id))
                        @method('patch')
                        @endif
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" value="{{ $data->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" class="form-control" placeholder="Masukan Harga" value="{{ $data->harga }}" required>
                        </div>
                        <div class="form-group">
                            <label>Waktu Proses</label>
                            <input type="number" name="waktu" class="form-control" placeholder="Masukan dalam bentuk menit (1 Jam = 60)" value="{{ $data->waktu }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection