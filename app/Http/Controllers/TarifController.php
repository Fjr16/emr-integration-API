<?php

namespace App\Http\Controllers;

use App\Models\TarifPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

use function Ramsey\Uuid\v1;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TarifPatient::all();
        $types = TarifPatient::select('type')->distinct()->pluck('type');
        return view('pages.keuangan.tarif.tarifLayanan.index', [
            'data' => $data,
            'title' => 'TARIF LAYANAN',
            'menu' => 'KEUANGAN',
            'types' => $types,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        return view('pages.keuangan.tarif.tarifLayanan.create', [
            'type' => $type,
            'title' => 'TARIF LAYANAN',
            'menu' => 'KEUANGAN',
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
        TarifPatient::create($data);
        return back()->with('success', 'SUKSES');
    }
    
    public function tarifLayananStore()
    {
        Artisan::call('migrate:refresh --path=/database/migrations/2024_04_04_024941_create_tarif_patients_table.php');
        $data = [

            //TARIF LAYANAN RSK BEDAH ROPANASURI

            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'TARIF ADMINISTRASI',
                'layanan' => 'ADMINISTRASI RAWAT INAP',
                'tarif' => 350000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'TARIF ADMINISTRASI',
                'layanan' => 'ADMINISTRASI RAWAT JALAN',
                'tarif' => 50000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'JASA KONSULTASI',
                'layanan' => 'JASA KONSULTASI DOKTER SPESIALIS (POLIKLINIK)',
                'tarif' => 150000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'JASA KONSULTASI',
                'layanan' => 'JASA KONSULTASI DOKTER INTERNE DAN JANTUNG (TOLERANSI OPERASI)',
                'tarif' => 150000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'JASA KONSULTASI',
                'layanan' => 'JASA KONSULTASI DOKTER SPESIALIS LUAR',
                'tarif' => 250000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'JASA KONSULTASI',
                'layanan' => 'JASA KONSULTASI DOKTER UMUM (IGD DAN POLI)',
                'tarif' => 100000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'JASA KONSULTASI',
                'layanan' => 'JASA KONSULTASI SBAR (VIA TELEPON)',
                'tarif' => 50000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'JASA KONSULTASI',
                'layanan' => 'JASA KONSULTASI GIZI',
                'tarif' => 40000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'JASA KONSULTASI',
                'layanan' => 'JASA KONSULTASI DOKTER RUANGAN ',
                'tarif' => 50000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'JASA VISITE',
                'layanan' => 'JASA VISITE DOKTER SPESIALIS DIRUANGAN RAWAT INAP/KEMOTERAPI/HCU ',
                'tarif' => 100000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'JASA VISITE',
                'layanan' => 'JASA VISITE DOKTER UMUM',
                'tarif' => 50000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'BIAYA KAMAR',
                'layanan' => 'KELAS RAWATAN VIP',
                'tarif' => 1500000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'BIAYA KAMAR',
                'layanan' => 'KELAS RAWATAN 1',
                'tarif' => 1100000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'BIAYA KAMAR',
                'layanan' => 'KELAS RAWATAN 2',
                'tarif' => 600000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'BIAYA KAMAR',
                'layanan' => 'KELAS RAWATAN 3',
                'tarif' => 400000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'BIAYA KAMAR',
                'layanan' => 'KELAS RAWATAN ICU',
                'tarif' => 1000000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'BIAYA KAMAR',
                'layanan' => 'RUANGAN BEDAH MINOR',
                'tarif' => 500000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'BIAYA KAMAR',
                'layanan' => 'RUANGAN KEMOTERAPI',
                'tarif' => 400000,
            ],
            [
                'type' => 'TARIF LAYANAN RSK BEDAH ROPANASURI',
                'category' => 'BIAYA KAMAR',
                'layanan' => 'RUANGAN ISOLASI',
                'tarif' => 1000000,
            ],


            //TARIF ATAU JASA DOKTER DI KAMAR BEDAH
            
            
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Medium I',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 1500000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Medium I',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 600000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Medium I',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 1650000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Medium I',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 660000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Medium II',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 2500000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Medium II',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 1000000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Medium II',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 2750000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Medium II',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 1100000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Mayor',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 3500000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Mayor',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 1400000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Mayor',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 3850000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Mayor',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 1540000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Supra Mayor',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 4500000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Supra Mayor',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 1800000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Supra Mayor',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 4950000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Supra Mayor',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 1980000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Extra Mayor',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 6000000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Extra Mayor',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 2400000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Extra Mayor',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 6600000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Extra Mayor',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 2640000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Khusus I',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 7500000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Khusus I',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 3000000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Khusus I',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 8250000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Khusus I',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 3300000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Khusus II',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 9000000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Khusus II',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 3600000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Khusus II',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 9900000,
            ],
            [
                'type' => 'TARIF ATAU JASA DOKTER DI KAMAR BEDAH',
                'category' => 'Khusus II',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 3960000,
            ],

            //C.	TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)

            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Medium I',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 1100000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Medium I',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 500000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Medium I',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 1300000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Medium I',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 600000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Medium II',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 1500000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Medium II',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 600000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Medium II',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 1700000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Medium II',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 700000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Mayor',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 1900000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Mayor',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 700000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Mayor',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 2100000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Mayor',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 800000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Supra Mayor',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 2300000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Supra Mayor',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 800000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Supra Mayor',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 2500000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Supra Mayor',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 900000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Extra Mayor',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 2700000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Extra Mayor',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 900000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Extra Mayor',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 2900000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Extra Mayor',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 1000000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Khusus I',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 3100000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Khusus I',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 1000000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Khusus I',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 3200000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Khusus I',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 1100000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Khusus II',
                'layanan' => 'Kelas 3 DPJP',
                'tarif' => 3500000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Khusus II',
                'layanan' => 'Kelas 3 DPJA',
                'tarif' => 1100000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Khusus II',
                'layanan' => 'Kelas 2 DPJP',
                'tarif' => 3700000,
            ],
            [
                'type' => 'TARIF KAMAR BEDAH DAN RECOVERY ROOM (PACU)',
                'category' => 'Khusus II',
                'layanan' => 'Kelas 2 DPJA',
                'tarif' => 1200000,
            ],

            // TARIF PELAYANAN PENUNJANG MEDIK

            [
                'type' => 'TARIF PELAUANAN PENUNJANG MEDIK',
                'category' => 'RONTGEN POLOS',
                'layanan' => 'THORAX KELAS 3',
                'tarif' => 150000,
            ],
            [
                'type' => 'TARIF PELAUANAN PENUNJANG MEDIK',
                'category' => 'RONTGEN POLOS',
                'layanan' => 'THORAX KELAS 2',
                'tarif' => 170000,
            ],
            [
                'type' => 'TARIF PELAUANAN PENUNJANG MEDIK',
                'category' => 'RONTGEN POLOS',
                'layanan' => 'THORAX KELAS 1',
                'tarif' => 195000,
            ],
            [
                'type' => 'TARIF PELAUANAN PENUNJANG MEDIK',
                'category' => 'RONTGEN POLOS',
                'layanan' => 'THORAX VIP',
                'tarif' => 225000,
            ],
            [
                'type' => 'TARIF PELAUANAN PENUNJANG MEDIK',
                'category' => 'RONTGEN POLOS',
                'layanan' => 'THORAX TARIF R.JALAN',
                'tarif' => 225000,
            ],
            
            //TARIF PELAYANAN LAINNYA (ORTHOPEDI)
            [
                'type' => 'TARIF PELAYANAN LAINNYA (ORTHOPEDI)',
                'category' => 'TARIF TINDAKAN PERASAT RAWAT JALAN, GAWAT DARURAT, RAWAT INAP',
                'layanan' => 'AFF HECTING < 5',
                'tarif' => 100000,
            ],
            [
                'type' => 'TARIF PELAYANAN LAINNYA (ORTHOPEDI)',
                'category' => 'TARIF TINDAKAN PERASAT RAWAT JALAN, GAWAT DARURAT, RAWAT INAP',
                'layanan' => 'AFF HECTING 5-10',
                'tarif' => 150000,
            ],

            //TARIF TINDAKAN THT 
            [
                'type' => 'TARIF TINDAKAN THT ',
                'category' => 'TINDAKAN MEDIK NON OPERATIF',
                'layanan' => 'ANGKAT JAHITAN OPERASI (<6)',
                'tarif' => 290000,
            ],
            [
                'type' => 'TARIF TINDAKAN THT ',
                'category' => 'TINDAKAN MEDIK NON OPERATIF',
                'layanan' => 'ANGKAT JAHITAN OPERASI (>6)',
                'tarif' => 306500,
            ],
            [
                'type' => 'TARIF TINDAKAN THT ',
                'category' => 'TINDAKAN MEDIK OPERATIF',
                'layanan' => 'ANGKAT KANUL TRAKEOSTOMI / DEKANULASI',
                'tarif' => 620000,
            ],
            [
                'type' => 'TARIF TINDAKAN THT ',
                'category' => 'TINDAKAN MEDIK OPERATIF',
                'layanan' => 'ANTROSTOMI',
                'tarif' => 702500,
            ],
            [
                'type' => 'TARIF TINDAKAN THT ',
                'category' => 'TINDAKAN DIAGNOSTIK ELEKTROMEDIK',
                'layanan' => 'AIDED ASSR',
                'tarif' => 636500,
            ],

            //TARIF ALAT KESEHATAN
            [
                'type' => 'TARIF ALAT KESEHATAN ',
                'category' => 'ALAT KESEHATAN',
                'layanan' => 'KORSET TULANG BELAKANG',
                'tarif' => 385000,
            ],
            [
                'type' => 'TARIF ALAT KESEHATAN ',
                'category' => 'ALAT KESEHATAN',
                'layanan' => 'COLLARNECK',
                'tarif' => 165000,
            ],

            //TARIF TINDAKAN PERASAT IGD , POLI DAN RAWAT INAP
            [
                'type' => 'TARIF TINDAKAN PERASAT IGD , POLI DAN RAWAT INAP ',
                'category' => 'TARIF PELAYANAN LAINNYA',
                'layanan' => 'AFF HECTING < 5',
                'tarif' => 50000,
            ],
            [
                'type' => 'TARIF TINDAKAN PERASAT IGD , POLI DAN RAWAT INAP ',
                'category' => 'TARIF PELAYANAN LAINNYA',
                'layanan' => 'AFF HECTING 5-10',
                'tarif' => 75000,
            ],
        ];
        
        foreach($data as $item){
            TarifPatient::create([
                'category' => $item['category'],
                'layanan' => $item['layanan'],
                'tarif' => $item['tarif'],
                'type' => $item['type'],
            ]);
        }
        return back()->with('success', 'SUKSES');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        $types = TarifPatient::select('type')->distinct()->pluck('type');
        $data = TarifPatient::where('type', $type)->get();
        return view('pages.keuangan.tarif.tarifLayanan.index', [
            'data' => $data,
            'title' => 'TARIF LAYANAN',
            'menu' => 'KEUANGAN',
            'types' => $types,
            'type' => $type,
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
        $item = TarifPatient::find($id);
        return view('pages.keuangan.tarif.tarifLayanan.edit', [
            'item' => $item,
            'title' => 'TARIF LAYANAN',
            'menu' => 'KEUANGAN',
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
        $item = TarifPatient::find($id);
        $data = $request->all();
        $item->update($data);
        return back()->with('success', 'SUKSES');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = TarifPatient::find($id);
        $item->delete();
        return back()->with('success', 'SUKSES');
    }
}
