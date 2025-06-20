<?php

namespace App\Http\Controllers;
use App\Models\Department;
use http\Env\Response;
use App\Models\employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        //return Company::find(2)->getEmployee;
        //
        return Department::with('employee')->get();

    }


    public function view(request $request){


            $department=Department::paginate(10);

        $data=compact('department');
     return view('dashboard.admin.department.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url=url('/department/store');
        $title=" Department Registration";
        $department=new Department;
        $data=compact('url','title','department');
        return view('dashboard.admin.department.add')->with($data);
        //return view('company.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $request->validate([
                'name' => 'required ',
                'email' => 'required ',

            ]);
            $department= new Department;
            $department->name=$request['name'];
            $department->email=$request['email'];
        $department->save();



        return redirect('/department/view');
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
        $department =Department::find($id);
        if(is_null($department))
        return redirect('/department/view');
        else
        $title="Update department Detail";
        $url=url('/department/update').'/'.$id;
        $data=compact('department','url','title');
        return view('dashboard.admin.department.add')->with($data);
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
        $request->validate([
        'name' => 'required ',
        'email' => 'required ',
       ]);

        $department=Department::find($id);
        $department->name=$request['name'];
        $department->email=$request['email'];
        $department->save();
       // return back()->with('fail','unrecognized password');
        return redirect('/department/view')->with('status','department details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $department = Department::find($id);

        $department->delete();
        return redirect()->back()->with('status','Department Details Deleted Successfully');
    }



}


