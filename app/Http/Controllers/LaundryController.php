<?php

namespace App\Http\Controllers;

use App\Laundry;
use App\Layanan;
use App\Member;
use Illuminate\Http\Request;
use PDF;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Laundry::with('layanan')->get();

        return view('pages.laundry.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $layanans = Layanan::all();
        $member = Member::all();

        return view('pages.laundry.form', compact(['layanans', 'member']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $laundry = new Laundry;

        $laundry->nama_pelanggan = $request->nama_pelanggan;
        $laundry->telp = $request->telp;
        $laundry->berat = $request->berat;
        $laundry->pembayaran = $request->pembayaran;
        $laundry->satuan = $request->satuan;
        if ($request->satuan) {
            $laundry->flagSatuan = true;
        }
        $laundry->total = $request->total;
        $laundry->layanan_id = $request->layanan_id;
        $laundry->save();

        return redirect()->back()->withMessage('Laundry Sukses, Click <a href="' . route('receipt', $laundry->id) . '" style="color:#ef8157" target="_blank">here</a> to print receipt');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function show(Laundry $laundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function edit(Laundry $laundry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laundry $laundry)
    {
        if ($laundry->update($request->all())) {
            return 1;
        }

        return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laundry $laundry)
    {
        //
    }

    public function receipt($id)
    {
        $data = Laundry::with(['layanan'])->findOrFail($id);
        $pdf = PDF::loadView('pdf.laundry', compact(['data']));

        return $pdf->stream();
    }
}
