<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->name;
        $roleId = auth()->user()->role_id;
        $users = User::all();

        if ($roleId == 1) {
            $user = auth()->user();
            $role = Role::find($roleId);

            return view('components/admin/sidebar', compact('users', 'role', 'roleId', 'userID'));
        } else {
            return view('components/admin/sidebar', compact('users'));
        }
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminUserTab()
    {
        $users = User::where('is_active', 1)->get();
        $roles = Role::where('is_active', 1)->get();

        return view('components.admin.section.admin-users', compact('users', 'roles'));
        
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
        $validate = $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => 'required'
            
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id
        ]);

        return redirect(route('admin.userTab'))->with('success', 'User successfully added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->role_id == 1) {
            return redirect('/users/admin-user-tab')->with('warning', 'Administrator cannot be edited.');
        }

        $roles = Role::where('is_active', 1)->get();
    
        $updateUsers = User::where('is_active', 1)->get();

        return view('components.admin.modal.admin-user-update', compact('updateUsers', 'user', 'roles'));
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete(User $user, Request $request)
    {

        if ($user->is_active == 1) {
            $user->is_active = 0;
            $user->save();
        }
        

        return redirect(route('admin.userTab'))->with('success', 'User successfully deleted');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required'
        ]);
        $user->update($data);

        return redirect(route('admin.userTab'))->with('success', 'User successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ddd('yow this is destroy');
    }

    //{{route('userAdmin.edit', ['user'=> $user])}}
}
