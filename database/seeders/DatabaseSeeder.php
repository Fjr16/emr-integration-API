<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\VillagesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // PermissionSeeder::class,
            RoleSeeder::class,
            RoomDetailSeeder::class,
            RoomSeeder::class,
            UserSeeder::class,
            // UserHasPermissionSeeder::class,
            MedicineCategorieSeeder::class,
            MedicineTypeSeeder::class,
            MedicineFormSeeder::class,
            MedicineSeeder::class,
            PatientCategorySeeder::class,
            SpecialistSeeder::class,
            UserSpecialistSeeder::class,
            // TarifLayananSeeder::class,
            DoctorScheduleSeeder::class,
            // seeder untuk daftar wilayah dari package laravolt
            ProvincesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            VillagesSeeder::class,
            // 
            JobSeeder::class,
            UnitSeeder::class,
            ActionSeeder::class,
            ProcedureSeeder::class,
            DiagnosticSeeder::class,
            // RadiologiSeeder::class, buat seeder untuk request master radiologi terlebih dahulu
        ]);
    }
}