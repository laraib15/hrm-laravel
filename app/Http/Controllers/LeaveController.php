<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\leave;

class LeaveController extends Controller
{
    //
    public function index()
    {
        $title="Apply for Leave ";
$url=url('/leave');
$leave= new Leave;
$data = compact('url', 'title','leave');
        return view('dashboard.leave.add')->with($data);
    }

public function store(Request $request)
{
    // Check if the user has an associated employee record
    if (!auth()->user()->employee_id) {
        return redirect()->back()->withErrors([
            'error' => 'You are not associated with any employee record.',
        ]);
    }

    // Validate request
    $validated = $request->validate([
        'type'        => 'required|string|max:255',
        'start_date'  => 'required|date',
        'end_date'    => 'required|date|after_or_equal:start_date',
        'reason'      => 'nullable|string|max:1000',
    ]);

    try {
        // Attempt to insert the leave record
        DB::table('leaves')->insert([
            'employee_id' => auth()->user()->employee_id,
            'type'        => ucfirst($validated['type']),
            'start_date'  => $validated['start_date'],
            'end_date'    => $validated['end_date'],
            'reason'      => ucfirst($validated['reason'] ?? ''),

        ]);

        return redirect('/leave/view')->with('status', 'Successfully applied for leave.');

    } catch (\Exception $e) {
        // Log the error for developer reference
        Log::error('Leave Insert Error: '.$e->getMessage());

        // Redirect back with a user-friendly message
        return redirect()->back()->withErrors([
            'error' => 'Something went wrong while applying for leave. Please try again later.',
        ])->withInput();
    }
}

    public function view(request $request){
$leave=leave::all();

$data=compact('leave');
        return view('dashboard.leave.view')->with($data);
    }
    public function edit($id)
    {
        $leave =Leave::find($id);
        if(is_null($leave))
        return redirect('leave/view');
        else
        $title="Update Leave Detail";
        $url=url('/leave-update').'/'.$id;
        $data=compact('leave','url','title');
        return view('dashboard.leave.add')->with($data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
        'type' => 'required ',
        'start_date' => 'required ',
        'end_date' => 'required ',

       ]);

       $startDate = $request->start_date;
       $endDate = $request->end_date;

        $leave=DB::table('leaves')
        ->where('leave_id', $id)
        ->update([
                   'status'=> $request->status,
        ]);

        if($request->status=="Approved"){

            for ($date = $startDate; $date <= $endDate; $date = date('Y-m-d', strtotime($date . ' + 1 day'))) {
                $attendance = new Attendance();
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_date = $date;
                $attendance->status = "on Leave";
                $attendance->save();
            }
        }

       // return back()->with('fail','unrecognized password');
        return redirect('leave/view')->with('status','leave Application Approved Successfully');
    }
    public function delete($id)
    {
        $leave=Leave::find($id);

        $leave->delete();
        return redirect()->back()->with('status','Leave Application Deleted Successfully');
    }
}
