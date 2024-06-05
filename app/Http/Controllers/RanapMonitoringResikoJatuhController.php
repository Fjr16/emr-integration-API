<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\RanapIntervensiResikoJatuhDetailPatient;
use App\Models\RanapIntervensiResikoJatuhPatient;
use App\Models\RanapMonitoringResikoJatuhDetailPatient;
use App\Models\RanapMonitoringResikoJatuhPatient;
use App\Models\RawatInapPatient;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RanapMonitoringResikoJatuhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Queue::whereHas('rawatInapPatient', function($query){
            $query->whereNot('status', 'WAITING')->whereNot('status', 'BATAL');
        })->get();
        return view('pages.ranapAsesmenDanMonitoringResikoJatuh.index', [
            "title" => "Asesmen Dan Monitoring Risiko Jatuh",
            "menu" => "Rawat Inap",
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $item = RawatInapPatient::find($id);
        $data = RanapMonitoringResikoJatuhPatient::where('rawat_inap_patient_id', $id)->get();

        return view('pages.ranapAsesmenDanMonitoringResikoJatuh.detail', [
            "item" => $item,
            "title" => "Asesmen Dan Monitoring Risiko Jatuh",
            "menu" => "Rawat Inap",
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $item = RawatInapPatient::find($id);
        $today = new DateTime();
        $tgl_lhr = new DateTime($item->queue->patient->tanggal_lhr);
        $usia = $tgl_lhr->diff($today)->y;

        if ($usia > 12 && $usia <= 65) {
            $data = [
                [
                    'faktor_resiko' => 'Riwayat Jatuh',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '25'],
                ],
                [
                    'faktor_resiko' => 'Diagnosa Sekunder',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '25'],
                ],
                [
                    'faktor_resiko' => 'Menggunakan Alat Bantu',
                    'skala' => ['Tidak ada / bedrest / dibantu perawat', 'kruk / tongkat', 'kursi / perabot'],
                    'skor' => ['0', '25', '30'],
                ],
                [
                    'faktor_resiko' => 'Menggunakan Infus / Heparin / Pengencer Darah',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '20'],
                ],
                [
                    'faktor_resiko' => 'Gaya Berjalan',
                    'skala' => ['Normal / Bedrest / Kursi Roda', 'Lemah', 'Terganggu'],
                    'skor' => ['0', '10', '20'],
                ],
                [
                    'faktor_resiko' => 'Status Mental',
                    'skala' => ['Menyadari Kemampuan', 'Lupa akan keterbatasan / pelupa'],
                    'skor' => ['0', '15'],
                ],
            ];
        }
        if ($usia > 65) {
            $data = [
                [
                    'faktor_resiko' => 'Riwayat Jatuh Akhir-Akhir Ini',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '7'],
                ],
                [
                    'faktor_resiko' => 'Perubahan Berkemih (Inkontinensia, Nokturia)',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
                [
                    'faktor_resiko' => 'Kebingungan / Disorientasi',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
                [
                    'faktor_resiko' => 'Depresi',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '4'],
                ],
                [
                    'faktor_resiko' => 'Pusing / Vertigo',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
                [
                    'faktor_resiko' => 'Keterbatasan Mobilitas / Kelemahan Tubuh',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '2'],
                ],
                [
                    'faktor_resiko' => 'Penilaian Buruk (jika tidak kebingungan)',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
            ];
        }
        if ($usia <= 12) {
            $data = [
                [
                    'faktor_resiko' => 'Usia',
                    'skala' => ['< 3 tahun', '3-7 tahun', '7-12 tahun', '> 12 tahun'],
                    'skor' => ['4', '3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Jenis Kelamin',
                    'skala' => ['Laki-laki', 'Perempuan'],
                    'skor' => ['2', '1'],
                ],
                [
                    'faktor_resiko' => 'Diagnosis',
                    'skala' => ['Diagnosis Neurologi (riwayat demam tinggi, kejang)', 'Perubahan Oksigenasi (diagnosis respiratorik, dehidrasi, anemia, anokreksia, sinkop, pusing', 'Gangguan Perilaku / psikiatri', 'Diagnosis Lainnya'],
                    'skor' => ['4', '3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Gangguan Kognitif',
                    'skala' => ['Tidak Menyadari keterbatasan diri', 'Lupa akan terhadap adanya keterbatasan', 'Orientasi baik terhadap diri sendiri'],
                    'skor' => ['3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Faktor Lingkungan',
                    'skala' => ['Riwayat jatuh / bayi diletakkan di tempat tidur dewasa', 'Pasien menggunakan alat bantu / bayi diletakkan di dalam tempat tidur bayi / perabot rumah', 'Pasien diletakkan ditempat tidur', 'Area diluar rumah sakit'],
                    'skor' => ['4', '3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Respon terhadap : Pembedahan sedasi / anestesi',
                    'skala' => ['Dalam 24 jam', 'Dalam 48 jam', '> 48 jam atau tidak menjalani pembedahan / sedasi / anestesi'],
                    'skor' => ['3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Pengunaan medika mentosa',
                    'skala' => ['Penggunaan multiple: sedative, ote hypnosis, barbiturate', 'fenotiazin, antidepresan, pencahar, diuretik, narkose Penggunaan salah satu obat diatas', 'Penggunaan medikasi lainnya / tidak ada medikasi'],
                    'skor' => ['3', '2', '1'],
                ],
            ];
        }

        return view('pages.ranapAsesmenDanMonitoringResikoJatuh.create', [
            "title" => "Asesmen Dan Monitoring Risiko Jatuh",
            "menu" => "Rawat Inap",
            "item" => $item,
            "usia" => $usia,
            "today" => $today,
            "data" => $data
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
        $item = RawatInapPatient::find($id);

        $dataMainMonitoring['rawat_inap_patient_id'] = $item->id;
        $dataMainMonitoring['patient_id'] = $item->queue->patient->id;
        $dataMainMonitoring['user_id'] = Auth::user()->id;
        $dataMainMonitoring['tanggal'] = $request->input('tanggal');
        $dataMainMonitoring['tipe'] = $request->input('tipe');
        $dataMainMonitoring['total_skor'] = $request->input('total_skor');
        $dataMainMonitoring['nilai_skor'] = $request->input('nilai_skor');
        $maintb = RanapMonitoringResikoJatuhPatient::create($dataMainMonitoring);

        $dataMonitoringDetail = $request->input('data', []);
        foreach ($dataMonitoringDetail as $detail) {
            RanapMonitoringResikoJatuhDetailPatient::create([
                'ranap_monitoring_resiko_jatuh_patient_id' => $maintb->id,
                'faktor_resiko' => $detail['name'],
                'skor' => $detail['skor'],
            ]);
        }

        RanapIntervensiResikoJatuhPatient::create([
            'rawat_inap_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'ranap_monitoring_resiko_jatuh_patient_id' => $maintb->id,
        ]);

        return redirect()->route('assesmen/monitoring/resiko/jatuh.detail', $item->id)->with('success', 'Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $monitoring = RanapMonitoringResikoJatuhPatient::find($id);
        $details = RanapMonitoringResikoJatuhDetailPatient::where('ranap_monitoring_resiko_jatuh_patient_id', $monitoring->id)->get();
        $item = RawatInapPatient::find($monitoring->rawat_inap_patient_id);
        $today = new DateTime();
        $tgl_lhr = new DateTime($item->queue->patient->tanggal_lhr);
        $usia = $tgl_lhr->diff($today)->y;

        if ($usia > 12 && $usia <= 65) {
            $data = [
                [
                    'faktor_resiko' => 'Riwayat Jatuh',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '25'],
                ],
                [
                    'faktor_resiko' => 'Diagnosa Sekunder',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '25'],
                ],
                [
                    'faktor_resiko' => 'Menggunakan Alat Bantu',
                    'skala' => ['Tidak ada / bedrest / dibantu perawat', 'kruk / tongkat', 'kursi / perabot'],
                    'skor' => ['0', '25', '30'],
                ],
                [
                    'faktor_resiko' => 'Menggunakan Infus / Heparin / Pengencer Darah',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '20'],
                ],
                [
                    'faktor_resiko' => 'Gaya Berjalan',
                    'skala' => ['Normal / Bedrest / Kursi Roda', 'Lemah', 'Terganggu'],
                    'skor' => ['0', '10', '20'],
                ],
                [
                    'faktor_resiko' => 'Status Mental',
                    'skala' => ['Menyadari Kemampuan', 'Lupa akan keterbatasan / pelupa'],
                    'skor' => ['0', '15'],
                ],
            ];
        } elseif ($usia > 65) {
            $data = [
                [
                    'faktor_resiko' => 'Riwayat Jatuh Akhir-Akhir Ini',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '7'],
                ],
                [
                    'faktor_resiko' => 'Perubahan Berkemih (Inkontinensia, Nokturia)',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
                [
                    'faktor_resiko' => 'Kebingungan / Disorientasi',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
                [
                    'faktor_resiko' => 'Depresi',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '4'],
                ],
                [
                    'faktor_resiko' => 'Pusing / Vertigo',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
                [
                    'faktor_resiko' => 'Keterbatasan Mobilitas / Kelemahan Tubuh',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '2'],
                ],
                [
                    'faktor_resiko' => 'Penilaian Buruk (jika tidak kebingungan)',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
            ];
        } elseif ($usia <= 12) {
            $data = [
                [
                    'faktor_resiko' => 'Usia',
                    'skala' => ['< 3 tahun', '3-7 tahun', '7-12 tahun', '> 12 tahun'],
                    'skor' => ['4', '3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Jenis Kelamin',
                    'skala' => ['Laki-laki', 'Perempuan'],
                    'skor' => ['2', '1'],
                ],
                [
                    'faktor_resiko' => 'Diagnosis',
                    'skala' => ['Diagnosis Neurologi (riwayat demam tinggi, kejang)', 'Perubahan Oksigenasi (diagnosis respiratorik, dehidrasi, anemia, anokreksia, sinkop, pusing', 'Gangguan Perilaku / psikiatri', 'Diagnosis Lainnya'],
                    'skor' => ['4', '3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Gangguan Kognitif',
                    'skala' => ['Tidak Menyadari keterbatasan diri', 'Lupa akan terhadap adanya keterbatasan', 'Orientasi baik terhadap diri sendiri'],
                    'skor' => ['3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Faktor Lingkungan',
                    'skala' => ['Riwayat jatuh / bayi diletakkan di tempat tidur dewasa', 'Pasien menggunakan alat bantu / bayi diletakkan di dalam tempat tidur bayi / perabot rumah', 'Pasien diletakkan ditempat tidur', 'Area diluar rumah sakit'],
                    'skor' => ['4', '3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Respon terhadap : Pembedahan sedasi / anestesi',
                    'skala' => ['Dalam 24 jam', 'Dalam 48 jam', '> 48 jam atau tidak menjalani pembedahan / sedasi / anestesi'],
                    'skor' => ['3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Pengunaan medika mentosa',
                    'skala' => ['Penggunaan multiple: sedative, ote hypnosis, barbiturate', 'fenotiazin, antidepresan, pencahar, diuretik, narkose Penggunaan salah satu obat diatas', 'Penggunaan medikasi lainnya / tidak ada medikasi'],
                    'skor' => ['3', '2', '1'],
                ],
            ];
        }

        return view('pages.ranapAsesmenDanMonitoringResikoJatuh.show', [
            "title" => "Asesmen Dan Monitoring Risiko Jatuh",
            "menu" => "Rawat Inap",
            "item" => $item,
            "usia" => $usia,
            "today" => $today,
            "data" => $data,
            "monitoring" => $monitoring,
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
        $monitoring = RanapMonitoringResikoJatuhPatient::find($id);
        $details = RanapMonitoringResikoJatuhDetailPatient::where('ranap_monitoring_resiko_jatuh_patient_id', $monitoring->id)->get();
        $item = RawatInapPatient::find($monitoring->rawat_inap_patient_id);
        $today = new DateTime();
        $tgl_lhr = new DateTime($item->queue->patient->tanggal_lhr);
        $usia = $tgl_lhr->diff($today)->y;

        if ($usia > 12 && $usia <= 65) {
            $data = [
                [
                    'faktor_resiko' => 'Riwayat Jatuh',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '25'],
                ],
                [
                    'faktor_resiko' => 'Diagnosa Sekunder',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '25'],
                ],
                [
                    'faktor_resiko' => 'Menggunakan Alat Bantu',
                    'skala' => ['Tidak ada / bedrest / dibantu perawat', 'kruk / tongkat', 'kursi / perabot'],
                    'skor' => ['0', '25', '30'],
                ],
                [
                    'faktor_resiko' => 'Menggunakan Infus / Heparin / Pengencer Darah',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '20'],
                ],
                [
                    'faktor_resiko' => 'Gaya Berjalan',
                    'skala' => ['Normal / Bedrest / Kursi Roda', 'Lemah', 'Terganggu'],
                    'skor' => ['0', '10', '20'],
                ],
                [
                    'faktor_resiko' => 'Status Mental',
                    'skala' => ['Menyadari Kemampuan', 'Lupa akan keterbatasan / pelupa'],
                    'skor' => ['0', '15'],
                ],
            ];
        }
        if ($usia > 65) {
            $data = [
                [
                    'faktor_resiko' => 'Riwayat Jatuh Akhir-Akhir Ini',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '7'],
                ],
                [
                    'faktor_resiko' => 'Perubahan Berkemih (Inkontinensia, Nokturia)',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
                [
                    'faktor_resiko' => 'Kebingungan / Disorientasi',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
                [
                    'faktor_resiko' => 'Depresi',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '4'],
                ],
                [
                    'faktor_resiko' => 'Pusing / Vertigo',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
                [
                    'faktor_resiko' => 'Keterbatasan Mobilitas / Kelemahan Tubuh',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '2'],
                ],
                [
                    'faktor_resiko' => 'Penilaian Buruk (jika tidak kebingungan)',
                    'skala' => ['Tidak', 'Ya'],
                    'skor' => ['0', '3'],
                ],
            ];
        }
        if ($usia <= 12) {
            $data = [
                [
                    'faktor_resiko' => 'Usia',
                    'skala' => ['< 3 tahun', '3-7 tahun', '7-12 tahun', '> 12 tahun'],
                    'skor' => ['4', '3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Jenis Kelamin',
                    'skala' => ['Laki-laki', 'Perempuan'],
                    'skor' => ['2', '1'],
                ],
                [
                    'faktor_resiko' => 'Diagnosis',
                    'skala' => ['Diagnosis Neurologi (riwayat demam tinggi, kejang)', 'Perubahan Oksigenasi (diagnosis respiratorik, dehidrasi, anemia, anokreksia, sinkop, pusing', 'Gangguan Perilaku / psikiatri', 'Diagnosis Lainnya'],
                    'skor' => ['4', '3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Gangguan Kognitif',
                    'skala' => ['Tidak Menyadari keterbatasan diri', 'Lupa akan terhadap adanya keterbatasan', 'Orientasi baik terhadap diri sendiri'],
                    'skor' => ['3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Faktor Lingkungan',
                    'skala' => ['Riwayat jatuh / bayi diletakkan di tempat tidur dewasa', 'Pasien menggunakan alat bantu / bayi diletakkan di dalam tempat tidur bayi / perabot rumah', 'Pasien diletakkan ditempat tidur', 'Area diluar rumah sakit'],
                    'skor' => ['4', '3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Respon terhadap : Pembedahan sedasi / anestesi',
                    'skala' => ['Dalam 24 jam', 'Dalam 48 jam', '> 48 jam atau tidak menjalani pembedahan / sedasi / anestesi'],
                    'skor' => ['3', '2', '1'],
                ],
                [
                    'faktor_resiko' => 'Pengunaan medika mentosa',
                    'skala' => ['Penggunaan multiple: sedative, ote hypnosis, barbiturate', 'fenotiazin, antidepresan, pencahar, diuretik, narkose Penggunaan salah satu obat diatas', 'Penggunaan medikasi lainnya / tidak ada medikasi'],
                    'skor' => ['3', '2', '1'],
                ],
            ];
        }

        return view('pages.ranapAsesmenDanMonitoringResikoJatuh.edit', [
            "title" => "Asesmen Dan Monitoring Risiko Jatuh",
            "menu" => "Rawat Inap",
            "item" => $item,
            "usia" => $usia,
            "today" => $today,
            "data" => $data,
            "monitoring" => $monitoring,
            "details" => $details,
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
        // dd($request->all());
        $maintb = RanapMonitoringResikoJatuhPatient::find($id);
        $maintb->update([
            'rawat_inap_patient_id' => $maintb->rawat_inap_patient_id,
            'patient_id' => $maintb->patient_id,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->input('tanggal'),
            'tipe' => $request->input('tipe'),
            'total_skor' => $request->input('total_skor'),
            'nilai_skor' => $request->input('nilai_skor'),
        ]);

        $dataMonitoringDetail = $request->input('data', []);
        foreach ($dataMonitoringDetail as $detail) {
            RanapMonitoringResikoJatuhDetailPatient::find($detail['id'])->update([
                'ranap_monitoring_resiko_jatuh_patient_id' => $maintb->id,
                'faktor_resiko' => $detail['name'],
                'skor' => $detail['skor'],
            ]);
        }

        return redirect()->route('assesmen/monitoring/resiko/jatuh.detail', $maintb->patient_id)->with('success', 'Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = RanapMonitoringResikoJatuhPatient::find($id);
        RanapMonitoringResikoJatuhDetailPatient::where('ranap_monitoring_resiko_jatuh_patient_id', $item->id)->delete();
        $intervensi = RanapIntervensiResikoJatuhPatient::where('ranap_monitoring_resiko_jatuh_patient_id', $item->id)->firts();
        RanapIntervensiResikoJatuhDetailPatient::where('ranap_intervensi_resiko_jatuh_patient_id', $intervensi->id)->delete();
        $item->delete();
        $intervensi->delete();

        return back()->with('success', 'Berhasil Dihapus');
    }
}
