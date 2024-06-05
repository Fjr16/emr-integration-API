<?php

namespace App\Http\Controllers;

use App\Models\KemoterapiIntervensiResikoJatuhPatient;
use App\Models\KemoterapiIntervensiResikoJatuhPatientDetail;
use App\Models\KemoterapiMonitoringResikoJatuhPatient;
use App\Models\KemoterapiMonitoringResikoJatuhPatientDetail;
use App\Models\KemoterapiPatient;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KemoterapiMonitoringResikoJatuhPatientController extends Controller
{
    public function create($id)
    {
        $item = KemoterapiPatient::find($id);
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

        return view('pages.kemoterapiMonitoringResikoJatuh.create', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'usia' => $usia,
            'today' => $today,
            'data' => $data,
        ]);
    }

    public function store(Request $request, $id)
    {
        $item = KemoterapiPatient::find($id);

        $dataMainMonitoring['kemoterapi_patient_id'] = $item->id;
        $dataMainMonitoring['patient_id'] = $item->queue->patient->id;
        $dataMainMonitoring['user_id'] = Auth::user()->id;
        $dataMainMonitoring['tanggal'] = $request->input('tanggal');
        $dataMainMonitoring['tipe'] = $request->input('tipe');
        $dataMainMonitoring['total_skor'] = $request->input('total_skor');
        $dataMainMonitoring['nilai_skor'] = $request->input('nilai_skor');
        $maintb = KemoterapiMonitoringResikoJatuhPatient::create($dataMainMonitoring);

        $dataMonitoringDetail = $request->input('data', []);
        foreach ($dataMonitoringDetail as $detail) {
            KemoterapiMonitoringResikoJatuhPatientDetail::create([
                'kemoterapi_monitoring_resiko_jatuh_patient_id' => $maintb->id,
                'faktor_resiko' => $detail['name'],
                'skor' => $detail['skor'],
            ]);
        }

        KemoterapiIntervensiResikoJatuhPatient::create([
            'kemoterapi_patient_id' => $item->id,
            'patient_id' => $item->queue->patient->id,
            'kemoterapi_monitoring_resiko_jatuh_patient_id' => $maintb->id,
        ]);

        return redirect()
            ->route('kemoterapi/patient.show', ['id' => $item->id, 'title' => 'Pasien Kemo'])
            ->with([
                'success' => 'Berhasil Ditambahkan',
                'btn' => 'monitoring resiko jatuh',
            ]);
    }

    public function show($id)
    {
        $monitoring = KemoterapiMonitoringResikoJatuhPatient::find($id);
        $details = KemoterapiMonitoringResikoJatuhPatientDetail::where('kemoterapi_monitoring_resiko_jatuh_patient_id', $monitoring->id)->get();
        $item = KemoterapiPatient::find($monitoring->kemoterapi_patient_id);
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

        return view('pages.kemoterapiMonitoringResikoJatuh.show', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'usia' => $usia,
            'today' => $today,
            'data' => $data,
            'monitoring' => $monitoring,
            'details' => $details,
        ]);
    }

    public function edit($id)
    {
        $monitoring = KemoterapiMonitoringResikoJatuhPatient::find($id);
        $details = KemoterapiMonitoringResikoJatuhPatientDetail::where('kemoterapi_monitoring_resiko_jatuh_patient_id', $monitoring->id)->get();
        $item = KemoterapiPatient::find($monitoring->kemoterapi_patient_id);
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

        return view('pages.kemoterapiMonitoringResikoJatuh.edit', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'usia' => $usia,
            'today' => $today,
            'data' => $data,
            'monitoring' => $monitoring,
            'details' => $details,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $maintb = KemoterapiMonitoringResikoJatuhPatient::find($id);
        $maintb->update([
            'kemoterapi_patient_id' => $maintb->kemoterapi_patient_id,
            'patient_id' => $maintb->patient_id,
            'user_id' => Auth::user()->id,
            'tanggal' => $request->input('tanggal'),
            'tipe' => $request->input('tipe'),
            'total_skor' => $request->input('total_skor'),
            'nilai_skor' => $request->input('nilai_skor'),
        ]);

        $dataMonitoringDetail = $request->input('data', []);
        foreach ($dataMonitoringDetail as $detail) {
            KemoterapiMonitoringResikoJatuhPatientDetail::find($detail['id'])->update([
                'kemoterapi_monitoring_resiko_jatuh_patient_id' => $maintb->id,
                'faktor_resiko' => $detail['name'],
                'skor' => $detail['skor'],
            ]);
        }

        return redirect()
            ->route('kemoterapi/patient.show', ['id' => $maintb->patient_id, 'title' => 'Pasien Kemo'])
            ->with([
                'success' => 'Berhasil Diedit',
                'btn' => 'monitoring resiko jatuh',
            ]);
    }

    public function destroy($id)
    {
        $item = KemoterapiMonitoringResikoJatuhPatient::find($id);
        KemoterapiMonitoringResikoJatuhPatientDetail::where('kemoterapi_monitoring_resiko_jatuh_patient_id', $item->id)->delete();
        $intervensi = KemoterapiIntervensiResikoJatuhPatient::where('kemoterapi_monitoring_resiko_jatuh_patient_id', $item->id)->first();

        if ($intervensi) {
            KemoterapiIntervensiResikoJatuhPatientDetail::where('kemoterapi_intervensi_resiko_jatuh_patient_id', $intervensi->id)->delete();
            $intervensi->delete();
        }
        $item->delete();

        return back()->with([
            'success' => 'Data Berhasil Dihapus',
            'btn' => 'monitoring resiko jatuh',
        ]);
    }
}
