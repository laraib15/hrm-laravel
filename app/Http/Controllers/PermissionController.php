<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions=Permission::all();
$grouped = $permissions->groupBy(function ($permission) {
        return explode('.', $permission->name)[0]; // department, employee
    });
    
        return view('dashboard.admin.permission.view',compact('grouped'));
    }
    public function create()
    {

        $url=url('/permission/store');
        $title="Permission";
        $permission=new Permission;
        $data=compact('url','title','permission');       
        return view('dashboard.admin.permission.create')->with( $data);
    }
    public function store(request $request){

       
   $validated= $this->validate($request,[

        'action' =>'required',
        'for'  => 'required'
        ]);
         // Combine module and action into permission name
    $name = strtolower($validated['for'] . '.' . $validated['action']);

    // Check uniqueness manually
    if (Permission::where('name', $name)->exists()) {
        
        return back()->withErrors(['Permission already exists.'])->withInput();
    }
   
    $permission = new Permission;
    $permission->name = $name;   
    $permission->save();

    return redirect(route('permission.view'))->with('status','Permission Added successfully');
    }
    public function edit($id)
    {
        $permission =Permission::find($id);
        if(is_null($permission))
        return redirect('/permission/view');
        else
        $title="Update permission Detail";
        $url=url('/permission/update').'/'.$id;
        $data=compact('permission','url','title');
        
        return view('dashboard.admin.permission.create')->with($data);
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
        $validated= $this->validate($request,[

        'action' =>'required',
        'for'  => 'required'
        ]);
         // Combine module and action into permission name
    $name = strtolower($validated['for'] . '.' . $validated['action']);

    // Check uniqueness manually
    if (Permission::where('name', $name)->exists()) {
        
        return back()->withErrors(['Permission already exists.'])->withInput();
    }
        $permission = Permission::find($id);
        $permission->name = $name;
        
        $permission->save();

        return redirect(route('permission.view'))->with('status','Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Permission::where('id',$id)->delete();
        return redirect()->back()->with('message','Permission Deleted Successfully');
    }
}
