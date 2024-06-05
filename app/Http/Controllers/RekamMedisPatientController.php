<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Support\Facades\Auth;

class RekamMedisPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = now();
        $user = Auth::user();
        $data = Queue::where('status_antrian', 'SELESAI')->whereHas('rawatJalanPatient', function($query) use ($today){
            $query->whereHas('rawatJalanPoliPatient', function($query1) use ($today){
                $query1->whereDate('created_at', $today);
            });
        })->get();
        $data = $data->sortBy(function($queue){
            $status = $queue->rawatJalanPatient->rawatJalanPoliPatient->status ?? '';
            return $status == 'WAITING' ? 0 : ($status === 'SELESAI' ? 1 : 2);
        })->values();

        return view('pages.rawatjalan.index', [
            "title" => "Rekam Medis",
            "menu" => "In Patient",
            "data" => $data,
            "today" => $today,
            "user" => $user,
        ]);
    }
}
