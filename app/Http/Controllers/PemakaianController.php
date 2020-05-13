<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Item;
use App\Pemakaian;
use App\PemakaianDetail;
use PDF;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pemakaian::with(['user', 'details.item'])->get();
        $type = 'pemakaian';

        return view('pages.pemakaian.index', compact(['data', 'type']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $items = Item::all();
        $randOne = PembelianController::random(14);
        $id = null;

        return view('pages.pemakaian.form', compact(['customers', 'randOne', 'items', 'id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = [];
        for ($i = 0; $i < count($request->item_id); $i++) {
            array_push($data, ["item_id" => $request->item_id[$i], "harga_jual" => $request->harga_jual[$i], "harga_beli" => $request->harga_beli[$i], "total" => $request->total[$i], "jumlah" => $request->jumlah[$i]]);
        }

        $pemakaian = new Pemakaian;
        $pemakaian->no_faktur = $request->no_faktur;
        $pemakaian->user_id = $request->user_id;
        // dd($pemakaian, $data);

        if ($pemakaian->save()) {
            foreach ($data as $item) {
                $detail = new PemakaianDetail;
                $detail->item_id = $item['item_id'];
                $detail->pemakaian_id = $pemakaian->id;
                $detail->jumlah = $item['jumlah'];
                $sukucadang = Item::findOrFail($item['item_id']);

                if ($sukucadang->update(['stock' => $sukucadang->stock - $item['jumlah']])) {
                    $detail->save();
                }
            }

            return redirect()->back()->withMessage('Request successfully executed.');
            // Click <a href="' . route('receipt', $pemakaian->id) . '" style="color:#ef8157" target="_blank">here</a> to print receipt
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function show(Pemakaian $pemakaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemakaian $pemakaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemakaian $pemakaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemakaian $pemakaian)
    {
        //
    }

    public static function receipt($id, $readonyl = false)
    {
        $data = Pemakaian::with(['customer', 'user', 'details.sukucadang'])->findOrFail($id);
        $pdf = PDF::loadView('pdf.receipt', compact(['data', 'readonly']));

        return $pdf->stream();
    }

    public function laporan()
    {
        $data = Pemakaian::with(['details.returpemakaian', 'details.sukucadang', 'customer'])->get();
        $type = 'laporanpemakaian';

        return view('pages.pemakaian.index', compact(['data', 'type']));
    }
}
