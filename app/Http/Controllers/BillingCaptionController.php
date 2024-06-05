<?php

namespace App\Http\Controllers;

use App\Models\BillingCaption;
use Illuminate\Http\Request;

class BillingCaptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BillingCaption::all();
        return view('pages.billingcaption.index', [
            "title" => "Tindakan",
            "menu" => "Insert",
            "data" => $data
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        BillingCaption::create($data);

        return redirect()->route('billing/caption.index')->with('success', 'Berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BillingCaption::find($id);
        return view('pages.billingcaption.edit', [
            "title" => "Tindakan",
            "menu" => "Insert",
            "item" => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = BillingCaption::find($id);
        $data = $request->all();

        $item->update($data);

        return redirect()->route('billing/caption.index')->with('success', 'Berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = BillingCaption::find($id);
        $item->delete();

        return redirect()->route('billing/caption.index')->with('success', 'Berhasil dihapus');
    }
}
