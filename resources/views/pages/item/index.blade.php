@extends('layouts.app', [
'elementActive' => 'item'
])


@section('content')
<div class="content">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Item</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('item.create') }}" class="btn btn-sm btn-primary">Add Item</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Item</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>
                                    <a href="{{ route('item.edit', $item->id) }}">
                                        <button type="submit" class="btn" style="padding: 5px 6px;font-size:1.7rem">
                                            <i class="nc-icon nc-settings text-warning"></i>
                                        </button>
                                    </a>
                                    <button type="submit" class="btn" style="padding: 5px 6px;font-size:1.7rem" onclick="del(`{{ url('item') }}`, {{$item->id}} )">
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