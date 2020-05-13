@extends('layouts.app', [
'elementActive' => 'pembelian'
])


@section('content')
<div class="content">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Pembelian</h3>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <form method="POST" action="{{ route('pembelian.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>No Faktur</label>
                            <input type="text" name="no_faktur" class="form-control" value="{{ $randOne }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Metode Bayar</label>
                            <input type="text" name="metode_bayar" class="form-control" placeholder="Masukan Pembayaran" autofocus>
                        </div>
                        <div class="form-group">
                            <label>Supplier</label>
                            <select class="form-control" name="supplier_id">
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col-11">
                                        <h3 class="mb-0">Daftar Barang</h3>
                                    </div>
                                    <div class="col-1">
                                        <i class="nc-icon nc-simple-add" style="font-size:20px;color:red;cursor:pointer" onclick="addItem()"></i>
                                        <i class="nc-icon nc-simple-delete" style="font-size:20px;color:red;cursor:pointer" onclick="removeItem()"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" id="container_item">
                                <div class="row" id="item1">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label> Nama Item </label>
                                            <select name="item_id[]" id="item1" class="form-control" required onchange="handleItem(this, 1)">
                                                <option value="">Pilih Item</option>
                                                @foreach($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label> Harga Beli </label>
                                            <input type="text" name="harga_beli[]" onkeypress="validate(event)" onfocusout="sum(1)" class="form-control" id="harga1" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label> Jumlah </label>
                                            <input type="text" name="jumlah[]" onkeypress="validate(event)" onfocusout="sum(1)" class="form-control" id="jumlah1" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label> Total </label>
                                            <input type="text" name="total[]" class="form-control" readonly id="total1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="justify-content: flex-end; padding-right: 1vw">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label> Subtotal </label>
                                        <input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    let items = 1;
    const item = @json($items);

    const handleItem = (evt, key) => {
        let filter = item.find((items) => items.id == evt.value)
        $('#harga_jual' + key).prop('readonly', false).val(filter.harga_jual || 0).prop('readonly', true);
    }

    const addItem = () => {
        // items = items++;
        ++items;

        let component = `<div class="row" id="item${items}">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label> Nama Item </label>
                                            <select name="item_id[]" id="item${items}" class="form-control" required onchange="handleItem(this, ${items})">
                                                <option value="">Pilih Item</option>
                                                @foreach($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>z
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label> Harga Beli </label>
                                            <input type="text" name="harga_beli[]" onkeypress="validate(event)" onfocusout="sum(${items})" class="form-control" id="harga${items}" required>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label> Jumlah </label>
                                            <input type="text" name="jumlah[]" onkeypress="validate(event)" onfocusout="sum(${items})" class="form-control" id="jumlah${items}" required>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label> Total </label>
                                            <input type="text" name="total[]" class="form-control" readonly id="total${items}">
                                        </div>
                                    </div>
                                </div>`

        $('#container_item').append(component)
    }

    const removeItem = async () => {
        if (items == 1) return;

        $('#item' + items).remove();
        --items;
        sumSubtotal()
    }

    const sumSubtotal = () => {
        let subtotal = 0;
        for (let index = 1; index <= items; index++) {
            let total = Number($('#total' + index).val())
            subtotal += total
        }

        $('#subtotal').val(subtotal)
    }

    const sum = (key) => {
        let harga = $('#harga' + key).val() || 0;
        let jumlah = $('#jumlah' + key).val() || 0;
        let sum = harga * jumlah

        $('#total' + key).val(sum)
        sumSubtotal()
    }

    const validate = (evt) => {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>
@endpush