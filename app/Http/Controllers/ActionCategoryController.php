<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ActionCategory;
use Illuminate\Http\Request;

class ActionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ActionCategory::all();
        return view('pages.jenisTindakan.index', [
            "title" => "Jenis Tindakan",
            "menu" => "Setting",
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.jenisTindakan.create', [
            "title" => "Jenis Tindakan",
            'menu' => 'Setting',
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        ActionCategory::create($validatedData);
        return redirect()->route('tindakan/category')->with('success', 'Kategori Tindakan Berhasil Ditambahkan'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ActionCategory::firstWhere('id', $id);
        $category = ActionCategory::all();
        // return $category;
        return view('pages.jenisTindakan.edit', [
            "title" => "Edit Jenis Tindakan",
            'menu' => 'Setting',
            "category" => $category,
             'item' => $item
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
        $item = ActionCategory::find($id);
        $data = $request->all();
        $item->update($data);
        return redirect()->route('tindakan/category')->with('success', 'Tindakan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ActionCategory::find($id);
        $actions = Action::where('action_category_id', $item->id)->get();
        foreach($actions as $action){
          $action->delete();
        }
        $item->delete();
        return back()->with('success', 'Data Tindakan Berhasil Dihapus');
    }
}
