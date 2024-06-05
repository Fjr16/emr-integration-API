<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();
        $permissionPoli = Permission::where('name', 'LIKE', '%pasien poli%')->get();
        $permissionAsses = Permission::where('name', 'LIKE', '%assesmen awal%')->get();
        $permissionRadReq = Permission::where('name', 'LIKE', '%permintaan radiologi%')->get();
        $permissionLabPkReq = Permission::where('name', 'LIKE', '%permintaan labor pk%')->get();
        $permissionLabPaReq = Permission::where('name', 'LIKE', '%permintaan labor pa%')->get();
        $permissionRmePer = Permission::where('name', 'LIKE', '%rme perawat%')->get();
        $permissionAsuhanPer = Permission::where('name', 'LIKE', '%asuhan keperawatan%')->get();
        $permissionCppt = Permission::where('name', 'LIKE', '%cppt%')->get();
        $permissionCpptFormatSoap = Permission::where('name', 'LIKE', '%cppt format soap%')->first();
        $permissionCpptFormatAdime = Permission::where('name', 'LIKE', '%cppt format adime%')->first();
        $permissionCpptTipe = Permission::where('name', 'LIKE', '%cppt tipe%')->first();
        $permissionCpptSerahTerima = Permission::where('name', 'LIKE', '%cppt serah terima%')->first();
        $permissionPrmrj = Permission::where('name', 'LIKE', '%prmrj%')->get();
        $permissionLapTind = Permission::where('name', 'LIKE', '%laporan tindakan%')->get();
        $permissionResepDok = Permission::where('name', 'LIKE', '%resep dokter%')->get();

        $permissionSuratPeng = Permission::where('name', 'LIKE', '%surat pengantar ranap%')->get();
        $permissionPasienRanap = Permission::where('name', 'LIKE', '%pasien ranap%')->get();
        $permissionTilikPasien = Permission::where('name', 'LIKE', '%tilik pasien%')->get();
        $permissionAssesRanap = Permission::where('name', 'LIKE', '%assesmen keperawatan ranap%')->get();
        $permissionSkrinCovidRanap = Permission::where('name', 'LIKE', '%skrining covid%')->get();
        $permissionCPARanap = Permission::where('name', 'LIKE', '%catatan perjalanan administrasi%')->get();

        $permissionRekamMedis = Permission::where('name', 'LIKE', '%pasien rekam medis%')->get();
        $permissionRegistrasiUlang = Permission::where('name', 'LIKE', '%registrasi ulang antrian%')->first();
        // $permissionTambahAntrianRM = Permission::where('name', 'LIKE', '%tambah antrian%')->first();
        $permissionAntrian = Permission::where('name', 'LIKE', '%antrian%')->get();
        $permissionPasien = Permission::where('name', 'LIKE', '%pasien rumah sakit%')->get();
        $permissionFarmasiRajal = Permission::where('name', 'LIKE', '%farmasi rajal%')->get();
        $permissionObatFarmasi = Permission::where('name', 'LIKE', '%resep obat%')->get();
        $permissionBayar = Permission::where('name', 'LIKE', '%pembayaran%')->get();
        $permissionPemeriksaanRadio = Permission::where('name', 'LIKE', '%pemeriksaan radiologi%')->get();
        $permissionPemeriksaanLabPk = Permission::where('name', 'LIKE', '%pemeriksaan laboratorium pk%')->get();
        $permissionPemeriksaanLabPa = Permission::where('name', 'LIKE', '%pemeriksaan laboratorium pa%')->get();
        $permissionMaster = Permission::where('name', 'LIKE', '%master%')->get();
        $permissionPrintHasilPk = Permission::where('name', 'LIKE', '%print hasil pemeriksaan laboratorium pk%')->get();
        $permissionPrintHasilPa = Permission::where('name', 'LIKE', '%print hasil pemeriksaan laboratorium pa%')->get();
        $permissionPrintHasilRad = Permission::where('name', 'LIKE', '%print hasil pemeriksaan radiologi%')->get();
        $permissionFormRekonsiliasiDokter = Permission::where('name', 'LIKE', '%formulir rekonsiliasi dokter%')->first();
        $permissionFormRekonsiliasiApoteker = Permission::where('name', 'LIKE', '%formulir rekonsiliasi apoteker%')->first();
        $permissionStatusRanjang = Permission::where('name', 'LIKE', '%lihat status penggunaan ranjang%')->first();
        $permissionMenuIgd = Permission::where('name', 'LIKE', '%daftar pasien igd%')->first();
        $permissionTransFarmasi = Permission::where('name', 'LIKE', '%obat gudang farmasi%')->get();
        $permissionStokObat = Permission::where('name', 'LIKE', '%stok obat di rumah sakit%')->get();
        $permissionDistribusiObat = Permission::where('name', 'LIKE', '%distribusi obat antar unit%')->get();
        $permissionDiluarMap = Permission::where('name', 'LIKE', '%luar map%')->get();

        // permission ranap
        $permissionDPRanap = Permission::where('name', 'LIKE', '%discharge planning (perawat)%')->first();
        $permissionMoniInfusRanap = Permission::where('name', 'LIKE', '%monitoring cairan infus%')->first();
        $permissionRekonObatRanap = Permission::where('name', 'LIKE', '%formulir rekonsiliasi obat%')->first();
        $permissionLapOperasiRanap = Permission::where('name', 'LIKE', '%laporan operasi form ranap%')->first();
        $permissionAssMedisRanap = Permission::where('name', 'LIKE', '%assesmen awal medis form ranap%')->first();
        $permissionCpptRanap = Permission::where('name', 'LIKE', '%catatan pelayanan pt form ranap%')->get();
        $permissionDiscSummaryRanap = Permission::where('name', 'LIKE', '%discharge summary form ranap%')->first();
        $permissionKonsulPenyDalamRanap = Permission::where('name', 'LIKE', '%konsul penyakit dalam form ranap%')->first();
        $permissionEwsAnakRanap = Permission::where('name', 'LIKE', '%ews anak form ranap%')->first();
        $permissionEwsDewasaRanap = Permission::where('name', 'LIKE', '%ews dewasa form ranap%')->first();
        $permissionHaisRanap = Permission::where('name', 'LIKE', '%hais form ranap%')->first();
        $permissionMoniResJatuhRanap = Permission::where('name', 'LIKE', '%monitoring resiko jatuh form ranap%')->first();
        $permissionMoniStaFungsiRanap = Permission::where('name', 'LIKE', '%monitoring status fungsional form ranap%')->first();
        $permissionTindPelRanap = Permission::where('name', 'LIKE', '%tindakan pelayanan form ranap%')->first();
        $permissionAssPraSedasiRanap = Permission::where('name', 'LIKE', '%asesmen pra sedasi form ranap%')->first();
        $permissionAssPraAnesInduksiRanap = Permission::where('name', 'LIKE', '%asesmen pra anestesi-induksi form ranap%')->first();
        $permissionMoniObatRanap = Permission::where('name', 'LIKE', '%monitoring obat form ranap%')->first();
        $permissionGeneralConsentRanap = Permission::where('name', 'LIKE', '%general consent form ranap%')->first();
        $permissionPersetujuanPelRanap = Permission::where('name', 'LIKE', '%surat persetujuan pelayanan pasien form ranap%')->first();
        $permissionRingMasukKeluarRanap = Permission::where('name', 'LIKE', '%ringkasan masuk dan keluar form ranap%')->first();

        // //untuk admin
        $roleAdmin = Role::where('name', 'Admin')->first();
        $roleAdmin->givePermissionTo($permissions->pluck('id')->toArray());
        $userAdmin = User::where('name', 'Admin')->first();
        $userAdmin->syncRoles($roleAdmin->id);

        //dokter poli
        $roleDokter = Role::where('name', 'Dokter Poli')->first();
        $roleDokter->givePermissionTo($permissionPoli->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionAsses->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionRadReq->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionLabPkReq->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionLabPaReq->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionCppt->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionPrmrj->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionLapTind->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionResepDok->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionSuratPeng->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionPrintHasilPk->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionPrintHasilPa->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionPrintHasilRad->pluck('id')->toArray());
        $roleDokter->revokePermissionTo($permissionCpptFormatAdime->name);
        $roleDokter->givePermissionTo($permissionFormRekonsiliasiDokter->name);

        // ranap
        $roleDokter->givePermissionTo($permissionPasienRanap->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionTilikPasien->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionSkrinCovidRanap->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionCPARanap->pluck('id')->toArray());

        $roleDokter->givePermissionTo($permissionDPRanap->name);
        $roleDokter->givePermissionTo($permissionMoniInfusRanap->name);
        $roleDokter->givePermissionTo($permissionRekonObatRanap->name);
        $roleDokter->givePermissionTo($permissionRingMasukKeluarRanap->name);
        $roleDokter->givePermissionTo($permissionLapOperasiRanap->name);
        $roleDokter->givePermissionTo($permissionAssMedisRanap->name);
        $roleDokter->givePermissionTo($permissionCpptRanap->pluck('id')->toArray());
        $roleDokter->givePermissionTo($permissionDiscSummaryRanap->name);
        $roleDokter->givePermissionTo($permissionKonsulPenyDalamRanap->name);
        $roleDokter->givePermissionTo($permissionEwsAnakRanap->name);
        $roleDokter->givePermissionTo($permissionEwsDewasaRanap->name);
        $roleDokter->givePermissionTo($permissionHaisRanap->name);
        $roleDokter->givePermissionTo($permissionMoniResJatuhRanap->name);
        $roleDokter->givePermissionTo($permissionMoniStaFungsiRanap->name);
        $roleDokter->givePermissionTo($permissionTindPelRanap->name);
        $roleDokter->givePermissionTo($permissionAssPraSedasiRanap->name);
        $roleDokter->givePermissionTo($permissionAssPraAnesInduksiRanap->name);
        $roleDokter->givePermissionTo($permissionMoniObatRanap->name);
        $roleDokter->givePermissionTo($permissionCpptFormatSoap->name);

        // $userDokter = User::where('name', 'dokter')->first();
        // $userDokter->syncRoles($roleDokter->id);
        $usersDokter = User::whereBetween('id', [34, 45])->get();
        foreach ($usersDokter as $userDokter) {
            $userDokter->syncRoles($roleDokter->id);
        }

        // Perawat Poli
        $rolePerawatRajal = Role::where('name', 'Perawat Rajal')->first();
        $rolePerawatRajal->givePermissionTo($permissionPoli->pluck('id')->toArray());
        $rolePerawatRajal->givePermissionTo($permissionAsses->pluck('id')->toArray());
        $rolePerawatRajal->givePermissionTo($permissionRmePer->pluck('id')->toArray());
        $rolePerawatRajal->givePermissionTo($permissionAsuhanPer->pluck('id')->toArray());
        $rolePerawatRajal->givePermissionTo($permissionCppt->pluck('id')->toArray());
        $rolePerawatRajal->revokePermissionTo($permissionCpptFormatAdime->name);
        $rolePerawatRajal->givePermissionTo($permissionResepDok->pluck('id')->toArray());
        $rolePerawatRajal->givePermissionTo($permissionSuratPeng->pluck('id')->toArray());
        $rolePerawatRajal->givePermissionTo($permissionDiluarMap->pluck('id')->toArray());

        $userPerawatRajal = User::where('name', 'Perawat Rajal')->first();
        $userPerawatRajal->syncRoles($rolePerawatRajal->id);

        //petugas rekam medis
        $permissionMasterPekerjaan = Permission::where('name', 'LIKE', '%Master Pekerjaan%')->first();

        $roleRM = Role::where('name', 'Rekam Medis Rajal')->first();
        $roleRM->givePermissionTo($permissionRekamMedis->pluck('id')->toArray());
        $roleRM->givePermissionTo($permissionPasien->pluck('id')->toArray());
        $roleRM->givePermissionTo($permissionRegistrasiUlang->name);
        $roleRM->givePermissionTo($permissionMasterPekerjaan->name);

        $userRM = User::where('name', 'Rekam Medis')->first();
        $userRM->syncRoles($roleRM->id);

        //petugas informasi
        $roleInformasi = Role::where('name', 'Petugas Informasi')->first();
        $roleInformasi->givePermissionTo($permissionAntrian->pluck('id')->toArray());
        $roleInformasi->givePermissionTo($permissionPasien->pluck('id')->toArray());
        $roleInformasi->revokePermissionTo($permissionRegistrasiUlang->name);
        $roleInformasi->givePermissionTo($permissionMasterPekerjaan->name);

        $userInformasi = User::where('name', 'Petugas Informasi')->first();
        $userInformasi->syncRoles($roleInformasi->id);

        // Petugas Radiologi
        $rolePetugasRad = Role::where('name', 'Petugas Radiogi')->first();
        $rolePetugasRad->givePermissionTo($permissionPemeriksaanRadio->pluck('id')->toArray());
        $userRad = User::where('name', 'petugas radiologi')->first();
        $userRad->syncRoles($rolePetugasRad->id);
        // Dokter Radiologi
        $roleDpjpRad = Role::where('name', 'DPJP Radiologi')->first();
        $roleDpjpRad->givePermissionTo($permissionPemeriksaanRadio->pluck('id')->toArray());
        $userDpjpRad = User::where('name', 'Dokter Radiologi')->first();
        $userDpjpRad->syncRoles($roleDpjpRad->id);

        // Petugas Lab PK
        $rolePetugasLabPk = Role::where('name', 'Petugas Labor PK')->first();
        $rolePetugasLabPk->givePermissionTo($permissionPemeriksaanLabPk->pluck('id')->toArray());
        $userLabPk = User::where('name', 'Petugas Laboratorium PK')->first();
        $userLabPk->syncRoles($rolePetugasLabPk->id);
        // Dokter Lab PK
        $roleDpjpLabPk = Role::where('name', 'DPJP Labor PK')->first();
        $roleDpjpLabPk->givePermissionTo($permissionPemeriksaanLabPk->pluck('id')->toArray());
        $userLabPk = User::where('name', 'Dpjp Labor PK')->first();
        $userLabPk->syncRoles($roleDpjpLabPk->id);

        // Petugas Lab PA
        $rolePetugasLabPA = Role::where('name', 'Petugas Labor PA')->first();
        $rolePetugasLabPA->givePermissionTo($permissionPemeriksaanLabPa->pluck('id')->toArray());
        $userLabPA = User::where('name', 'Petugas Laboratorium PA')->first();
        $userLabPA->syncRoles($rolePetugasLabPA->id);
        // Dokter Lab PA
        $roleDpjpLabPA = Role::where('name', 'DPJP Labor PA')->first();
        $roleDpjpLabPA->givePermissionTo($permissionPemeriksaanLabPa->pluck('id')->toArray());
        $userLabPA = User::where('name', 'Dpjp Labor PA')->first();
        $userLabPA->syncRoles($roleDpjpLabPA->id);

        // Petugas Apoteker
        $daftarResepDokter = Permission::where('name', 'LIKE', '%daftar resep dokter%')->first();

        $roleApoteker = Role::where('name', 'Apoteker')->first();
        $roleApoteker->givePermissionTo($permissionFormRekonsiliasiApoteker->name);
        $roleApoteker->givePermissionTo($daftarResepDokter->name);
        $roleApoteker->givePermissionTo($permissionFarmasiRajal->pluck('id')->toArray());
        $roleApoteker->givePermissionTo($permissionObatFarmasi->pluck('id')->toArray());
        $userApoteker = User::where('name', 'Apoteker')->first();
        $userApoteker->syncRoles($roleApoteker->id);

        // Kasir
        $roleKasir = Role::where('name', 'Kasir')->first();
        $roleKasir->givePermissionTo($permissionBayar->pluck('id')->toArray());
        $userKasir = User::where('name', 'Kasir')->first();
        $userKasir->syncRoles($roleKasir->id);

        // Petugas Gudang Farmasi
        $roleGudangFarmasi = Role::where('name', 'Gudang Farmasi')->first();
        $roleGudangFarmasi->givePermissionTo($permissionMaster->pluck('id')->toArray());
        $roleGudangFarmasi->givePermissionTo($permissionTransFarmasi->pluck('id')->toArray());
        $roleGudangFarmasi->givePermissionTo($permissionStokObat->pluck('id')->toArray());
        $roleGudangFarmasi->givePermissionTo($permissionDistribusiObat->pluck('id')->toArray());
        $userGudangFarmasi = User::where('name', 'Petugas Gudang Farmasi')->first();
        $userGudangFarmasi->syncRoles($roleGudangFarmasi->id);

        // Admisi Ranap
        $roleAdmisiRanap = Role::where('name', 'Admisi Ranap')->first();

        $roleAdmisiRanap->givePermissionTo($permissionGeneralConsentRanap->name);
        $roleAdmisiRanap->givePermissionTo($permissionPersetujuanPelRanap->name);
        $roleAdmisiRanap->givePermissionTo($permissionRingMasukKeluarRanap->name);
        $roleAdmisiRanap->givePermissionTo($permissionPasienRanap->pluck('id')->toArray());
        $roleAdmisiRanap->givePermissionTo($permissionSuratPeng->pluck('id')->toArray());

        $userAdmisiRanap = User::where('name', 'Admisi Ranap')->first();
        $userAdmisiRanap->syncRoles($roleAdmisiRanap->id);

        // Perawat Ranap

        $rolePerawatRanap = Role::where('name', 'Perawat Ranap')->first();
        $rolePerawatRanap->givePermissionTo($permissionPasienRanap->pluck('id')->toArray());
        $rolePerawatRanap->givePermissionTo($permissionTilikPasien->pluck('id')->toArray());
        $rolePerawatRanap->givePermissionTo($permissionAssesRanap->pluck('id')->toArray());
        $rolePerawatRanap->givePermissionTo($permissionSkrinCovidRanap->pluck('id')->toArray());
        $rolePerawatRanap->givePermissionTo($permissionCPARanap->pluck('id')->toArray());
        $rolePerawatRanap->givePermissionTo($permissionDiluarMap->pluck('id')->toArray());
        $rolePerawatRanap->givePermissionTo($permissionDPRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionMoniInfusRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionRekonObatRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionRingMasukKeluarRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionLapOperasiRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionAssMedisRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionCpptRanap->pluck('id')->toArray());
        $rolePerawatRanap->givePermissionTo($permissionDiscSummaryRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionKonsulPenyDalamRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionEwsAnakRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionEwsDewasaRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionHaisRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionMoniResJatuhRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionMoniStaFungsiRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionTindPelRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionAssPraSedasiRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionAssPraAnesInduksiRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionMoniObatRanap->name);
        $rolePerawatRanap->givePermissionTo($permissionCpptSerahTerima->name);
        $rolePerawatRanap->givePermissionTo($permissionCpptFormatSoap->name);

        $rolePPJRanap = Role::where('name', 'Perawat Penanggung Jawab Pasien')->first();
        $rolePPJRanap->givePermissionTo($permissionGeneralConsentRanap->name);

        $userPerawatRanap = User::where('name', 'Perawat Ranap')->first();
        $userPerawatRanap->syncRoles($rolePerawatRanap->id);
        // $userPerawatRanap->assignRole($rolePPJRanap->id);

        // Dokter Ranap
        $roleDokterRanap = Role::where('name', 'Dokter Ranap')->first();
        $roleDokterRanap->givePermissionTo($permissionPasienRanap->pluck('id')->toArray());
        $roleDokterRanap->givePermissionTo($permissionTilikPasien->pluck('id')->toArray());
        $roleDokterRanap->givePermissionTo($permissionSkrinCovidRanap->pluck('id')->toArray());
        $roleDokterRanap->givePermissionTo($permissionCPARanap->pluck('id')->toArray());

        $roleDokterRanap->givePermissionTo($permissionDPRanap->name);
        $roleDokterRanap->givePermissionTo($permissionMoniInfusRanap->name);
        $roleDokterRanap->givePermissionTo($permissionRekonObatRanap->name);
        $roleDokterRanap->givePermissionTo($permissionRingMasukKeluarRanap->name);
        $roleDokterRanap->givePermissionTo($permissionLapOperasiRanap->name);
        $roleDokterRanap->givePermissionTo($permissionAssMedisRanap->name);
        $roleDokterRanap->givePermissionTo($permissionCpptRanap->pluck('id')->toArray());
        $roleDokterRanap->givePermissionTo($permissionDiscSummaryRanap->name);
        $roleDokterRanap->givePermissionTo($permissionKonsulPenyDalamRanap->name);
        $roleDokterRanap->givePermissionTo($permissionEwsAnakRanap->name);
        $roleDokterRanap->givePermissionTo($permissionEwsDewasaRanap->name);
        $roleDokterRanap->givePermissionTo($permissionHaisRanap->name);
        $roleDokterRanap->givePermissionTo($permissionMoniResJatuhRanap->name);
        $roleDokterRanap->givePermissionTo($permissionMoniStaFungsiRanap->name);
        $roleDokterRanap->givePermissionTo($permissionTindPelRanap->name);
        $roleDokterRanap->givePermissionTo($permissionAssPraSedasiRanap->name);
        $roleDokterRanap->givePermissionTo($permissionAssPraAnesInduksiRanap->name);
        $roleDokterRanap->givePermissionTo($permissionMoniObatRanap->name);
        $roleDokterRanap->givePermissionTo($permissionCpptFormatSoap->name);

        $userDokterRanap = User::where('name', 'Dokter Ranap')->first();
        $userDokterRanap->syncRoles($roleDokterRanap->id);

        // Dokter Umum
        $roleDokterJaga = Role::where('name', 'Dokter Umum')->first();
        $roleDokterJaga->givePermissionTo($permissionPasienRanap->pluck('id')->toArray());
        $roleDokterJaga->givePermissionTo($permissionCpptRanap->pluck('id')->toArray());
        $roleDokterJaga->givePermissionTo($permissionCpptFormatSoap->name);
        $roleDokterJaga->givePermissionTo($permissionCpptTipe->name);
        $roleDokterJaga->givePermissionTo($permissionCpptFormatSoap->name);

        $userDokterJaga = User::where('name', 'Dokter Jaga')->first();
        $userDokterJaga->syncRoles($roleDokterJaga->id);

        // Casemix
        $roleCasemix = Role::where('name', 'Casemix')->first();
        $userCasemix = User::where('name', 'casemix')->first();
        $userCasemix->syncRoles($roleCasemix->id);
    }
}