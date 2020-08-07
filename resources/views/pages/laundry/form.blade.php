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
                            <label>No Telp</label>
                            <input type="text" name="telp" class="form-control" onkeyup="handleChange(this)"
                                placeholder="Masukan Nomor Telpon">
                        </div>
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" class="form-control" id="nama_pelanggan"
                                placeholder="Masukan Nama Pelanggan" required>
                            <span id="found" style="display: none;color:red">Pelanggan adalah member!</span>
                        </div>

                        <div class="form-group">
                            <label>Jenis Layanan</label>
                            <select name="layanan_id" id="layanan_id" class="form-control" required
                                onchange="layanan()">
                                <option value="">Pilih Layanan</option>
                                @foreach($layanans as $layanan)
                                <option value="{{ $layanan->id }}" data-harga="{{ $layanan->harga }}"
                                    data-satuan="{{ $layanan->harga_satuan }}"
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
                            <input type="number" id="berat" name="berat" class="form-control"
                                placeholder="Masukan Berat Kilogram" onchange="sum()" required>
                        </div>
                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" name="total" class="form-control" readonly value="0" id="total">
                        </div>
                        <div class="form-group">
                            <label>Bayar</label>
                            <input type="text" name="pembayaran" class="form-control" value="0">
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
    let flagSatuan = false;
    let layananId = '';
    let discount = 1;
    let members = @json($member);
    let total = false;

    const sum = () => {
        let layanan = $('#layanan_id').find('option:selected')
        let harga = flagSatuan ? layanan.data('satuan') : layanan.data('harga') || 0;
        let berat = $('#berat').val() || 0
        $('#total').val(harga * berat * discount)
    }

    const layanan = () => {
        let flagExpress = $('#layanan_id').find('option:selected').data('express')
        if (flagExpress) {
            $('#satuan').show()
        } else {
            $('#satuan_id').val('Kilogram')
            $('#satuan').hide()
        }
    }

    let satuan = () => {
        let satuan = $('#satuan_id').find('option:selected').val()
        if (satuan == "Satuan") {
            $('#berat').attr('name', 'satuan')
            flagSatuan = true
        } else {
            $('#berat').attr('name', 'berat')
            flagSatuan = false
        }
        let berat = $('#berat')
        berat.val(0)
        berat.attr('placeholder', "Masukan Berat Kilogram")
    }

    const handleChange = (e) => {
        const inputPelanggan = $('#nama_pelanggan')
        let findMember = members.find((member) => member.telp == e.value)
        if (findMember) {
            discount = 0.05;
            inputPelanggan.val(findMember.nama).attr('readonly', true)
            $('#found').show()
            sum()
        } else {
            discount = 1;
            inputPelanggan.val('').attr('readonly', false)
            $('#found').hide()
        }
    }

</script>
@endpush
