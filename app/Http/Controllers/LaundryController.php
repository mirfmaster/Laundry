<?php

namespace App\Http\Controllers;

use App\Laundry;
use App\Layanan;
use Illuminate\Http\Request;

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

        return view('pages.laundry.form', compact(['layanans']));
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
        $laundry->total = $request->total;
        $laundry->layanan_id = $request->layanan_id;

        $laundry->save();

        return redirect()->back()->withMessage('Pembelian Sukses. Stock berhasil di tambahkan!');
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
        if ($laundry->update($request->all()))
            return 1;

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
}
