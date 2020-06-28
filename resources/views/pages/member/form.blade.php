@extends('layouts.app', [
'elementActive' => 'member'
])


@section('content')
<div class="content">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ isset($data->id) ? 'Edit' : 'Tambah'}} Member</h3>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <?php
                    $url = isset($data->id) ? route('member.update', $data->id) : route('member.store');
                    ?>
                    <form method="POST" action="{{ $url }}">
                        @csrf
                        @if(isset($data->id))
                        @method('patch')
                        @endif
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama"
                                value="{{ $data->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label>No. Telp</label>
                            <input type="text" name="telp" class="form-control" placeholder="Masukan No. Telp"
                                value="{{ $data->telp }}" required>
                        </div>
                        <div class="form-group">
                            <label>Status Aktif</label>
                            <select name="status" class="form-control">
                                <option value="1" selected class="form-control">Aktif</option>
                                <option value="0" {{ isset($data->status) ? ($data->status ? '' : 'selected') : ""}}>
                                    Tidak
                                    Aktif</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection