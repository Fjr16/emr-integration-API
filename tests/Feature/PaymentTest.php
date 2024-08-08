<?php

namespace Tests\Feature;

use App\Models\BillingDoctorAction;
use App\Models\BillingDoctorConsultation;
use App\Models\BillingLaboratory;
use App\Models\BillingOfMedicineFee;
use App\Models\BillingRadiology;
use Tests\TestCase;
use App\Models\KasirPatient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTest extends TestCase
{
    use RefreshDatabase; 

    protected $kasirPatient;
    protected $expectedTotal;

    private function createData(){
        $this->kasirPatient = KasirPatient::factory()->create();
        $this->kasirPatient->billingDoctorConsultations()->save(BillingDoctorConsultation::factory()->make());
        $this->kasirPatient->billingDoctorActions()->save(BillingDoctorAction::factory()->make());
        $this->kasirPatient->billingLaboratories()->save(BillingLaboratory::factory()->make());
        $this->kasirPatient->billingRadiologies()->save(BillingRadiology::factory()->make());
        $this->kasirPatient->billingOfMedicineFees()->save(BillingOfMedicineFee::factory()->make());

        $totalJasa = $this->kasirPatient->billingDoctorConsultations()->sum('tarif') ?? 0;
        $totalTindMedis = $this->kasirPatient->billingDoctorActions()->sum('sub_total') ?? 0;
        $totalRad = $this->kasirPatient->billingRadiologies()->sum('sub_total') ?? 0;
        $totalLab = $this->kasirPatient->billingLaboratories()->sum('sub_total') ?? 0;
        $totalReceipt = $this->kasirPatient->billingOfMedicineFees()->sum('sub_total') ?? 0;
        $this->expectedTotal = $totalJasa + $totalTindMedis + $totalRad + $totalLab + $totalReceipt;
    }
    
    public function test_pembayaran_form_create()
    {
        $response = $this->get('/rajal/kasir/pembayaran');
        $response->assertViewIs('pages.pasienPembayaran.index');
        $response->assertStatus(200);
    }

    public function test_update_updates_status_and_total()
    {
        $this->createData();
        $response = $this->put('/rajal/kasir/pembayaran/update/' . encrypt($this->kasirPatient->id), ['status' => 'FINISHED']);

        $response->assertFound(); // redirect setelah update code 302
        $this->assertDatabaseHas('kasir_patients', [
            'id' => $this->kasirPatient->id,
            'total' => $this->expectedTotal,
            'status' => 'FINISHED',
        ]);
    }
}
