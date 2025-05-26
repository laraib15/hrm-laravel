@extends('layouts.master')
@section('pageTitle')
    Leave
@endsection

@section('content')
<div class="content">
    @if(Session::get('status'))
    <div class="alert alert-success" style=" width:50%;">
      {{ Session::get('status') }}
    </div>
    @endif
    <div style=" width:95%;">
        <h3 class="display-7 py-2 text-truncate text-center">Manage Leaves</h3>



            <table id="example" class="table align-middle mb-0 bg-white">
                <thead class="text-white bg-dark">
                  <tr>
                   <th>Employee Name</th>
                        <th>Leave Type</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Comment</th>
                        @if( auth()->user()->role_id == 1 )
                        <th>Action </th>
                        @endif

                  </tr>
                </thead>
                <tbody>
                    @foreach ($leave as $data)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">

                        <div class="ms-3">
                          <p class="fw-bold mb-1">{{$data->employee_id}}</p>

                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="fw-normal mb-1">{{$data->type}}</p>

                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{$data->start_date}} to {{$data->end_date}}</p>

                      </td>
                    <td>
                        @if($data->status=="Pending")
                        <span class="label label-warning rounded-pill d-inline">{{$data->status}}</span>
                        @elseif ($data->status=="Approved")
                        <span class="label label-success rounded-pill d-inline">{{$data->status}}</span>
                        @else
                        <span class="label label-danger rounded-pill d-inline">{{$data->status}}</span>
                        @endif
                      </td>
                    <td>{{$data->reason}}</td>
                    @if( auth()->user()->role_id == 1 )
<td>
    <a href="{{ route('leave.delete' ,['id'=>$data->leave_id])}}">
        <button class="btn btn-danger btn-sm">Delete</button></a>
<a href="{{ route('leave.edit',['id'=>$data->leave_id] )}}">
    <button class="btn btn-success btn-sm">Edit</button></a>
</td>
</td>
        @endif
@endforeach
         </tr>


                </tbody>
              </table>

    </div>

<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
    </script>
</div>
@endsection
