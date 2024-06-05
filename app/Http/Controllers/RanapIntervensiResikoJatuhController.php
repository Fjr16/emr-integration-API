<?php

namespace App\Http\Controllers;

use App\Models\RanapIntervensiResikoJatuhDetailPatient;
use App\Models\RanapIntervensiResikoJatuhPatient;
use App\Models\RanapMonitoringResikoJatuhPatient;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RanapIntervensiResikoJatuhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RanapIntervensiResikoJatuhPatient::where('ranap_monitoring_resiko_jatuh_patient_id', $id)->first();
        if (!$item) {
            $monitoringRJ = RanapMonitoringResikoJatuhPatient::find($id);
            $item = RanapIntervensiResikoJatuhPatient::create([
                'rawat_inap_patient_id' => $monitoringRJ->rawatInapPatient->id,
                'patient_id' => $monitoringRJ->rawatInapPatient->queue->patient->id,
                'ranap_monitoring_resiko_jatuh_patient_id' => $monitoringRJ->id,
            ]);
        }
        $today = new DateTime();


        $dataRR = [
            'Lakukan orientasi terhadap lingkungan dan rutinitas RS:',
            'Ruangan rapi, pencahayaan yang cukup, jauhkan kabel dari jalur berjalan pasien dan keluarga',
            'Pastikan tempat tidur dalam keadaan rendah dan roda terkunci Kedua pagar pengaman tempat tidur terpasang dengan baik',
            'Kedua pagar pengaman tempat tidur terpasang dengan baik',
            'Barang pribadi dalam jangkauan (handphone, air minum, kacamata, alat bantu)',
            'Edukasi pasien dan keluarga untuk turun dari tempat tidur secara bertahap',
            'Anjurkan pasien tidak memakai sandal/sepatu/kaos kaki yang licin',
            'Edukasi pasien dan keluarga mengenai pencegahan risiko jatuh',
            'Informasikan pasien dan keluarga jika membutuhkan perawat',
        ];
        $dataRS = [
            'Lakukan semua intervensi risiko jatuh rendah',
            'Pintu tidak dalam keadaan terkunci',
            'Edukasi pasien/keluarga untuk mendampingi pasien dalam mobilisasi',
            'Informasikan pasien menggunakan handrail',
            'Gunakan alat bantu jalan (walker/tongkat/kursi/roda)',
            'Optimalisasi penggunaan kacamata dan alat bantu dengar(jika perlu)',
            'Pantau jika pasien mengeluhkan pusing/vertigo dan ajari bangun dari tempat tidur secara perlahan',
            'Pantau obat-obatan yang meningkatkan predisposisi risiko jatuh',
            'Libatkan keluarga dan bantu pasien jika diperlukan',
            'Partisipasi keluarga dalam keselamatan pasien',
        ];
        $dataRT = [
            'Lakukan semua intervensi risiko jatuh (risiko jatuh rendah / risiko jatuh sedang / risiko jatuh tinggi)',
            'Pasang penanda risiko jatuh dengan menjepitkan kancing warna kuning pada gelang identitas',
            'Pasang segitiga kuning pada tempat tidur pasien',
            'Komunikasikan pasien risiko jatuh tinggi pada setiap pergantian shift',
            'Tawarkan pasien menggunakan pispot/urinal untuk eliminasi/defekasi',
            'Jangan tinggalkan pasien sendiri dikamar',
            'Informasikan pasien/keluarga untuk tidak mengunci pintu kamar dan pintu kamar mandi dan gunakan tempat duduk saat mandi',
            'Monitor pasien setiap 4 jam',
            'Edukasi pasien /keluarga tentang efek samping obat',
        ];

        return view('pages.ranapIntervensiPencegahanRisikoJatuh.create', [
            "title" => "Intervensi Pencegahan Risiko Jatuh",
            "menu" => "Rawat Inap",
            "item" => $item,
            "today" => $today,
            "dataRR" => $dataRR,
            "dataRS" => $dataRS,
            "dataRT" => $dataRT,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $item = RanapIntervensiResikoJatuhPatient::find($id);
        $data['tanggal'] = $request->input('tanggal');
        $data['user_id'] = Auth::user()->id;
        $item->update($data);

        $tindakans = $request->input('tindakan', []);

        $details = RanapIntervensiResikoJatuhDetailPatient::where('ranap_intervensi_resiko_jatuh_patient_id', $item->id)->get();
        if ($details) {
            RanapIntervensiResikoJatuhDetailPatient::where('ranap_intervensi_resiko_jatuh_patient_id', $item->id)->delete();
            foreach ($tindakans as $tindakan) {
                RanapIntervensiResikoJatuhDetailPatient::create([
                    'ranap_intervensi_resiko_jatuh_patient_id' => $item->id,
                    'tindakan' => $tindakan,
                ]);
            }
        } else {
            foreach ($tindakans as $tindakan) {
                RanapIntervensiResikoJatuhDetailPatient::create([
                    'ranap_intervensi_resiko_jatuh_patient_id' => $item->id,
                    'tindakan' => $tindakan,
                ]);
            }
        }

        return redirect()->route('assesmen/monitoring/resiko/jatuh.detail', $item->patient_id)->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = RanapIntervensiResikoJatuhPatient::find($id);
        $details = RanapIntervensiResikoJatuhDetailPatient::where('ranap_intervensi_resiko_jatuh_patient_id', $item->id)->get();

        return view('pages.ranapIntervensiPencegahanRisikoJatuh.show', [
            "title" => "Intervensi Pencegahan Risiko Jatuh",
            "menu" => "Rawat Inap",
            "item" => $item,
            "details" => $details,
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
        $item = RanapIntervensiResikoJatuhPatient::where('ranap_monitoring_resiko_jatuh_patient_id', $id)->first();
        $details = RanapIntervensiResikoJatuhDetailPatient::where('ranap_intervensi_resiko_jatuh_patient_id', $item->id)->get();

        $dataRR = [
            [
                'no' => 1,
                'name' => 'Lakukan orientasi terhadap lingkungan dan rutinitas RS:',
            ],
            [
                'no' => 'a',
                'name' => 'Orientasikan tempat menghidupkan lampu',
            ],
            [
                'no' => 'b',
                'name' => 'Orientasikan tempat bel dan cara penggunaannnya di kamar dan di kamar mandi',
            ],
            [
                'no' => 'c',
                'name' => 'Orientasikan lokasi kamar mandi dan lantai kamar mandi tidak plicin',
            ],
            [
                'no' => 'd',
                'name' => 'Memberitahukan waktu pembersihan kamar dan rutinitas pekerjaan',
            ],
            [
                'no' => 2,
                'name' => 'Ruangan rapi, pencahayaan yang cukup, jauhkan kabel dari jalur berjalan pasien dan keluarga',
            ],
            [
                'no' => 3,
                'name' => 'Pastikan tempat tidur dalam keadaan rendah dan roda terkunci Kedua pagar pengaman tempat tidur terpasang dengan baik',
            ],
            [
                'no' => 4,
                'name' => 'Kedua pagar pengaman tempat tidur terpasang dengan baik',
            ],
            [
                'no' => 5,
                'name' => 'Barang pribadi dalam jangkauan (handphone, air minum, kacamata, alat bantu)',
            ],
            [
                'no' => 6,
                'name' => 'Edukasi pasien dan keluarga untuk turun dari tempat tidur secara bertahap',
            ],
            [
                'no' => 7,
                'name' => 'Anjurkan pasien tidak memakai sandal/sepatu/kaos kaki yang licin',
            ],
            [
                'no' => 8,
                'name' => 'Edukasi pasien dan keluarga mengenai pencegahan risiko jatuh',
            ],
            [
                'no' => 9,
                'name' => 'Informasikan pasien dan keluarga jika membutuhkan perawat',
            ],
        ];

        $dataRS = [
            'Lakukan semua intervensi risiko jatuh rendah',
            'Pintu tidak dalam keadaan terkunci',
            'Edukasi pasien/keluarga untuk mendampingi pasien dalam mobilisasi',
            'Informasikan pasien menggunakan handrail',
            'Gunakan alat bantu jalan (walker/tongkat/kursi/roda)',
            'Optimalisasi penggunaan kacamata dan alat bantu dengar(jika perlu)',
            'Pantau jika pasien mengeluhkan pusing/vertigo dan ajari bangun dari tempat tidur secara perlahan',
            'Pantau obat-obatan yang meningkatkan predisposisi risiko jatuh',
            'Libatkan keluarga dan bantu pasien jika diperlukan',
            'Partisipasi keluarga dalam keselamatan pasien',
        ];

        $dataRT = [
            'Lakukan semua intervensi risiko jatuh (risiko jatuh rendah / risiko jatuh sedang / risiko jatuh tinggi)',
            'Pasang penanda risiko jatuh dengan menjepitkan kancing warna kuning pada gelang identitas',
            'Pasang segitiga kuning pada tempat tidur pasien',
            'Komunikasikan pasien risiko jatuh tinggi pada setiap pergantian shift',
            'Tawarkan pasien menggunakan pispot/urinal untuk eliminasi/defekasi',
            'Jangan tinggalkan pasien sendiri dikamar',
            'Informasikan pasien/keluarga untuk tidak mengunci pintu kamar dan pintu kamar mandi dan gunakan tempat duduk saat mandi',
            'Monitor pasien setiap 4 jam',
            'Edukasi pasien /keluarga tentang efek samping obat',
        ];

        return view('pages.ranapIntervensiPencegahanRisikoJatuh.edit', [
            "title" => "Intervensi Pencegahan Risiko Jatuh",
            "menu" => "Rawat Inap",
            "item" => $item,
            "details" => $details,
            "dataRR" => $dataRR,
            "dataRS" => $dataRS,
            "dataRT" => $dataRT,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RanapIntervensiResikoJatuhPatient::find($id);
        RanapIntervensiResikoJatuhDetailPatient::where('ranap_intervensi_resiko_jatuh_patient_id', $item->id)->delete();
        $item->update([
            'user_id' => null,
            'tanggal' => null,
        ]);

        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }
}
