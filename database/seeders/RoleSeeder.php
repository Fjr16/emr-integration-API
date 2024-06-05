<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::query()->delete();

        $data = [
            'Dokter Poli',
            'Perawat Rajal',
            'Rekam Medis Rajal',
            'Apoteker',
            'Gudang Farmasi',
            'Kasir',
            'Petugas Radiogi',
            'DPJP Radiologi',
            'Petugas Labor PK',
            'DPJP Labor PK',
            'Admin',
            'Petugas Informasi',
            'Admisi Ranap',
            'Perawat Ranap',
            'Dokter Ranap',
            'Perawat OK',
            'Perawat IBA',
            'Petugas Labor PA',
            'DPJP Labor PA',
            'Perawat Penanggung Jawab Pasien',
            'Dokter Umum',
            'Dokter Spesialis',
            'Casemix',
            'Gizi',
            // data dari db lama
            'Administrator',
            'Medical Record ( MR )',
            'Pembayaran ( KASIR )',
            'Apotik (Ranap)',
            'Kamar Operasi ( OK )',
            'Perawat Ruangan',
            'IGD',
            'Laboratorium',
            'BPJS',
            'Dokter',
            'RR',
            'Ruang Praktek 1',
            'Ruang Praktek 2',
            'Loundry',
            'Cleaning Service',
            'Keuangan',
            'Poli',
            'Antrian',
            'Apotik (Rajal)',
            'Depo Kemoterapi',
            'PMKP',
            'Validator',
        ];

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = collect($data)->map(function ($role) {
            return [
                'name' => $role,
                'guard_name' => 'web',
            ];
        });

        Role::insert($roles->toArray());
    }
}
