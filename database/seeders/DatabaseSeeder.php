<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\VillagesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;
// use Spatie\Permission\Models\Permission;

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
            // Petugas Medis / user,
            RoleSeeder::class,
            PoliklinikSeeder::class,
            UnitSeeder::class,
            UserSeeder::class,
            UserHasPermissionSeeder::class,
            SpecialistSeeder::class,
            // DoctorScheduleSeeder::class,
            // obat
            MedicineCategorieSeeder::class,
            MedicineTypeSeeder::class,
            MedicineFormSeeder::class,
            MedicineSeeder::class,
            // TarifLayananSeeder::class,
            // seeder untuk daftar wilayah dari package laravolt
            ProvincesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            VillagesSeeder::class,
            // 
            ActionSeeder::class,
            PatientCategorySeeder::class,
            JobSeeder::class,
            ProcedureSeeder::class,
            DiagnosticSeeder::class,
        ]);
    }
}