<?php

namespace App\Http\Controllers;
use App\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permission=Permission::all();

        return view('dashboard.admin.permission.view',compact('permission'));
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
//dd($request->all());
    $this->validate($request,[
        'name' => ['required',Rule::unique('permissions')->where(function ($query) {
            return $query->where('for', request()->for);
        }),
    ],
        'for'  => 'required'
        ]);
    $permission = new Permission;
    $permission->name = $request->name;
    $permission->for = $request->for;
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
        $this->validate($request,[
            'name' => 'required|max:50',
            'for'  => 'required'
            ]);
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->for = $request->for;
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
