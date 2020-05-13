@extends('layouts.app', [
'elementActive' => 'layanan'
])


@section('content')
<div class="content">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Layanan</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('layanan.create') }}" class="btn btn-sm btn-primary">Add layanan</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nama Layanan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Waktu (Menit)</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $layanan)
                            <tr>
                                <td>{{ $layanan->nama }}</td>
                                <td>{{ $layanan->harga }}</td>
                                <td>{{ $layanan->waktu }}</td>
                                <td>
                                    <a href="{{ route('layanan.edit', $layanan->id) }}">
                                        <button type="submit" class="btn" style="padding: 5px 6px;font-size:1.7rem">
                                            <i class="nc-icon nc-settings text-warning"></i>
                                        </button>
                                    </a>
                                    <button type="submit" class="btn" style="padding: 5px 6px;font-size:1.7rem" onclick="del(`{{ url('layanan') }}`, {{$layanan->id}} )">
                                        <i class="nc-icon nc-simple-remove text-danger"></i>
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
@endsection