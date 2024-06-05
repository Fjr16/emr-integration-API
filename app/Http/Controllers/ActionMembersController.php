<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ActionMemberRates;
use App\Models\ActionMembers;
use App\Models\BillingCaption;
use App\Models\PatientCategory;
use Illuminate\Http\Request;

class ActionMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ActionMembers::all();
        return view('pages.tindakanmember.index', [
            "title" => "Tindakan",
            "menu" => "Setting",
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = Action::all();
        $billing = BillingCaption::all();
        $tanggungan = ['1','2','3','4','5'];
        return view('pages.tindakanmember.create', [
            "title" => "Tindakan",
            "menu" => "Setting",
            "action" => $action,
            "billing" => $billing,
            "tanggungan" => $tanggungan
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
        $data = $request->all();
        $categories = PatientCategory::all();
        $a = ActionMembers::create($data);
        foreach($categories as $category){
            ActionMemberRates::create([
                'action_members_id' => $a->id,
                'patient_category_id' => $category->id
            ]);
        }

        return redirect()->route('action/members.index')->with('success', 'Berhasil Disimpan');
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
        $item = ActionMembers::find($id);
        $action = Action::all();
        $billing = BillingCaption::all();
        $tanggungan = ['1','2','3','4','5'];
        return view('pages.tindakanmember.edit', [
            "title" => "Tindakan",
            "menu" => "Setting",
            "item" => $item,
            "action" => $action,
            "billing" => $billing,
            "tanggungan" => $tanggungan
        ]);
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
        $item = ActionMembers::find($id);
        $data = $request->all();

        $item->update($data);
        
        return redirect()->route('action/members.index')->with('success', 'Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ActionMembers::find($id);
        foreach ($item->actionMemberRates as $rate) {
            $rate->delete();
        }
        $item->delete();
        return redirect()->route('action/members.index')->with('success', 'Berhasil Dihapus');
    }
}
