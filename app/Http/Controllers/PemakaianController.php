<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Item;
use App\Laundry;
use App\Pemakaian;
use App\PemakaianDetail;
use Illuminate\Http\Request;
use PDF;

class PemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Laundry::with(['user', 'layanan'])->get();
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
        $data = [];
        for ($i = 0; $i < count($request->item_id); $i++) {
            array_push($data, ["item_id" => $request->item_id[$i], "harga_jual" => $request->harga_jual[$i], "harga_beli" => $request->harga_beli[$i], "total" => $request->total[$i], "jumlah" => $request->jumlah[$i]]);
        }

        $pemakaian = new Pemakaian;
        $pemakaian->no_faktur = $request->no_faktur;
        $pemakaian->user_id = $request->user_id;

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

    public static function receipt($id, $readonly = false)
    {
        $data = Pemakaian::with(['customer', 'user'])->findOrFail($id);
        $pdf = PDF::loadView('pdf.receipt', compact(['data', 'readonly']));

        return $pdf->stream();
    }

    public function laporan()
    {
        $data = Laundry::with(['layanan'])->get();
        $type = 'laporanpemakaian';

        return view('pages.pemakaian.index', compact(['data', 'type']));
    }

    public function cetak(Request $request)
    {
        $data = Laundry::with(['layanan']);
        if ($request->start_date && $request->end_date) {
            $from = $request->start_date . " 00:00";
            $to = $request->end_date . " 23:59";
            $data = $data->whereBetween('created_at', [$from, $to]);
        }

        $data = $data->get();

        $pdf = PDF::loadView('pdf.laporanlaundry', compact(['data']));

        return $pdf->stream();
    }
}
