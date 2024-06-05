<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KemoterapiLembarKonsulPatientController extends Controller
{
    public function create()
    {
        return view('pages.lembarKonsulPasien.create', [
            "title" => "Lembar Konsul Pasien",
            "menu" => ""
        ]);
    }

    public function edit()
    {
        return view('pages.lembarKonsulPasien.edit', [
            "title" => "Lembar Konsul Pasien",
            "menu" => ""
        ]);
    }

    public function show()
    {
        return view('pages.lembarKonsulPasien.show', [
            "title" => "Lembar Konsul Pasien",
            "menu" => ""
        ]);
    }
}
