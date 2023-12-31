<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function roleTab()
    {
        
        $roleId = auth()->user()->role_id;

        if ( $roleId == 1) {
            $roles = Role::where('is_active', 1)->get();

            return view('components.admin.section.admin-roles', compact('roles'));
        } else {
            return view('components/admin/user-section/user-dashboard')
            ->with('warning', 'You are not an Administrator');
        }
        
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);


        Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/roles/admin-role-tab');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if ($role->id === 1) {
            return redirect('/roles/admin-role-tab')->with('warning', 'Administrator role cannot be edited.');
        }
    
        $updateRoles = Role::where('is_active', 1)->get();
        return view('components.admin.modal.admin-role-update', compact('updateRoles', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',

        ]);
        $role->update($data);

        return redirect(route('admin.roleTab'))->with('success', 'Role successfully updated');
    }

    /* *
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Role::where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete(Role $role, Request $request)
    {
        
        $role->update([
            'is_active' => 0
        ]);

        return redirect(route('admin.roleTab'))->with('success', 'Role successfully deleted');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Role::where('id', $id)
        ->delete();
    }
}
