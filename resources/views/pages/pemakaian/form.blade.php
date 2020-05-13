@extends('layouts.app', [
'elementActive' => 'pemakaian'
])


@section('content')
<div class="content">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Pemakaian</h3>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <form method="POST" action="{{ route('pemakaian.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>No Faktur</label>
                            <input type="text" name="no_faktur" class="form-control" value="{{ $randOne }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Customer</label>
                            <select class="form-control" name="customer_id">
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col-11">
                                        <h3 class="mb-0">Daftar Item</h3>
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
                                            <label> Item yang digunakan </label>
                                            <select name="item_id[]" id="nama1" class="form-control select-nama" onchange="handleChangeNama(this, 1)">
                                                @foreach($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama." (Stock: $item->stock)" }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label> Jumlah </label>
                                            <input type="number" name="jumlah[]" min="1" onfocusout="sum(1)" class="form-control" id="jumlah1" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        @if($id !== null)
                        <a href="{{ route('receipt', $id) }}" style="" id="link">Cetak</a>
                        @endif
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
    let id = @json($id);
    let initData = @json($items);

    $(document).ready(() => {
        if (initData.length > 0)
            $('#nama1').change()


        if (id)
            $('#link').trigger('click')
        console.log(id, 'asdj')
    })

    const handleChangeNama = (evt, key) => {
        let filter = initData.find((items) => items.id == evt.value)
        $('#harga_jual' + key).prop('readonly', false).val(filter.harga_jual || 0).prop('readonly', true);
        const jumlah = $('#jumlah' + key)
        jumlah.attr("placeholder", `Max item ${filter.stock || 0}`).attr('max', filter.stock || 0).focus()

        // $('#select').append('<option value="1">One</option>')
    }

    const addItem = () => {
        // items = items++;
        ++items;

        let component = `<div class="row" id="item${items}">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label> Item yang digunakan </label>
                                            <select name="item_id[]" id="nama${items}" class="form-control select-nama" onchange="handleChangeNama(this, ${items})">
                                                @foreach($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama." (Stock: $item->stock)" }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label> Jumlah </label>
                                            <input type="number" name="jumlah[]" min="1" onfocusout="sum(${items})" class="form-control" id="jumlah${items}" placeholder="" required>
                                        </div>
                                    </div>
                                </div>`
        $('#container_item').append(component)
    }

    const removeItem = () => {
        if (items == 1) return;

        $('#item' + items).remove();
        --items;
        sumSubtotal()
    }

    const sumSubtotal = () => {
        let subtotal = 0;
        for (let index = 1; index <= items; index++) {
            let total = Number($('#total' + index).val())
            console.log(total, index)
            subtotal += total
        }

        $('#subtotal').val(subtotal)
    }

    const sum = (key) => {
        let harga = $('#harga_jual' + key).val() || 0;
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