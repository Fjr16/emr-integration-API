<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
use App\Models\DiagnosticSecondary;
use App\Models\DiagnosticProcedurePatient;

class DiagnosticProcedurePatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateDiagnosis(Request $request, $id)
    {
        $item = Queue::find($id);

        $diagnosaPrimerId = $request->input('diagnostic_primer_id');
        $diagnosaPrimerText = $request->input('diagnosa_primer_text');
        $diagnosaSekunderText = $request->input('diagnosa_sekunder_text');

        if ($item->diagnosticProcedurePatient) {
            $itemDiag = $item->diagnosticProcedurePatient;
            $itemDiag->update([
                'diagnostic_id' => $diagnosaPrimerId,
                'desc_diagnosa_primer' => $diagnosaPrimerText,
                'desc_diagnosa_sekunder' => $diagnosaSekunderText,
            ]);
        }else{
            $itemDiag = DiagnosticProcedurePatient::create([
                'queue_id' => $item->id,
                'diagnostic_id' => $diagnosaPrimerId,
                'desc_diagnosa_primer' => $diagnosaPrimerText,
                'desc_diagnosa_sekunder' => $diagnosaSekunderText,
            ]);
        }

        $diagnosaSekunderIds = $request->input('diagnostic_sekunder_id', []);
        $itemDiag->diagnosticSecondary()->delete();
        if (!empty($diagnosaSekunderIds)) {
            foreach($diagnosaSekunderIds as $id){
                DiagnosticSecondary::create([
                    'diagnostic_procedure_patient_id' => $itemDiag->id,
                    'diagnostic_id' => $id,
                ]);
            }
        }

        return back()->with([
            'success' => 'Berhasil Diperbarui',
            'btn' => 'diag-tind',
            'diag-tind' => 'diagnosa',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProcedure(Request $request, $id)
    {
        $item = Queue::find($id);
        $procedureId = $request->input('procedure_id');
        $procedureText = $request->input('procedure_text');

        if ($item->diagnosticProcedurePatient) {
            $itemDiag = $item->diagnosticProcedurePatient;
            $itemDiag->update([
                'procedure_id' => $procedureId,
                'desc_prosedure' => $procedureText,
            ]);
        }else{
            DiagnosticProcedurePatient::create([
                'queue_id' => $item->id,
                'procedure_id' => $procedureId,
                'desc_prosedure' => $procedureText,
            ]);
        }

        return back()->with([
            'success' => 'Berhasil Diperbarui',
            'btn' => 'diag-tind',
            'diag-tind' => 'prosedur',
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
