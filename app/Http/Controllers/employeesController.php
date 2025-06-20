<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use App\Models\Designation;
use Spatie\Permission\Models\Role;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function view(request $request)
    {
        $employee = Employee::paginate(10);
        $department = Department::all();
        $designation = Designation::all();
        $user = User::all();
        $data = compact('employee', 'department', 'designation', 'user');
        return view('dashboard.admin.employee.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url = url('/employee/store');
        $title = " Employee Registration";
        $employee = new Employee;
        $user = new User;
        $department = Department::all();
        $designation = Designation::all();
        $roles=Role::all();
        $data = compact('url', 'title', 'employee', 'department', 'designation', 'user','roles');
       return view('dashboard.admin.employee.add', $data);
        // $department=department::all();
        // $data=compact('department');
        // return view('employee.add')->with($data);
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
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phoneNo' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'is_active' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'joing_date' => 'required',
            'salary' => 'required',
            'email_login' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);

        //Start database transa  DB::beginTransaction();
        DB::beginTransaction();
        try {

            //Create a new employee record
            $employee = new Employee;
            $employee->firstName = $request['firstName'];
            $employee->lastName = $request['lastName'];
            $employee->email = $request['email'];
            $employee->phoneNumber = $request['phoneNo'];
            $employee->gender = $request['gender'];
            $employee->address = $request['address'];
            $employee->department_id = $request['department_id'];
            $employee->designation_id = $request['designation_id'];
            $employee->join_date = Carbon::parse($request['joing_date']);
            $employee->salary = $request['salary'];
            $employee->is_active = $request['is_active'];
            $employee->save();
            //Create a new login record
            $user = new User;
            $user->employee_id = $employee->employee_id;
            $user->name = $request['firstName'];
            $user->email = $request['email_login'];
            $user->password = Hash::make($request['password']);
            $user->save();
            $user->roles()->sync($request->role);
            DB::commit();
        } catch (\Exception $e) {
            //Rollback the transaction
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
        //Redirect with success message
        return redirect('/employee/view')->with('status', 'Employee details added Successfully');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);

        $users = DB::table('users')
            ->where('employee_id', $id)
            ->first();

        if (is_null($employee))
            return redirect('/department/view');
        else
            $title = "Update Employee Detail";
        $url = url('/employee/update') . '/' . $id;
        $department = Department::all();
        $designation = Designation::all();

      $roles=Role::all();

      $id = $users->id ;

      $user =User::find($id);

        $data = compact('url', 'title', 'employee', 'department', 'user', 'designation','roles');

        return view('dashboard.admin.employee.add')->with($data);
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
        $user = DB::table('users')
            ->where('employee_id', $id)
            ->first();


        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phoneNo' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'is_active' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'joing_date' => 'required',
            'salary' => 'required',
            'email_login' => "required|unique:users,email,$user->id",
            'password' => 'required',
            'role' => 'required',
        ]);


        DB::beginTransaction();
        try {
            //update employee record
            $employee = DB::table('employees')
                ->where('employee_id', $id)
                ->update([
                    'firstName' => $request->firstName,
                    'lastName' => $request->lastName,
                    'email' => $request->email,
                    'phoneNumber' => $request->phoneNo,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'department_id' => $request->department_id,
                    'designation_id' => $request->designation_id,
                    'join_date' => Carbon::parse($request->joing_date),
                    'salary' => $request->salary,
                    'is_active' => $request->is_active,
                ]);
            //update login record
            if ($user->password != $request->password) {
                DB::table('users')
                    ->where('employee_id', $id)
                    ->update(['password' => Hash::make($request->password),]);
            }

            $user = DB::table('users')
                ->where('employee_id', $id)
                ->update([
                    'employee_id' => $id,
                    'name' => $request->firstName,
                    'email' => $request->email_login,
                    'role_id' => $request->role,
                ]);
                User::find($id)->roles()->sync($request->role);
            DB::commit();
        } catch (\Exception $e) {
            //Rollback the transaction
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect('/employee/view')->with('status', 'Employee details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $employee = Employee::find($id)->delete();
        return redirect()->back()->with('status', 'Employee Details Deleted Successfully');
    }

}
