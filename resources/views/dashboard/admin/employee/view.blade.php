@extends('layouts.master')
@section('pageTitle')
    Employees
@endsection
@section('content')
<div class="content">
    @if(Session::get('status'))
    <div class="alert alert-danger">
      {{ Session::get('status') }}
    </div>
    @endif
    <div class="card mb-3" >
        <div class="card-header">
    <h1 class="display-7 py-2 text-truncate text-center">Employee details</h1>
        </div>
        <div class="card-body">
    <div style="overflow-x: auto;">
    <table  id="example" class="table align-middle mb-0 bg-white">
        <thead class="text-white bg-dark">
              <tr>

                <th>First Name</th>
                 <th>Last Name</th>
                  <th>Email</th>
                  <th>Phone No</th>
                  <th>Address</th>
                  <th>Department </th>
                  <th>Designation</th>
                  <th>Gender</th>
                  <th>Joing Date</th>
                  <th>Salary</th>
                  <th>Status</th>
                  <th>Login ID</th>
                  <th>Actions</th>

              </tr>
          </thead>
          <tbody>
              @foreach ($employee as $data)
              <tr>

                  <td>{{ $data->firstName }}</td>
                  <td>{{ $data->lastName }}</td>
                  <td>{{ $data->email }}</td>
                  <td>{{ $data->phoneNumber }}</td>
                  <td>{{ $data->address }}</td>
                  <td>
                        @foreach ($department as $item )
                           @if($item->department_id == $data->department_id)
                               {{ $item->name }}
                         @endif

                        @endforeach
                  </td>
                  <td>
                    @foreach ($designation as $item )
                       @if($item->designation_id == $data->designation_id)
                           {{ $item->name }}
                     @endif

                    @endforeach
              </td>

                  <td>{{ $data->gender }}</td>
                  <td>{{ $data->join_date }}</td>
                  <td>{{ $data->salary }}</td>
                  <td>@if ( $data->is_active=='1')
                    <span class="label label-success rounded-pill d-inline">   active</span>
                  @else
                  <span class="label label-success rounded-pill d-inline">  Unactive</span>
                  @endif</td>

                    <td>
                        @foreach ($user as $item )
                           @if($item->employee_id == $data->employee_id)
                               {{ $item->email }}
                         @endif

                        @endforeach
                  </td>
                 <td>
                    <a href="{{ route('employee.delete' ,['id'=>$data->employee_id])}}">
                             <button class="btn btn-danger btn-sm">Delete</button></a>
                    <a href="{{ route('employee.edit',$data->employee_id)}}">
                         <button class="btn btn-success btn-sm">Edit</button></a>
                     </td>
              @endforeach

              </tr>
          </tbody>
      </table>
    </div>
        </div></div>
    <script>
        $(document).ready(function () {
        $('#example').DataTable();
    });
        </script>
        </div>

@endsection
