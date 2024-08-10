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
        // $permissions = Permission::all();
        // $permissionPoli = Permission::where('name', 'LIKE', '%pasien poli%')->get();
        // $permissionAsses = Permission::where('name', 'LIKE', '%assesmen awal%')->get();
        // $permissionRadReq = Permission::where('name', 'LIKE', '%permintaan radiologi%')->get();
        // $permissionLabPkReq = Permission::where('name', 'LIKE', '%permintaan labor pk%')->get();
        // $permissionRmePer = Permission::where('name', 'LIKE', '%rme perawat%')->get();
        // $permissionCppt = Permission::where('name', 'LIKE', '%cppt%')->get();
        // $permissionLapTind = Permission::where('name', 'LIKE', '%laporan tindakan%')->get();
        // $permissionResepDok = Permission::where('name', 'LIKE', '%resep dokter%')->get();


        // $permissionRekamMedis = Permission::where('name', 'LIKE', '%pasien rekam medis%')->get();
        // $permissionRegistrasiUlang = Permission::where('name', 'LIKE', '%registrasi ulang antrian%')->first();
        // $permissionAntrian = Permission::where('name', 'LIKE', '%antrian%')->get();
        // $permissionPasien = Permission::where('name', 'LIKE', '%pasien rumah sakit%')->get();
        // $permissionFarmasiRajal = Permission::where('name', 'LIKE', '%farmasi rajal%')->get();
        // $permissionObatFarmasi = Permission::where('name', 'LIKE', '%resep obat%')->get();
        // $permissionBayar = Permission::where('name', 'LIKE', '%pembayaran%')->get();
        // $permissionPemeriksaanRadio = Permission::where('name', 'LIKE', '%pemeriksaan radiologi%')->get();
        // $permissionPemeriksaanLabPk = Permission::where('name', 'LIKE', '%pemeriksaan laboratorium pk%')->get();
        // $permissionMaster = Permission::where('name', 'LIKE', '%master%')->get();
        // $permissionPrintHasilPk = Permission::where('name', 'LIKE', '%print hasil pemeriksaan laboratorium pk%')->get();
        // $permissionPrintHasilRad = Permission::where('name', 'LIKE', '%print hasil pemeriksaan radiologi%')->get();
        // $permissionTransFarmasi = Permission::where('name', 'LIKE', '%obat gudang farmasi%')->get();
        // $permissionStokObat = Permission::where('name', 'LIKE', '%stok obat di rumah sakit%')->get();
        // $permissionDistribusiObat = Permission::where('name', 'LIKE', '%distribusi obat antar unit%')->get();

        // //untuk admin
        $roleAdmin = Role::where('name', 'Administrator')->first();
        // $roleAdmin->givePermissionTo($permissions->pluck('id')->toArray());
        $userAdmin = User::where('name', 'Administrator')->first();
        $userAdmin->syncRoles($roleAdmin->id);

        //dokter
        $roleDokter = Role::where('name', 'Dokter')->first();
        $usersDokter = User::whereBetween('id', [34, 43])->get();
        foreach ($usersDokter as $userDokter) {
            $userDokter->syncRoles($roleDokter->id);
        }
        // $roleDokter->givePermissionTo($permissionPoli->pluck('id')->toArray());
        // $roleDokter->givePermissionTo($permissionAsses->pluck('id')->toArray());
        // $roleDokter->givePermissionTo($permissionRadReq->pluck('id')->toArray());
        // $roleDokter->givePermissionTo($permissionLabPkReq->pluck('id')->toArray());
        // $roleDokter->givePermissionTo($permissionCppt->pluck('id')->toArray());
        // $roleDokter->givePermissionTo($permissionLapTind->pluck('id')->toArray());
        // $roleDokter->givePermissionTo($permissionResepDok->pluck('id')->toArray());
        // $roleDokter->givePermissionTo($permissionPrintHasilPk->pluck('id')->toArray());
        // $roleDokter->givePermissionTo($permissionPrintHasilRad->pluck('id')->toArray());

        // $userDokter = User::where('name', 'dokter')->first();
        // $userDokter->syncRoles($roleDokter->id);
       

        // Perawat Poli
        $rolePerawatRajal = Role::where('name', 'Perawat')->first();
        $userPerawatRajal = User::where('name', 'Perawat')->first();
        $userPerawatRajal->syncRoles($rolePerawatRajal->id);
        // $rolePerawatRajal->givePermissionTo($permissionPoli->pluck('id')->toArray());
        // $rolePerawatRajal->givePermissionTo($permissionAsses->pluck('id')->toArray());
        // $rolePerawatRajal->givePermissionTo($permissionRmePer->pluck('id')->toArray());
        // $rolePerawatRajal->givePermissionTo($permissionCppt->pluck('id')->toArray());
        // $rolePerawatRajal->givePermissionTo($permissionResepDok->pluck('id')->toArray());

        

        //petugas rekam medis
        // $permissionMasterPekerjaan = Permission::where('name', 'LIKE', '%Master Pekerjaan%')->first();
        // $roleRM->givePermissionTo($permissionRekamMedis->pluck('id')->toArray());
        // $roleRM->givePermissionTo($permissionPasien->pluck('id')->toArray());
        // $roleRM->givePermissionTo($permissionRegistrasiUlang->name);
        // $roleRM->givePermissionTo($permissionMasterPekerjaan->name);

        $roleRM = Role::where('name', 'Rekam Medis dan Casemix')->first();
        $userRM = User::where('name', 'Rekam Medis')->first();
        $casemix = User::where('name', 'Casemix')->first();
        $userRM->syncRoles($roleRM->id);
        $casemix->syncRoles($roleRM->id);

        //petugas informasi
        // $roleInformasi->givePermissionTo($permissionAntrian->pluck('id')->toArray());
        // $roleInformasi->givePermissionTo($permissionPasien->pluck('id')->toArray());
        // $roleInformasi->revokePermissionTo($permissionRegistrasiUlang->name);
        // $roleInformasi->givePermissionTo($permissionMasterPekerjaan->name);
        $roleInformasi = Role::where('name', 'Petugas Informasi')->first();
        $userInformasi = User::where('name', 'Petugas Informasi')->first();
        $userInformasi->syncRoles($roleInformasi->id);

        // Petugas Radiologi
        // $rolePetugasRad->givePermissionTo($permissionPemeriksaanRadio->pluck('id')->toArray());
        $rolePetugasRad = Role::where('name', 'petugas radiologi')->first();
        $userRad = User::where('name', 'petugas radiologi')->first();
        $userRad->syncRoles($rolePetugasRad->id);
        // Dokter Radiologi
        // $roleDpjpRad->givePermissionTo($permissionPemeriksaanRadio->pluck('id')->toArray());
        $roleDpjpRad = Role::where('name', 'Validator Radiologi')->first();
        $userDpjpRad = User::where('name', 'dr. Dewa Fadillah,SpB')->first();
        $userDpjpRad->syncRoles($roleDpjpRad->id);

        // Petugas Lab PK
        // $rolePetugasLabPk->givePermissionTo($permissionPemeriksaanLabPk->pluck('id')->toArray());
        $rolePetugasLabPk = Role::where('name', 'Petugas Laboratorium')->first();
        $userLabPk = User::where('name', 'Petugas Laboratorium')->first();
        $userLabPk->syncRoles($rolePetugasLabPk->id);
        // Dokter Lab PK
        // $roleDpjpLabPk->givePermissionTo($permissionPemeriksaanLabPk->pluck('id')->toArray());
        $roleDpjpLabPk = Role::where('name', 'Validator Laboratorium')->first();
        $userLabPk = User::where('name', 'Dr.dr.Ramona,SpB-SpU')->first();
        $userLabPk->syncRoles($roleDpjpLabPk->id);

        // Petugas Apoteker
        // $daftarResepDokter = Permission::where('name', 'LIKE', '%daftar resep dokter%')->first();
        // $roleApoteker->givePermissionTo($daftarResepDokter->name);
        // $roleApoteker->givePermissionTo($permissionFarmasiRajal->pluck('id')->toArray());
        // $roleApoteker->givePermissionTo($permissionObatFarmasi->pluck('id')->toArray());
        $roleApoteker = Role::where('name', 'Apoteker')->first();
        $userApoteker = User::where('name', 'Apoteker')->first();
        $userApoteker->syncRoles($roleApoteker->id);

        // Kasir
        // $roleKasir->givePermissionTo($permissionBayar->pluck('id')->toArray());
        $roleKasir = Role::where('name', 'Kasir')->first();
        $userKasir = User::where('name', 'Kasir')->first();
        $userKasir->syncRoles($roleKasir->id);

        // Petugas Gudang Farmasi
        // $roleGudangFarmasi->givePermissionTo($permissionMaster->pluck('id')->toArray());
        // $roleGudangFarmasi->givePermissionTo($permissionTransFarmasi->pluck('id')->toArray());
        // $roleGudangFarmasi->givePermissionTo($permissionStokObat->pluck('id')->toArray());
        // $roleGudangFarmasi->givePermissionTo($permissionDistribusiObat->pluck('id')->toArray());
        $roleGudangFarmasi = Role::where('name', 'Petugas Gudang')->first();
        $userGudangFarmasi = User::where('name', 'Petugas Gudang')->first();
        $userGudangFarmasi->syncRoles($roleGudangFarmasi->id);
    }
}