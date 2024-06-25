<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ActionRate;
use Illuminate\Http\Request;

class ActionRatesController extends Controller
{
    public function edit($id)
    {
        $item = Action::find($id);
        return view('pages.tariftindakan.edit', [
            "title" => "Tindakan",
            "menu" => "Insert",
            "item" => $item,
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
        $item = ActionRate::find($id);
        $data = $request->all();

        $item->update($data);
        return back()->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
