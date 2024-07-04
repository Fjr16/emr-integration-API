<?php

namespace App\Http\Controllers;

use DateTime;
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
        if (request('filter')) {
            $filter = new DateTime(request('filter'));
        }
        $filterDate = $filter ?? now();
        $routeToFilter = route('rajal/rekammedis.index');
        $user = Auth::user();
        $data = Queue::where('status_antrian', 'ARRIVED')->whereHas('rawatJalanPoliPatient', function($query) use ($filterDate){
            $query->whereDate('created_at', $filterDate);
        })->get();
        $data = $data->sortBy(function($queue){
            $status = $queue->rawatJalanPoliPatient->status ?? '';
            return $status == 'WAITING' ? 0 : ($status === 'ONGOING' ? 1 : 2);
        })->values();

        return view('pages.rawatjalan.index', [
            "title" => "Rekam Medis",
            "menu" => "In Patient",
            "data" => $data,
            "filterDate" => $filterDate,
            "user" => $user,
            "routeToFilter" => $routeToFilter,
        ]);
    }
}
