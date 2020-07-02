<?php

namespace App\Http\Controllers;

use App\Layanan;
use Exception;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Layanan::all();

        return view('pages.layanan.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = new Layanan;

        return view('pages.layanan.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = Layanan::create($request->except('_token'));

            return redirect()->route('layanan.index')->withMessage('Request successfully executed');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('Message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function show(Layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Layanan $layanan)
    {
        return view('pages.layanan.form', ['data' => $layanan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Layanan $layanan)
    {
        $layanan->nama = $request->nama;
        $layanan->harga = $request->harga;
        $layanan->waktu = $request->waktu;
        $layanan->harga_satuan = $request->harga_satuan;
        $layanan->flag_express = $request->flag_express;
        $layanan->save();

        return redirect()->route('layanan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layanan $layanan)
    {
        if ($layanan->delete()) {
            return 1;
        }

        return 0;
    }
}
