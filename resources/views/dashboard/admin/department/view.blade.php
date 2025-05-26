@extends('layouts.master')
@section('pageTitle')
    Department
@endsection
@section('content')
<div class="content">
        @if(Session::get('status'))
                <div class="alert alert-danger">
                  {{ Session::get('status') }}
                </div>
                @endif
                <h1 class="display-7 py-2 text-truncate text-center">Departments details</h1>
                <table  id="table1">
                    <thead>
                        <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Description</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($department as $data)
                <tr>

                    <td>{{ $data->name }}</td>

                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phoneNumber }}</td>
                    <td>{{ $data->description }}</td>





                    <td>

                        &nbsp;&nbsp;  <a href="{{ route('department.delete' ,['id'=>$data->department_id])}}">
                        <button class="btn btn-danger">Delete</button></a>&nbsp;&nbsp;&nbsp;
                <a href="{{ route('department.edit',['id'=>$data->department_id] )}}">
                    <button class="btn btn-success">Edit</button></a>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mx-auto pb-10 w-4/5">

          {{ $department->links() }}
       </div>

    </div>

     @endsection

