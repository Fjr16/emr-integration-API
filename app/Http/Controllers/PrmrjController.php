<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Prmrj;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Http\Request;

class PrmrjController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $data = User::where('status', 'AKTIF')->whereNotNull('room_detail_id')->whereHas('roles', function($query){
        //     $query->where('name', 'LIKE','%'. 'Dokter' .'%');
        // })->get();
        // $today = now()->format('Y-m-d H:i');
        // $item = Queue::findOrFail($request->queue_id);
        // return view('pages.prmrj.create', [
        //     'title' => 'PRMRJ',
        //     'menu' => 'In Patient',
        //     'item' => $item,
        //     'data' => $data,
        //     'today' => $today
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        // $item = Prmrj::create($data);
        // foreach ($request->user_id as $user_id) {
        //     $item->users()->attach($user_id);
        // }

        // return back()->with([
        //     'success' => 'Berhasil Ditambahkan',
        //     'btn' => 'prmrj',
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Patient::findOrFail($id);
        return view('pages.prmrj.show', [
            "title" => "Surat PRMRJ",
            "menu" => "In Patient",
            'item' => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::where('status', 'AKTIF')->whereNotNull('room_detail_id')->whereHas('roles', function($query){
            $query->where('name', 'LIKE','%'. 'Dokter' .'%');
        })->get();
        $item = Prmrj::find($id);
        $today = now()->format('Y-m-d H:i');
        return view('pages.prmrj.edit', [
            "title" => "Surat PRMRJ",
            "menu" => "In Patient",
            'item' => $item,
            'today' => $today,
            'data' => $data
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
        $data = $request->all();
        $item = Prmrj::findOrFail($id);
        $item->update($data);

        return back()->with([
            'success', 'Berhasil Diperbarui',
            'btn' => 'prmrj',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Prmrj::findOrFail($id);
        $item->delete();

        return back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'prmrj',
        ]);
    }
}
