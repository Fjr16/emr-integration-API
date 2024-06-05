<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Role::all();
        return view('pages.role.index', [
            "title" => "Role",
            "menu" => "Setting",
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Role::all();
        $permission = Permission::all();
        return view('pages.role.create', [
            "title" => "Role",
            "menu" => "Setting",
            "data" => $data,
            "permission" => $permission
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
        $role['name'] = $request->input('name');
        $item = Role::create($role);

        $item->givePermissionTo($request->permission_id);
        return redirect()->route('user/role.index')->with('success', 'Role Berhasil di Tambahkan');
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
        $item = Role::find($id);
        $permission = Permission::all();
        return view('pages.role.edit', [
            "title" => "Role",
            "menu" => "Setting",
            "item" => $item,
            "permission" => $permission
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
        $item = Role::find($id);
        $role['name'] = $request->input('name');
        if($item->update($role)){
            if($item->permissions != null){
                $item->syncPermissions($request->permission_id);
            }else{
                $item->givePermissionTo($request->permission_id);
            }
        }

        return redirect()->route('user/role.index')->with('success', 'Berhasil Diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Role::find($id);
        $item->permissions()->detach();
        $item->delete();
        return back()->with('success', 'Akses Berhasil di Hapus');
    }
}
