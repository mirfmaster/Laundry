<?php

namespace App\Http\Controllers;

use App\Item;
use App\Pembelian;
use App\PembelianDetail;
use App\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pembelian::with(['details.item', 'supplier'])->get();
        $type = "pembelian";

        return view('pages.pembelian.index', compact(['data', 'type']));
    }

    public static function random($length)
    {
        return strtoupper(substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, $length));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $items = Item::all();

        $randOne = $this->random(14);
        $randTwo = $this->random(14);

        return view('pages.pembelian.form', compact(['suppliers', 'items', 'randOne', 'randTwo']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        for ($i = 0; $i < count($request->item_id); $i++) {
            array_push($data, ["item_id" => $request->item_id[$i], "harga_beli" => $request->harga_beli[$i], "total" => $request->total[$i], "jumlah" => $request->jumlah[$i]]);
        }

        $pembelian = new Pembelian;
        $pembelian->no_faktur = $request->no_faktur;
        $pembelian->metode_bayar = $request->metode_bayar;
        $pembelian->total = $request->subtotal;
        $pembelian->supplier_id = $request->supplier_id;
        $pembelian->user_id = $request->user_id;
        // dd($pembelian, $data);

        if ($pembelian->save()) {
            foreach ($data as $item) {
                $details = new PembelianDetail();
                $details->item_id = $item['item_id'];
                $details->jumlah = $item['jumlah'];
                $details->harga_beli = $item['harga_beli'];
                $details->total = $item['total'];
                $details->pembelian_id = $pembelian->id;
                $stock = Item::findOrFail($item['item_id']);
                $stock->stock = $stock->stock + $item['jumlah'];
                $stock->save();

                $details->save();
            }

            return redirect()->back()->withMessage('Pembelian Sukses. Stock berhasil di tambahkan!');
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }

    public function laporan()
    {
        $data = Pembelian::with(['details.returpembelian', 'details.item', 'supplier'])->get();
        $type = "laporanpembelian";

        return view('pages.pembelian.index', compact(['data', 'type']));
    }
}
