<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Job::all();
        return view('pages.pekerjaan.index', [
            "title" => "Pekerjaan",
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
        return view('pages.pekerjaan.create', [
            "title" => "Pekerjaan",
            "menu" => "Setting",
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
        Job::create($data);

        return redirect()->route('job.index')->with('success', 'Pekerjaan Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Job::find($id);
        return view('pages.pekerjaan.edit', [
            "title" => "Pekerjaan",
            "menu" => "Setting",
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
        $item = Job::find($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('job.index')->with('success', 'Pekerjaan Berhasil Diperbarui'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Job::find($id);
        $item->delete();

        return redirect()->route('job.index')->with('success', 'Pekerjaan Berhasil Dihapus');
    }
}
