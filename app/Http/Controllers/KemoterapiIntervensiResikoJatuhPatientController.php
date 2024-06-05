<?php

namespace App\Http\Controllers;

use App\Models\KemoterapiIntervensiResikoJatuhPatient;
use App\Models\KemoterapiIntervensiResikoJatuhPatientDetail;
use App\Models\KemoterapiMonitoringResikoJatuhPatient;
use App\Models\KemoterapiPatient;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KemoterapiIntervensiResikoJatuhPatientController extends Controller
{
    public function create($id)
    {
        $item = KemoterapiIntervensiResikoJatuhPatient::where('kemoterapi_monitoring_resiko_jatuh_patient_id', $id)->first();
        if (!$item) {
            $monitoringKemo = KemoterapiMonitoringResikoJatuhPatient::find($id);
            $item = KemoterapiIntervensiResikoJatuhPatient::create([
                'kemoterapi_patient_id' => $monitoringKemo->kemoterapiPatient->id,
                'patient_id' => $monitoringKemo->kemoterapiPatient->queue->patient->id,
                'kemoterapi_monitoring_resiko_jatuh_patient_id' => $monitoringKemo->id,
            ]);
        }
        $today = new DateTime();

        if ($item->kemoterapiMonitoringResikoJatuhPatient->nilai_skor == 'RR') {
            $data = ['Lakukan orientasi terhadap lingkungan dan rutinitas RS:', 'Ruangan rapi, pencahayaan yang cukup, jauhkan kabel dari jalur berjalan pasien dan keluarga', 'Pastikan tempat tidur dalam keadaan rendah dan roda terkunci Kedua pagar pengaman tempat tidur terpasang dengan baik', 'Kedua pagar pengaman tempat tidur terpasang dengan baik', 'Barang pribadi dalam jangkauan (handphone, air minum, kacamata, alat bantu)', 'Edukasi pasien dan keluarga untuk turun dari tempat tidur secara bertahap', 'Anjurkan pasien tidak memakai sandal/sepatu/kaos kaki yang licin', 'Edukasi pasien dan keluarga mengenai pencegahan risiko jatuh', 'Informasikan pasien dan keluarga jika membutuhkan perawat'];
        } elseif ($item->kemoterapiMonitoringResikoJatuhPatient->nilai_skor == 'RS') {
            $data = ['Lakukan semua intervensi risiko jatuh rendah', 'Pintu tidak dalam keadaan terkunci', 'Edukasi pasien/keluarga untuk mendampingi pasien dalam mobilisasi', 'Informasikan pasien menggunakan handrail', 'Gunakan alat bantu jalan (walker/tongkat/kursi/roda)', 'Optimalisasi penggunaan kacamata dan alat bantu dengar(jika perlu)', 'Pantau jika pasien mengeluhkan pusing/vertigo dan ajari bangun dari tempat tidur secara perlahan', 'Pantau obat-obatan yang meningkatkan predisposisi risiko jatuh', 'Libatkan keluarga dan bantu pasien jika diperlukan', 'Partisipasi keluarga dalam keselamatan pasien'];
        } elseif ($item->kemoterapiMonitoringResikoJatuhPatient->nilai_skor == 'RT') {
            $data = ['Lakukan semua intervensi risiko jatuh (risiko jatuh rendah / risiko jatuh sedang / risiko jatuh tinggi)', 'Pasang penanda risiko jatuh dengan menjepitkan kancing warna kuning pada gelang identitas', 'Pasang segitiga kuning pada tempat tidur pasien', 'Komunikasikan pasien risiko jatuh tinggi pada setiap pergantian shift', 'Tawarkan pasien menggunakan pispot/urinal untuk eliminasi/defekasi', 'Jangan tinggalkan pasien sendiri dikamar', 'Informasikan pasien/keluarga untuk tidak mengunci pintu kamar dan pintu kamar mandi dan gunakan tempat duduk saat mandi', 'Monitor pasien setiap 4 jam', 'Edukasi pasien /keluarga tentang efek samping obat'];
        }
        return view('pages.kemoterapiIntervensiPencegahanResikoJatuh.create', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'today' => $today,
            'data' => $data,
        ]);
    }

    public function store(Request $request, $id)
    {
        $item = KemoterapiIntervensiResikoJatuhPatient::find($id);
        $data['tanggal'] = $request->input('tanggal');
        $data['user_id'] = Auth::user()->id;
        $item->update($data);

        $tindakans = $request->input('tindakan', []);

        $details = KemoterapiIntervensiResikoJatuhPatientDetail::where('kemoterapi_intervensi_resiko_jatuh_patient_id', $item->id)->get();
        if ($details) {
            KemoterapiIntervensiResikoJatuhPatientDetail::where('kemoterapi_intervensi_resiko_jatuh_patient_id', $item->id)->delete();
            foreach ($tindakans as $tindakan) {
                KemoterapiIntervensiResikoJatuhPatientDetail::create([
                    'kemoterapi_intervensi_resiko_jatuh_patient_id' => $item->id,
                    'tindakan' => $tindakan,
                ]);
            }
        } else {
            foreach ($tindakans as $tindakan) {
                KemoterapiIntervensiResikoJatuhPatientDetail::create([
                    'kemoterapi_intervensi_resiko_jatuh_patient_id' => $item->id,
                    'tindakan' => $tindakan,
                ]);
            }
        }

        return redirect()
            ->route('kemoterapi/patient.show', ['id' => $item->patient_id, 'title' => 'Pasien Kemo'])
            ->with([
                'success' => 'Berhasil Ditambah',
                'btn' => 'monitoring resiko jatuh',
            ]);
    }

    public function show($id)
    {
        $item = KemoterapiIntervensiResikoJatuhPatient::find($id);
        $details = KemoterapiIntervensiResikoJatuhPatientDetail::where('kemoterapi_intervensi_resiko_jatuh_patient_id', $item->id)->get();

        return view('pages.kemoterapiIntervensiPencegahanResikoJatuh.show', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'details' => $details,
        ]);
    }

    public function edit($id)
    {
        $item = KemoterapiIntervensiResikoJatuhPatient::where('kemoterapi_monitoring_resiko_jatuh_patient_id', $id)->first();
        $details = KemoterapiIntervensiResikoJatuhPatientDetail::where('kemoterapi_intervensi_resiko_jatuh_patient_id', $item->id)->get();

        if ($item->kemoterapiMonitoringResikoJatuhPatient->nilai_skor == 'RR') {
            $data = [
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
        } elseif ($item->kemoterapiMonitoringResikoJatuhPatient->nilai_skor == 'RS') {
            $data = ['Lakukan semua intervensi risiko jatuh rendah', 'Pintu tidak dalam keadaan terkunci', 'Edukasi pasien/keluarga untuk mendampingi pasien dalam mobilisasi', 'Informasikan pasien menggunakan handrail', 'Gunakan alat bantu jalan (walker/tongkat/kursi/roda)', 'Optimalisasi penggunaan kacamata dan alat bantu dengar(jika perlu)', 'Pantau jika pasien mengeluhkan pusing/vertigo dan ajari bangun dari tempat tidur secara perlahan', 'Pantau obat-obatan yang meningkatkan predisposisi risiko jatuh', 'Libatkan keluarga dan bantu pasien jika diperlukan', 'Partisipasi keluarga dalam keselamatan pasien'];
        } elseif ($item->kemoterapiMonitoringResikoJatuhPatient->nilai_skor == 'RT') {
            $data = ['Lakukan semua intervensi risiko jatuh (risiko jatuh rendah / risiko jatuh sedang / risiko jatuh tinggi)', 'Pasang penanda risiko jatuh dengan menjepitkan kancing warna kuning pada gelang identitas', 'Pasang segitiga kuning pada tempat tidur pasien', 'Komunikasikan pasien risiko jatuh tinggi pada setiap pergantian shift', 'Tawarkan pasien menggunakan pispot/urinal untuk eliminasi/defekasi', 'Jangan tinggalkan pasien sendiri dikamar', 'Informasikan pasien/keluarga untuk tidak mengunci pintu kamar dan pintu kamar mandi dan gunakan tempat duduk saat mandi', 'Monitor pasien setiap 4 jam', 'Edukasi pasien /keluarga tentang efek samping obat'];
        }
        return view('pages.kemoterapiIntervensiPencegahanResikoJatuh.edit', [
            'title' => 'Pasien Kemo',
            'menu' => 'Kemoterapi',
            'item' => $item,
            'details' => $details,
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = KemoterapiIntervensiResikoJatuhPatient::find($id);
        $data['tanggal'] = $request->input('tanggal');
        $data['user_id'] = Auth::user()->id;
        $item->update($data);

        $tindakans = $request->input('tindakan', []);

        KemoterapiIntervensiResikoJatuhPatientDetail::where('kemoterapi_intervensi_resiko_jatuh_patient_id', $item->id)->delete();

        foreach ($tindakans as $tindakan) {
            KemoterapiIntervensiResikoJatuhPatientDetail::create([
                'kemoterapi_intervensi_resiko_jatuh_patient_id' => $item->id,
                'tindakan' => $tindakan,
            ]);
        }

        return redirect()
            ->route('kemoterapi/patient.show', ['id' => $item->patient_id, 'title' => 'Pasien Kemo'])
            ->with([
                'success' => 'Berhasil Diedit',
                'btn' => 'monitoring resiko jatuh',
            ]);
    }

    public function destroy($id)
    {
        $item = KemoterapiIntervensiResikoJatuhPatient::find($id);
        KemoterapiIntervensiResikoJatuhPatientDetail::where('kemoterapi_intervensi_resiko_jatuh_patient_id', $item->id)->delete();
        $item->update([
            'user_id' => null,
            'tanggal' => null,
        ]);

        return back()->with([
            'success' => 'Data Berhasil Dihapus',
            'btn' => 'monitoring resiko jatuh',
        ]);
    }
}
