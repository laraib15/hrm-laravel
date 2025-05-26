<?php

namespace App\Http\Controllers;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();
        return view('dashboard.admin.role.view',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url=url('/role/store');
        $title="Roles";
        $role=new Role;

        $permissions = Permission::all();
        $data=compact('url','title','permissions','role');
       // return view('admin.role.create',compact('permissions'));
        return view('dashboard.admin.role.create')->with( $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
       // dd($request->permission);
        $this->validate($request,[
            'name' =>'required|max:50|unique:roles'
            ]);
        $role = new role;
        $role->name = $request->name;

        $role->save();
        $role->permissions()->sync($request->permission);
        return redirect(route('role.view'))->with('status','Roles Added successfully');
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
        $role =Role::find($id);
        if(is_null($role))
        return redirect('/role/view');
        else
        $title="Update Role Detail";
        $url=url('/role/update').'/'.$id;
        $permissions = Permission::all();
       // dd($role->Permissions());
        $data=compact('permissions','url','title','role');


        return view('dashboard.admin.role.create')->with($data);
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
        $this->validate($request,[
            'name' =>'required|max:50'
            ]);
        $role = role::find($id);
        $role->name = $request->name;
        $role->save();
        $role->permissions()->sync($request->permission);
        return redirect(route('role.view'))->with('status','Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

       role::where('id',$id)->delete();
        return redirect()->back()->with('message','Role Deleted Successfully');
    }
}
