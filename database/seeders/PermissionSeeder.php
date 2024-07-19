<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeding roles permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        

        // Permission::query()->delete();

        //array permission poli
        $arrPermissionPoli = [
            'jadwal poli',
            'edit jadwal dokter poli',
            'daftar pasien poli',
            'show pasien poli',
            // Kamar
            'lihat status penggunaan ranjang',
            //assesmen awal
            'daftar assesmen awal',
            'tambah assesmen awal',
            'edit assesmen awal',
            'print assesmen awal',
            'delete assesmen awal',
            //permintaan radiologi
            'daftar permintaan radiologi',
            'tambah permintaan radiologi',
            'print permintaan radiologi',
            'delete permintaan radiologi',
            //permintaan labor pk
            'daftar permintaan labor pk',
            'tambah permintaan labor pk',
            'print permintaan labor pk',
            'delete permintaan labor pk',
            //permintaan labor pa
            'daftar permintaan labor pa',
            'tambah permintaan labor pa',
            'print permintaan labor pa',
            'delete permintaan labor pa',
            //rme perawat
            'daftar rme perawat',
            'tambah rme perawat',
            'lihat rme perawat',
            'asuhan keperawatan',
            //cppt
            'daftar cppt',
            'tambah cppt',
            'edit cppt',
            'print cppt',
            'delete cppt',
            'cppt format soap',
            'cppt format adime',
            'cppt tipe',
            'cppt serah terima',
            //prmrj
            'daftar prmrj',
            'tambah prmrj',
            'edit prmrj',
            'print prmrj',
            'delete prmrj',
            //tindakan
            'daftar laporan tindakan',
            'tambah laporan tindakan',
            'edit laporan tindakan',
            'print laporan tindakan',
            'delete laporan tindakan',
            //finish pasien poli
            'finish pasien poli',
            //transfer pasien
            'transfer pasien rekam medis',
            'daftar pasien rekam medis',
            //antrian
            'tambah antrian',
            'daftar antrian',
            'lihat antrian',
            'perbarui status antrian',
            //registrasi ulang antrian
            'registrasi ulang antrian',
            //pasien
            'daftar pasien rumah sakit',
            'tambah pasien rumah sakit',
            'edit pasien rumah sakit',
            'delete pasien rumah sakit',
            //farmasi rajal
            'daftar pasien farmasi rajal',
            'show pasien farmasi rajal',
            'perbarui status farmasi rajal',
            //transaksi farmasi gudang
            'menu pembelian obat gudang farmasi',
            'menu return obat gudang farmasi',
            'menu riwayat distribusi obat gudang farmasi',
            //stok obat
            'menu daftar stok obat di rumah sakit',
            'menu daftar total stok obat di rumah sakit',
            // distribusi obat
            'menu permintaan distribusi obat antar unit',
            'menu respon distribusi obat antar unit',
            //resep obat
            'daftar resep obat',
            'input resep obat',
            'edit resep obat',
            'print resep obat',
            //kasir (pembayaran)
            'daftar pembayaran',
            'show pembayaran',
            'perbarui status pembayaran',
            'print nota pembayaran',
            'lihat detail pembayaran',
            //pemeriksaan radiologi
            'list permintaan pemeriksaan radiologi',
            'atur jadwal pemeriksaan radiologi',
            'edit jadwal pemeriksaan radiologi',
            'daftar jadwal pemeriksaan radiologi',
            'validasi status pemeriksaan radiologi',
            'show detail pemeriksaan radiologi',
            'input hasil pemeriksaan radiologi',
            'print hasil pemeriksaan radiologi',
            //pemeriksaan labor pk
            'list permintaan pemeriksaan laboratorium pk',
            'atur jadwal pemeriksaan laboratorium pk',
            'edit jadwal pemeriksaan laboratorium pk',
            'daftar jadwal pemeriksaan laboratorium pk',
            'input hasil pemeriksaan laboratorium pk',
            'edit hasil pemeriksaan laboratorium pk',
            'print hasil pemeriksaan laboratorium pk',
            'validasi status pemeriksaan laboratorium pk',
            //pemeriksaan labor pa
            'list permintaan pemeriksaan laboratorium pa',
            'atur jadwal pemeriksaan laboratorium pa',
            'edit jadwal pemeriksaan laboratorium pa',
            'daftar jadwal pemeriksaan laboratorium pa',
            'input hasil pemeriksaan laboratorium pa',
            'edit hasil pemeriksaan laboratorium pa',
            'print hasil pemeriksaan laboratorium pa',
            'validasi status pemeriksaan laboratorium pa',
            //resep dokter
            'daftar resep dokter',
            'tambah resep dokter',
            'edit resep dokter',
            'print resep dokter',
            'hapus resep dokter',
            //Pengantar Ranap
            'daftar surat pengantar ranap',
            'tambah surat pengantar ranap',
            'edit surat pengantar ranap',
            'delete surat pengantar ranap',
            //Pasien Ranap
            'daftar pasien ranap',
            //Ranap Skrining Covid
            'daftar skrining covid',
            'tambah skrining covid',
            'edit skrining covid',
            'delete skrining covid',
            // Ranap CPA
            'daftar catatan perjalanan administrasi',
            'tambah catatan perjalanan administrasi',
            // Ranap Tilik Pasien
            'daftar tilik pasien',
            'tambah tilik pasien',
            // Ranap assesmen perawat
            'daftar assesmen keperawatan ranap',
            'tambah assesmen keperawatan ranap',
            'lihat assesmen keperawatan ranap',
            // Ranap Formulir Rekonsiliasi
            'formulir rekonsiliasi dokter',
            'formulir rekonsiliasi apoteker',
            // IGD
            'daftar pasien igd',
            // Diluar map
            'form Kerohanian luar map',
            'form second opinion luar map',
            //Setting
            'master user simrs',
            'master radiologi',
            'master laboratorium pk',
            'master tanggungan pasien',
            'master konsultasi',
            'master jenis tindakan',
            'master tindakan',
            'master operasi',
            'master ruangan',
            'master unit',
            'master spesialis',
            'master role',
            'master pekerjaan',
            'master diagnosa',
            'master daftar icd',
            'master supplier',
            'master pabrik',
            'master obat',
            'master jenis obat',
            'master golongan obat',
            'master bentuk sediaan obat',
            'master tabel konversi',
            'master lantai',
            'master kamar',
            'master tipe ranjang',
            'master ranjang',


            // Other Form Ranap
            'general consent form ranap',
            'surat persetujuan pelayanan pasien form ranap',

            'persetujuan anestesi',
            'persetujuan tindakan bedah',
            'discharge planning (perawat)',
            'discharge planning (gizi & farmasi)',
            'monitoring cairan infus',
            'edukasi pasien anestesi',
            'formulir rekonsiliasi obat',
            'ringkasan masuk dan keluar form ranap',
            'laporan operasi form ranap',
            'assesmen awal medis form ranap',
            'catatan pelayanan pt form ranap',
            'catatan pelayanan pt form ranap create',
            'catatan pelayanan pt form ranap edit',
            'catatan pelayanan pt form ranap delete',
            'catatan pelayanan pt form ranap print',
            'discharge summary form ranap',
            'konsul penyakit dalam form ranap',
            'monitoring pacu',
            'ews anak form ranap',
            'ews dewasa form ranap',
            'hais form ranap',
            'monitoring resiko jatuh form ranap',
            'monitoring status fungsional form ranap',
            'tindakan pelayanan form ranap',
            'asesmen pra sedasi form ranap',
            'asesmen pra anestesi-induksi form ranap',
            'monitoring obat form ranap',
        ];

         // create permissions
         $permissions = collect($arrPermissionPoli)->map(function($permissionName){
            return ['name' => $permissionName, 'guard_name' => 'web'];
         });
         $newPermissions = $permissions->reject(function($permission){
            return Permission::where('name', $permission['name'])->where('guard_name', $permission['guard_name'])->exists();
         });
         Permission::insert($newPermissions->toArray());
    }
}
