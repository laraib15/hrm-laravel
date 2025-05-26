<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\employee;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = Department::all();
        $data = compact('department');
        return view('dashboard.admin.attendance.attendance')->with($data);
    }
    public function report()
    {
        $department = Department::all();
        $data = compact('department');
        return view('dashboard.admin.attendance.report')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return response()->json();
    }
    public function startWork(Request $request)
    {

        date_default_timezone_set("Asia/Karachi");//set you countary name from below timezone list
       // echo $date = date("Y-m-d H:i:s", time());//now it will show "Asia/Bangkok" or your date time
        $attendance = new Attendance;
        $attendance->employee_id = Auth::user()->employee_id;
        $attendance->check_in = date("H:i:s", time());

        $attendance->status = "Present";
        $attendance->attendance_date = Carbon::now()->format('Y-m-d');
        $attendance->buttonState = "end Work";
        $attendance->attendance_by = "Employee";
        $attendance->save();

        return response()->json(date($attendance->check_in));
    }

    public function endWork(Request $request)
    {
        date_default_timezone_set("Asia/Karachi");//set you countary name from below timezone list
        $employee_id = Auth::user()->employee_id;
        $date = Carbon::now()->format('Y-m-d');
        $attendance = $attendance = Attendance::where('employee_id', $employee_id)->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->first();
        if ($attendance->check_out == null) {
            $attendance->check_out = date("H:i:s", time());
            $attendance->buttonState = "start Work";
            $attendance->save();
        }


       /* $response = array(
            'status' => 'success',

        );*/
        return response()->json($attendance->check_out);
    }


    public function getButtonState()
    {
        $date = Carbon::now()->format('Y-m-d');
        $employee_id = Auth::user()->employee_id;
        $attendance = $attendance = Attendance::where('employee_id', $employee_id)->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->first();

        /*   if(!$attendance || $attendance->check_out!=null ){
        return response()->json(['buttonState'=>'start Work']);
        }else{
        return response()->json(['buttonState'=>'end Work']);
        }*/
        if ($attendance == null) {
            return response()->json(['buttonState' => 'start Work']);
        } else {
            if ($attendance->check_out == null) {
                return response()->json(['buttonState' => 'end Work']);
            } else {
                return response()->json(['buttonState' => 'start Work']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        return view('dashboard.attendance.view');
    }



    public function searchAttendance(Request $request)
    {
        // dd($request->all());
        $month = $request->input('month');
        $year = $request->input('year');
        // $user_id = Auth::user()->employee_id;

        // Get the start and end date of the selected month
        $startDate = Carbon::create($year, $month, 1)->startOfDay();
        $endDate = $startDate->copy()->endOfMonth();

        // Get the attendance records for the selected month
        $attendance = Attendance::where('employee_id', Auth::user()->employee_id)
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->get();

        // Build an array of dates with their status
        $dates = [];
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $dateString = $currentDate->toDateString();
            //dd($dateString);
            $status = "Absent";

            foreach ($attendance as $att) {
                if ($att->attendance_date == $dateString) {
                    $status = $att->status;
                    break;
                }
            }

            $dates[] = ['date' => $dateString, 'status' => $status];
            $currentDate = $currentDate->addDay();
        }


        return response()->json($dates);
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

    public function showAdimn()
    {
        $department = Department::all();
        $data = compact('department');
        return view('dashboard.admin.attendance')->with($data);
    }


    public function searchByDepartment(Request $request)
    {

        $department = $request->department_id;
     $date = $request->date;
        $data = [];
        if ($department != "all") {
            $employees = Employee::where('department_id', $department)->get();
            //dd($employees);

            foreach ($employees as $employee) {
                // echo $employee->employee_id;
                $attendance = Attendance::where('employee_id', $employee->employee_id)->whereDate('attendance_date', $date)->first();
                if ($attendance != null) {
                    if ($attendance->check_in != null && $attendance->check_out != null) {
                        $check_in = Carbon::createFromFormat('H:i:s', $attendance->check_in);
                        $fcheck_in = $check_in->format('H:i');
                        $check_out = Carbon::createFromFormat('H:i:s', $attendance->check_out);
                        $fcheck_out = $check_out->format('H:i');
                        $data[] = ['employee_id' => $attendance->employee_id, 'status' => $attendance->status, 'check_in' => $fcheck_in, 'check_out' => $fcheck_out, 'date' => $date,'attendance_by'=>$attendance->attendance_by];
                    } else if ($attendance->check_in != null && $attendance->check_out == null) {
                        $check_in = Carbon::createFromFormat('H:i:s', $attendance->check_in);
                        $fcheck_in = $check_in->format('H:i');
                        $data[] = ['employee_id' => $attendance->employee_id, 'status' => $attendance->status, 'check_in' => $fcheck_in, 'check_out' => '00:00', 'date' => $date,'attendance_by'=>$attendance->attendance_by];
                    } else if ($attendance->check_in == null && $attendance->check_out != null) {
                        $check_out = Carbon::createFromFormat('H:i:s', $attendance->check_out);
                        $fcheck_out = $check_out->format('H:i');
                        $data[] = ['employee_id' => $attendance->employee_id, 'status' => $attendance->status, 'check_in' => '00:00', 'check_out' => $fcheck_out, 'date' => $date,'attendance_by'=>$attendance->attendance_by];
                    } else if ($attendance->check_in == null && $attendance->check_out == null) {
                        $data[] = ['employee_id' => $attendance->employee_id, 'status' => $attendance->status, 'check_in' => '00:00', 'check_out' => '00:00', 'date' => $date,'attendance_by'=>$attendance->attendance_by];
                    }

                } else
                    $data[] = ['employee_id' => $employee->employee_id, 'status' => 'Absent', 'check_in' => '00:00', 'check_out' => '00:00', 'date' => $date,'attendance_by'=>''];
            }
        } else {
            $employees = Employee::all();

            foreach ($employees as $employee) {
                //echo $employee->employee_id;
                $attendance = Attendance::where('employee_id', $employee->employee_id)->whereDate('attendance_date', $date)->first();
                if ($attendance != null) {
                    if ($attendance->check_in != null && $attendance->check_out != null) {
                        $check_in = Carbon::createFromFormat('H:i:s', $attendance->check_in);
                        $fcheck_in = $check_in->format('H:i');
                        $check_out = Carbon::createFromFormat('H:i:s', $attendance->check_out);
                        $fcheck_out = $check_out->format('H:i');
                        $data[] = ['employee_id' => $attendance->employee_id, 'status' => $attendance->status, 'check_in' => $fcheck_in, 'check_out' => $fcheck_out, 'date' => $date,'attendance_by'=>$attendance->attendance_by];
                    } else if ($attendance->check_in != null && $attendance->check_out == null) {
                        $check_in = Carbon::createFromFormat('H:i:s', $attendance->check_in);
                        $fcheck_in = $check_in->format('H:i');
                        $data[] = ['employee_id' => $attendance->employee_id, 'status' => $attendance->status, 'check_in' => $fcheck_in, 'check_out' => '00:00', 'date' => $date,'attendance_by'=>$attendance->attendance_by];
                    } else if ($attendance->check_in == null && $attendance->check_out != null) {
                        $check_out = Carbon::createFromFormat('H:i:s', $attendance->check_out);
                        $fcheck_out = $check_out->format('H:i');
                        $data[] = ['employee_id' => $attendance->employee_id, 'status' => $attendance->status, 'check_in' => '00:00', 'check_out' => $fcheck_out, 'date' => $date,'attendance_by'=>$attendance->attendance_by];
                    } else if ($attendance->check_in == null && $attendance->check_out == null) {
                        $data[] = ['employee_id' => $attendance->employee_id, 'status' => $attendance->status, 'check_in' => '00:00', 'check_out' => '00:00', 'date' => $date,'attendance_by'=>$attendance->attendance_by];
                    }

                }  else
                    $data[] = ['employee_id' => $employee->employee_id, 'status' => 'Absent', 'check_in' => '00:00', 'check_out' => '00:00', 'date' => $date,'attendance_by'=>''];
            }
        }
        return response()->json($data);
    }
    function action(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == 'edit') {

                $data = array(
                    'status' => $request->input('status'),
                    'check_in' => $request->input('check_in'),
                    'check_out' => $request->input('check_out')
                );

                $user = DB::table('attendances')
                    ->where('employee_id', $request->input('employee_id'))->whereDate('attendance_date', $request->input('date'))
                    ->first();


                if ($request->status!='Absent' && $user != null ) {
                    DB::table('attendances')
                        ->where('employee_id', $request->input('employee_id'))->whereDate('attendance_date',  $request->input('date'))
                        ->update($data);

                } else if(!$user  &&  $request->status!='Absent' ) {
                    ;
                    $attendance = new Attendance;
                    $attendance->employee_id = $request->input('employee_id');
                    $attendance->check_in = $request->input('check_in');
                    $attendance->check_out = $request->input('check_out');
                    $attendance->attendance_by='Administrator';
                    $attendance->status = $request->input('status');
                    $attendance->attendance_date = $request->input('date');

                    $attendance->save();
                }
                else if($request->status=='Absent' && $user != null){
                    DB::table('attendances')
                    ->where('employee_id', $request->input('employee_id'))->whereDate('attendance_date', $request->input('date'))
                    ->delete();
                }

            }

            return response()->json($request);
        }
    }
    public function attendanceReport(Request $request)
    { $department = $request->department_id;
        $month = $request->input('month');
        $year = $request->input('year');
        $dates = [];
        // Get the start and end date of the selected month
        $startDate = Carbon::create($year, $month, 1)->startOfDay();
        $endDate = $startDate->copy()->endOfMonth();

        // Get the attendance records for the selected month


            if ($department != "all") {

                $employees = Employee::where('department_id', $department)->get();

                //dd($employees);

                foreach ($employees as $employee) {
                    $department = Department::where('department_id', $employee->department_id)->first();
                    $startDate = Carbon::create($year, $month, 1)->startOfDay();
                    $endDate = $startDate->copy()->endOfMonth();
                  //  echo $employee->employee_id;
                    $attendance = Attendance::where('employee_id', $employee->employee_id)->whereBetween('attendance_date', [$startDate, $endDate])
                    ->get();
                    if ($attendance != null) {

                        $currentDate = $startDate;
                        while ($currentDate <= $endDate) {
                            $dateString = $currentDate->toDateString();
                            //dd($dateString);
                            $status = "Absent";

                            foreach ($attendance as $att) {
                                if ($att->attendance_date == $dateString) {
                                    $status = $att->status;
                                    break;
                                }
                            }
                            $day = date('d', strtotime($dateString));
                            $dates[] = ['employee_id'=>$employee->employee_id,'department'=> $department->name,'date' => $day, 'status' => $status,'name'=>$employee->firstName." ".$employee->lastName];
                            $currentDate = $currentDate->addDay();
                    }
                }

        // Build an array of dates with their status
            }
            return response()->json( $dates);
        }
        else {

            $employees = Employee::all();
            foreach ($employees as $employee) {
                $department = Department::where('department_id', $employee->department_id)->first();
                $startDate = Carbon::create($year, $month, 1)->startOfDay();
                $endDate = $startDate->copy()->endOfMonth();
              //  echo $employee->employee_id;
                $attendance = Attendance::where('employee_id', $employee->employee_id)->whereBetween('attendance_date', [$startDate, $endDate])
                ->get();
                if ($attendance != null) {

                    $currentDate = $startDate;
                    while ($currentDate <= $endDate) {
                        $dateString = $currentDate->toDateString();
                        //dd($dateString);
                        $status = "Absent";

                        foreach ($attendance as $att) {
                            if ($att->attendance_date == $dateString) {
                                $status = $att->status;

                                break;
                            }
                        }
                        $day = date('d', strtotime($dateString));
                       // $name=$employee->firstName." ".$employee->lastName;
                        $dates[] = ['employee_id'=>$employee->employee_id,'department'=> $department->name,'date' => $day, 'status' => $status,'name'=>$employee->firstName." ".$employee->lastName];
                        $currentDate = $currentDate->addDay();
                }
            }

    // Build an array of dates with their status
        }
        return response()->json( $dates);
        }
}
}
