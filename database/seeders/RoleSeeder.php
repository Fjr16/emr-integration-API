<?php

namespace Database\Seeders;

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
            'Petugas Informasi',
            'Rekam Medis dan Casemix',
            'Perawat',
            'Dokter',
            'Apoteker',
            'Petugas Gudang',
            'Kasir',
            'Petugas Radiologi',
            'Validator Radiologi',
            'Petugas Laboratorium',
            'Validator Laboratorium',
            'Administrator',
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
