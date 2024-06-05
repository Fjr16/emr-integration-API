<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\VillagesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;
use Spatie\Permission\Models\Permission;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\VillagesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;

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
            LaboratoriumRequestCategoryMasterSeeder::class,
            LaboratoriumRequestMasterVariableSeeder::class,
            LaboratoriumRequestMasterDetailSeeder::class,
            PermissionSeeder::class,
            RadiologiSeeder::class,
            RolePermissionSeeder::class,
            RoleSeeder::class,
            RoomDetailSeeder::class,
            RoomSeeder::class,
            UserSeeder::class,
            UserHasPermissionSeeder::class,
            DiagnosisPatientSeeder::class,
            MedicineCategorieSeeder::class,
            MedicineTypeSeeder::class,
            MedicineFormSeeder::class,
            MedicineSeeder::class,
            PatientCategorySeeder::class,
            SpecialistSeeder::class,
            UserSpecialistSeeder::class,
            CostEstimateSimulationSeeder::class,
            TarifLayananSeeder::class,
            DoctorScheduleSeeder::class,
            // seeder untuk daftar wilayah dari package laravolt
            ProvincesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            VillagesSeeder::class,
            JobSeeder::class,
            // RadiologiSeeder::class, buat seeder untuk request master radiologi terlebih dahulu
        ]);
    }
}