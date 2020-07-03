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
                            <h3 class="mb-0">{{ isset($data->id) ? 'Edit' : 'Tambah'}} Layanan</h3>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <form method="POST" action="{{ route('laundry.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" class="form-control"
                                placeholder="Masukan Nama Pelanggan" required>
                        </div>
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="text" name="telp" class="form-control" placeholder="Masukan Nomor Telpon">
                        </div>

                        <div class="form-group">
                            <label>Jenis Layanan</label>
                            <select name="layanan_id" id="layanan_id" class="form-control" required
                                onchange="layanan()">
                                <option value="">Pilih Layanan</option>
                                @foreach($layanans as $layanan)
                                <option value="{{ $layanan->id }}" data-harga="{{ $layanan->harga }}"
                                    data-express="{{ $layanan->flag_express }}">{{ $layanan->nama }}
                                    {{ $layanan->flag_express ? "- Layanan Express" : "" }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="satuan" style="display: none">
                            <label>Jenis Satuan</label>
                            <select id="satuan_id" class="form-control" onchange="satuan()">
                                <option value="Kilogram">Kilogram</option>
                                <option value="Satuan">Satuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Qty</label>
                            <input type="number" id="berat" name="qty" class="form-control"
                                placeholder="Masukan Berat Kilogram" onchange="sum()" required>
                        </div>
                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" name="total" class="form-control" readonly value="0" id="total">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    let flagExpress = false;
    let layananId = '';
    let total = false;
    const sum = () => {
        let layanan = $('#layanan_id').find('option:selected')
        let harga = layanan.data('harga') || 0
        let berat = $('#berat').val() || 0
        $('#total').val(harga * berat)
    }

    const layanan = () => {
        let flagExpress = $('#layanan_id').find('option:selected').data('express')
        if(flagExpress){
            $('#satuan').show()
        } else {
            $('#satuan_id').val('Kilogram')
            $('#satuan').hide()
        }
    }

    const satuan = () => {
        let satuan = $('#satuan_id').find('option:selected').data('express')
        console.log(satuan)
        let berat = $('#berat')
        berat.val(0)
        berat.attr('placeholder', "Masukan Berat Kilogram")
    }
</script>
@endpush