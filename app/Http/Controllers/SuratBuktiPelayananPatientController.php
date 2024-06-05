<?php

namespace App\Http\Controllers;

use App\Http\Controllers\arg01\SuratKontrolController;
use App\Models\DoctorPatient;
use App\Models\Queue;
use App\Models\SuratBuktiPelayananPatient;
use App\Models\SuratBuktiPelayananPatientDetail;
use App\Models\SuratBuktiPelayananSekunderAction;
use App\Models\SuratBuktiPelayananSekunderDiagnosis;
use App\Models\SuratKeteranganPatients;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SuratBuktiPelayananPatientController extends Controller
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
        $item = Queue::find($id);
        return view('pages.sbpkigd.create', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            "item" => $item,
        ]);
    }
    public function createSuratKeterangan($id, $surat_id)
    {
        $item = Queue::find($id);
        $data = SuratBuktiPelayananPatient::find($surat_id);
        return view('pages.sbpkigd.createSuratKeterangan', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            "item" => $item,
            "data" => $data,
        ]);
    }

    public function editSuratKeterangan($id)
    {

        $item = SuratKeteranganPatients::find($id);
        return view('pages.sbpkigd.editSuratKeterangan', [
            "title" => "Rawat Jalan",
            "menu" => "In Patient",
            "item" => $item,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeSuratKeterangan(Request $request, $id, $surat_id)
    {

        // dd('id = ' . $id . 'surat_id =' . $surat_id);
        $item = Queue::find($id);

        $tanggal_kunjungan = $request->input('tgl_kunjungan');
        $user = User::find($item->doctorPatient->user_id);
        // dd($user->roomDetail->kode_dokter_poli);
        // // jika dia adalah poli THT
        if ($user->roomDetail->kode_dokter_poli === 'A') {
            $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                ->where('category', 'NON UROLOGI')
                ->where('no_antrian', 'like', 'A%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya A
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
            $data['no_antrian'] = 'A' . $nextNumber;
            // jika dia adalah poli Jantung
        } elseif ($user->roomDetail->kode_dokter_poli === 'B') {

            $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                ->where('category', 'NON UROLOGI')
                ->where('no_antrian', 'like', 'B%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya B
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
            $data['no_antrian'] = 'B' . $nextNumber;

            // jika dia adalahh poli penyakit dalam
        } elseif ($user->roomDetail->kode_dokter_poli === 'C') {
            $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                ->where('category', 'NON UROLOGI')
                ->where('no_antrian', 'like', 'C%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya C
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
            $data['no_antrian'] = 'C' . $nextNumber;


            // jika dia adalah poli Penyakit Dalam 
        } elseif ($user->roomDetail->kode_dokter_poli === 'D') {
            $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                ->where('category', 'NON UROLOGI')
                ->where('no_antrian', 'like', 'D%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya D
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
            $data['no_antrian'] = 'D' . $nextNumber;

            // jika dia adalah poli onkologi
        } elseif ($user->roomDetail->kode_dokter_poli === 'E') {
            $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                ->where('category', 'NON UROLOGI')
                ->where('no_antrian', 'like', 'E%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya E
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
            $data['no_antrian'] = 'E' . $nextNumber;

            // jika dia poli PenyakitDalam 
        } elseif ($user->roomDetail->kode_dokter_poli === 'F') {
            $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                ->where('category', 'NON UROLOGI')
                ->where('no_antrian', 'like', 'F%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya F
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
            $data['no_antrian'] = 'F' . $nextNumber;

            // jika dia adalah poli Orthopedi
        } elseif ($user->roomDetail->kode_dokter_poli === 'G') {
            $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                ->where('category', 'NON UROLOGI')
                ->where('no_antrian', 'like', 'G%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya G
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
            $data['no_antrian'] = 'G' . $nextNumber;

            // jika dia adalah poli beda umum
        } elseif ($user->roomDetail->kode_dokter_poli === 'H') {
            // jika dia adalah poli THT
            $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                ->where('category', 'NON UROLOGI')
                ->where('no_antrian', 'like', 'H%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya H
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
            $data['no_antrian'] = 'H' . $nextNumber;

            // jika dia adalah poli urologi
        } elseif ($user->roomDetail->kode_dokter_poli === 'I') {
            // jika dia adalah poli THT
            $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                ->where('category', 'NON UROLOGI')
                ->where('no_antrian', 'like', 'I%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya I
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 11;
            $data['no_antrian'] = 'I' . $nextNumber;

            // jika dia adalah poli Orthopedi
        } elseif ($user->roomDetail->kode_dokter_poli === 'J') {
            // jika dia adalah poli THT
            $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                ->where('category', 'NON UROLOGI')
                ->where('no_antrian', 'like', 'J%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya J
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
            $data['no_antrian'] = 'J' . $nextNumber;

            // jika dia adalah poli Bedah Umum
        } elseif ($user->roomDetail->kode_dokter_poli === 'K') {
            // jika dia adalah poli THT
            $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                ->where('category', 'NON UROLOGI')
                ->where('no_antrian', 'like', 'K%')
                ->orderBy('no_antrian', 'desc')
                ->first();
            // mengambil antrian terakhir yang awalannya K
            $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
            $data['no_antrian'] = 'K' . $nextNumber;
        }
        $data['patient_id'] = $item->patient_id;
        $data['patient_category_id'] = $item->patient_category_id;
        $data['tgl_antrian'] = $tanggal_kunjungan;
        $data['no_rujukan'] = $item->no_rujukan;
        $data['last_diagnostic'] = $item->last_diagnostic;
        $data['status_antrian'] = 'WAITING';
        $data['category'] = 'NON UROLOGI';
        $data['user_id'] = $item->user_id;
        $data['kuota'] = $item->kuota;
        $data['created_at'] = $tanggal_kunjungan;

        if ($new = Queue::create($data)) {
            $dokterPasien['queue_id'] = $new->id;
            $dokterPasien['user_id'] = $item->doctorPatient->id;
            DoctorPatient::create($dokterPasien);
        }
        SuratKeteranganPatients::create([
            'surat_bukti_pelayanan_patient_id' => $surat_id,
            'queue_id' => $new->id,
            'patient_id' => $item->patient->id,
            'diagnosa' => $request->input('diagnosa'),
            'terapi' => $request->input('terapi'),
            'tgl_surat_rujukan' => $request->input('tgl_surat_rujukan'),
            'fasilitas_rujukan' => $request->input('fasilitas_rujukan'),
            'fasilitas_rujukan_lainnya' => $request->input('fasilitas_rujukan_lainnya'),
            'tgl_kunjungan' => $request->input('tgl_kunjungan'),
            'nomor_antrian' => $new->no_antrian,
            'tindak_lanjut' => $request->input('tindak_lanjut'),
            'tindak_lanjut_lainnya' => $request->input('tindak_lanjut_lainnya'),
        ]);






        return redirect()->route('rajal/show', ['id' => $item->id, 'title' => 'Rawat Jalan'])->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'sbpk',
        ]);
    }

    public function updateSuratKeterangan(Request $request, $id)
    {
        $item = SuratKeteranganPatients::find($id);

        //cekAntrianLama
        $cekSBPK = SuratBuktiPelayananPatient::find($item->surat_bukti_pelayanan_patient_id);
        $oldAntrian = Queue::find($cekSBPK->queue_id);


        $user = User::find($oldAntrian->doctorPatient->user_id);
        // dd($user->roomDetail->kode_dokter_poli);

        $newTanggalKunjungan = $request->tgl_kunjungan;

        if ($newTanggalKunjungan == $item->tgl_kunjungan) {
            $item->update([
                'diagnosa' => $request->input('diagnosa'),
                'terapi' => $request->input('terapi'),
                'tgl_surat_rujukan' => $request->input('tgl_surat_rujukan'),
                'fasilitas_rujukan' => $request->input('fasilitas_rujukan'),
                'fasilitas_rujukan_lainnya' => $request->input('fasilitas_rujukan_lainnya'),
                'tgl_kunjungan' => $request->input('tgl_kunjungan'),
                'tindak_lanjut' => $request->input('tindak_lanjut'),
                'tindak_lanjut_lainnya' => $request->input('tindak_lanjut_lainnya'),
            ]);
        } else {
            $cekAntrian = Queue::where('id', $item->queue_id)->where('patient_id', $item->patient_id)->first();
            $tanggal_kunjungan = $request->input('tgl_kunjungan');
            // jika dia adalah poli THT
            if ($user->roomDetail->kode_dokter_poli === 'A') {
                $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'A%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya A
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                $data['no_antrian'] = 'A' . $nextNumber;
                // jika dia adalah poli Jantung
            } elseif ($user->roomDetail->kode_dokter_poli === 'B') {

                $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'B%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya B
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                $data['no_antrian'] = 'B' . $nextNumber;

                // jika dia adalahh poli penyakit dalam
            } elseif ($user->roomDetail->kode_dokter_poli === 'C') {
                $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'C%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya C
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                $data['no_antrian'] = 'C' . $nextNumber;


                // jika dia adalah poli Penyakit Dalam 
            } elseif ($user->roomDetail->kode_dokter_poli === 'D') {
                $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'D%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya D
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                $data['no_antrian'] = 'D' . $nextNumber;

                // jika dia adalah poli onkologi
            } elseif ($user->roomDetail->kode_dokter_poli === 'E') {
                $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'E%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya E
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                $data['no_antrian'] = 'E' . $nextNumber;

                // jika dia poli PenyakitDalam 
            } elseif ($user->roomDetail->kode_dokter_poli === 'F') {
                $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'F%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya F
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                $data['no_antrian'] = 'F' . $nextNumber;

                // jika dia adalah poli Orthopedi
            } elseif ($user->roomDetail->kode_dokter_poli === 'G') {
                $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'G%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya G
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                $data['no_antrian'] = 'G' . $nextNumber;

                // jika dia adalah poli beda umum
            } elseif ($user->roomDetail->kode_dokter_poli === 'H') {
                // jika dia adalah poli THT
                $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'H%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya H
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                $data['no_antrian'] = 'H' . $nextNumber;

                // jika dia adalah poli urologi
            } elseif ($user->roomDetail->kode_dokter_poli === 'I') {
                // jika dia adalah poli THT
                $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'I%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya I
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 11;
                $data['no_antrian'] = 'I' . $nextNumber;

                // jika dia adalah poli Orthopedi
            } elseif ($user->roomDetail->kode_dokter_poli === 'J') {
                // jika dia adalah poli THT
                $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'J%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya J
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                $data['no_antrian'] = 'J' . $nextNumber;

                // jika dia adalah poli Bedah Umum
            } elseif ($user->roomDetail->kode_dokter_poli === 'K') {
                // jika dia adalah poli THT
                $lastQueue = Queue::whereDate('created_at', $tanggal_kunjungan)
                    ->where('category', 'NON UROLOGI')
                    ->where('no_antrian', 'like', 'K%')
                    ->orderBy('no_antrian', 'desc')
                    ->first();
                // mengambil antrian terakhir yang awalannya K
                $nextNumber = $lastQueue ? (int) substr($lastQueue->no_antrian, 1) + 1 : 1;
                $data['no_antrian'] = 'K' . $nextNumber;
            }

            $data['created_at'] = $tanggal_kunjungan;

            // cek apakah antrian sebelumnya sudah ada tau belum
            if ($cekAntrian) {
                $cekAntrian->update($data);
                $item->update([
                    'diagnosa' => $request->input('diagnosa'),
                    'terapi' => $request->input('terapi'),
                    'tgl_surat_rujukan' => $request->input('tgl_surat_rujukan'),
                    'fasilitas_rujukan' => $request->input('fasilitas_rujukan'),
                    'fasilitas_rujukan_lainnya' => $request->input('fasilitas_rujukan_lainnya'),
                    'tgl_kunjungan' => $tanggal_kunjungan,
                    'created_at' => $tanggal_kunjungan,
                    'nomor_antrian' => $cekAntrian->no_antrian,
                    'tindak_lanjut' => $request->input('tindak_lanjut'),
                    'tindak_lanjut_lainnya' => $request->input('tindak_lanjut_lainnya'),
                    'created_at' => $tanggal_kunjungan,
                ]);
            } else {
                $data['patient_id'] = $item->patient_id;
                $data['patient_category_id'] = $oldAntrian->patient_category_id;
                $data['tgl_antrian'] = $tanggal_kunjungan;
                $data['no_rujukan'] = $item->no_rujukan;
                $data['last_diagnostic'] = $item->last_diagnostic;
                $data['status_antrian'] = 'WAITING';
                $data['category'] = 'NON UROLOGI';
                $data['user_id'] = $oldAntrian->doctorPatient->user_id;
                $data['kuota'] = $item->kuota;
                $data['created_at'] = $tanggal_kunjungan;

                if ($new = Queue::create($data)) {
                    $dokterPasien['queue_id'] = $new->id;
                    $dokterPasien['user_id'] = $oldAntrian->doctorPatient->id;
                    DoctorPatient::create($dokterPasien);
                }

                $item->update([
                    'queue_id' => $new->id,
                    'diagnosa' => $request->input('diagnosa'),
                    'terapi' => $request->input('terapi'),
                    'tgl_surat_rujukan' => $request->input('tgl_surat_rujukan'),
                    'fasilitas_rujukan' => $request->input('fasilitas_rujukan'),
                    'fasilitas_rujukan_lainnya' => $request->input('fasilitas_rujukan_lainnya'),
                    'tgl_kunjungan' => $tanggal_kunjungan,
                    'created_at' => $tanggal_kunjungan,
                    'nomor_antrian' => $new->no_antrian,
                    'tindak_lanjut' => $request->input('tindak_lanjut'),
                    'tindak_lanjut_lainnya' => $request->input('tindak_lanjut_lainnya'),
                    'created_at' => $tanggal_kunjungan,
                ]);
            }
        }



        return redirect()->route('rajal/show', ['id' => $cekSBPK->queue->id, 'title' => 'Rawat Jalan'])->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'sbpk',
        ]);
    }


    public function store(Request $request, $id)
    {
        $item = Queue::find($id);
        $data = $request->all();


        $jenis_kelamin = $request->input('jenis_kelamin', '');
        $berat = $request->input('berat', '');
        $tanggal = $request->input('tanggal', '');
        $jam_keluar = $request->input('jam_keluar', '');
        $tanggal_masuk =  $request->input('tanggal_masuk', '');
        $keterangan = $request->input('keterangan', '');
        $anamnesa = $request->input('anamnesa', '');
        $konsultasi = $request->input('konsultasi', '');
        $usg = $request->input('usg', '');
        $tindakan =  $request->input('tindakan', '');
        $rontgen =  $request->input('rontgen', '');
        $diagnosis_utama = $request->input('diagnosis_utama', '');
        $icdx = $request->input('icdx', '');
        $tindakan_utama = $request->input('tindakan_utama', '');
        $icdg = $request->input('icdg', '');
        $ttd_dokter = $request->input('ttd_dokter');
        $nama_dokter  = $request->input('nama_dokter');
        $mainTb = SuratBuktiPelayananPatient::create([
            'queue_id' => $item->id,
            'patient_id' => $item->patient->id,
            'tanggal' => $tanggal,
            'nama_dokter' => $nama_dokter,
            'ttd_dokter' => $ttd_dokter,
            'tanggal_masuk' => $tanggal_masuk,
            'jam_keluar' => $jam_keluar,
            'keterangan' => $keterangan,
            'anamnesa' => $anamnesa,
            'konsultasi' => $konsultasi,
            'jenis_kelamin' => $jenis_kelamin,
            'berat' => $berat,
            'usg' => $usg,
            'tindakan' => $tindakan,
            'rontgen' => $rontgen,
            'diagnosis_utama' => $diagnosis_utama,
            'icdx' => $icdx,
            'tindakan_utama' => $tindakan_utama,
            'icdg' => $icdg,
        ]);

        //sbpk detail
        $detailDiagnosa = $request->input('diagnosa', []);
        $detailPoliklinik = $request->input('poliklinik', []);
        $detailTdt = $request->input('tdt', []);
        $detailIcd = $request->input('icd', []);
        $detailNamaTindakan = $request->input('nama_tindakan', []);
        foreach ($detailDiagnosa as $key => $diagnosa) {
            SuratBuktiPelayananPatientDetail::create([
                'surat_bukti_pelayanan_patient_id' => $mainTb->id,
                'diagnosa' => $diagnosa,
                'icd' => $detailIcd[$key],
                'nama_tindakan' => $detailNamaTindakan[$key],
                'poliklinik' => $detailPoliklinik[$key],
                'tdt' => $ttd_dokter,
            ]);
        }

        // sbpk diagnosa sekunder
        $sekunderDiagnosaName = $request->input('diagnosa_name', []);
        $sekunderDiagnosaIcd = $request->input('diagnosa_icdx', []);
        // sekunderDiagnosaIcd Tidak masuk kedalam database
        foreach ($sekunderDiagnosaName as $key => $sekunderDiag) {
            SuratBuktiPelayananSekunderDiagnosis::create([
                'surat_bukti_pelayanan_patient_id' => $mainTb->id,
                'diganosa_name' => $sekunderDiag,
                'diagnosa_icdx' => $sekunderDiagnosaIcd[$key],
            ]);
        }
        // sbpk diagnosa sekunder
        $sekunderTindakanName = $request->input('action_name', []);
        $sekunderTindakanIcd = $request->input('action_icdg', []);
        foreach ($sekunderTindakanName as $key => $tindName) {
            SuratBuktiPelayananSekunderAction::create([
                'surat_bukti_pelayanan_patient_id' => $mainTb->id,
                'action_name' => $tindName,
                'action_icdg' => $sekunderTindakanIcd[$key],
            ]);
        }

        return redirect()->route('rajal/keterangan-sbpk.create', ['id' => $item->id, 'surat_id' => $mainTb->id])->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'sbpk',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $item = Queue::find($id);
        $item = SuratBuktiPelayananPatient::find($id);
        $suratKeterangan = SuratKeteranganPatients::where('surat_bukti_pelayanan_patient_id', $item->id)->first();
        return view('pages.surat.sbpk', [
            "title" => "Surat Bukti Pelayanan Kesehatan",
            "menu" => "In Patient",
            "item" => $item,
            "suratKeterangan" => $suratKeterangan,
            // "data" => $data,
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
        $item = SuratBuktiPelayananPatient::find($id);
        $cekSuratKeterangan = SuratKeteranganPatients::where('surat_bukti_pelayanan_patient_id', $item->id)
            ->where('patient_id', $item->patient_id)
            ->where('queue_id', $item->queue_id)->first();
        if (!$cekSuratKeterangan) {
            SuratKeteranganPatients::create([
                'surat_bukti_pelayanan_patient_id' => $item->id,
                'patient_id' => $item->patient_id,
                'queue_id' => $item->queue_id,
                'tgl_surat_rujukan' => $item->updated_at,
                'tgl_kunjungan' => $item->updated_at,
                'nomor_antrian' => '-',

            ]);
        }
        return view('pages.sbpkigd.edit', [
            "title" => "Surat Bukti Pelayanan Kesehatan",
            "menu" => "In Patient",
            "item" => $item,
            "btn" => "edit",
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
        $data = SuratBuktiPelayananPatient::find($id);
        //sbpk patient
        $jenis_kelamin = $request->input('jenis_kelamin', '');
        $berat = $request->input('berat', '');
        $tanggal = $request->input('tanggal', '');
        $jam_keluar = $request->input('jam_keluar', '');
        $tanggal_masuk =  $request->input('tanggal_masuk', '');
        $keterangan = $request->input('keterangan', '');
        $anamnesa = $request->input('anamnesa', '');
        $konsultasi = $request->input('konsultasi', '');
        $usg = $request->input('usg', '');
        $tindakan =  $request->input('tindakan', '');
        $rontgen =  $request->input('rontgen', '');
        $diagnosis_utama = $request->input('diagnosis_utama', '');
        $icdx = $request->input('icdx', '');
        $tindakan_utama = $request->input('tindakan_utama', '');
        $icdg = $request->input('icdg', '');
        // $ttd_dokter = $request->input('ttd_dokter');
        // $nama_dokter  = $request->input('nama_dokter');
        $data->update([
            'tanggal' => $tanggal,
            // 'nama_dokter' => $nama_dokter,
            // 'ttd_dokter' => $ttd_dokter,
            'tanggal_masuk' => $tanggal_masuk,
            'jam_keluar' => $jam_keluar,
            'keterangan' => $keterangan,
            'anamnesa' => $anamnesa,
            'konsultasi' => $konsultasi,
            'jenis_kelamin' => $jenis_kelamin,
            'berat' => $berat,
            'usg' => $usg,
            'tindakan' => $tindakan,
            'rontgen' => $rontgen,
            'diagnosis_utama' => $diagnosis_utama,
            'icdx' => $icdx,
            'tindakan_utama' => $tindakan_utama,
            'icdg' => $icdg,
        ]);

        $data->suratBuktiPelayananPatientDetails()->delete();
        //sbpk detail
        $detailDiagnosa = $request->input('diagnosa', []);
        $detailPoliklinik = $request->input('poliklinik', []);
        $detailTdt = $data->ttd_dokter;
        $detailIcd = $request->input('icd', []);
        $detailNamaTindakan = $request->input('nama_tindakan', []);
        foreach ($detailDiagnosa as $key => $diagnosa) {
            if ($diagnosa != null) {
                SuratBuktiPelayananPatientDetail::create([
                    'surat_bukti_pelayanan_patient_id' => $data->id,
                    'diagnosa' => $diagnosa,
                    'icd' => $detailIcd[$key],
                    'nama_tindakan' => $detailNamaTindakan[$key],
                    'poliklinik' => $detailPoliklinik[$key],
                    'tdt' => $detailTdt
                ]);
            }
        }
        $data->suratBuktiPelayananSekunderDiagnosis()->delete();
        // sbpk diagnosa sekunder
        $sekunderDiagnosaName = $request->input('diagnosa_name', []);
        $sekunderDiagnosaIcd = $request->input('diagnosa_icdx', []);
        // sekunderDiagnosaIcd Tidak masuk kedalam database
        foreach ($sekunderDiagnosaName as $key => $sekunderDiag) {
            if ($sekunderDiag != null) {
                SuratBuktiPelayananSekunderDiagnosis::create([
                    'surat_bukti_pelayanan_patient_id' => $data->id,
                    'diganosa_name' => $sekunderDiag,
                    'diagnosa_icdx' => $sekunderDiagnosaIcd[$key],
                ]);
            }
        }

        $data->suratBuktiPelayananSekunderActions()->delete();
        // sbpk diagnosa sekunder
        $sekunderTindakanName = $request->input('action_name', []);
        $sekunderTindakanIcd = $request->input('action_icdg', []);
        foreach ($sekunderTindakanName as $key => $tindName) {
            if ($tindName != null) {
                SuratBuktiPelayananSekunderAction::create([
                    'surat_bukti_pelayanan_patient_id' => $data->id,
                    'action_name' => $tindName,
                    'action_icdg' => $sekunderTindakanIcd[$key],
                ]);
            }
        }

        return redirect()->route('rajal/show', ['id' => $data->queue_id, 'title' => 'Rawat Jalan'])->with([
            'success' => 'Berhasil Ditambahkan',
            'btn' => 'sbpk',
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
        $data = SuratBuktiPelayananPatient::find($id);
        $data->suratBuktiPelayananPatientDetails()->delete();
        $data->suratBuktiPelayananSekunderDiagnosis()->delete();
        $data->suratBuktiPelayananSekunderActions()->delete();
        $data->suratKeteranganPatients()->delete();
        $data->delete();
        return redirect()->back()->with([
            'success' => 'Berhasil Dihapus',
            'btn' => 'sbpk',
        ]);
    }

    public function getTtd(Request $request)
    {

        try {
            $item = User::findOrFail($request->user_id);
            if (Hash::check($request->password, $item->password)) {
                return response()->json($item->paraf);
            } else {
                throw new Exception("Terjadi Kesalahan, Mohon Periksa Kembali Password Yang Anda Masukkan", 500);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Terjadi Kesalahan, User Tidak Ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
}
