@extends('layouts.master')
@section('pageTitle')
    Attendence
@endsection

@section('content')
<div class="content">

    <h1><i class="fa fa-users"></i> Manage Attendance
        <section class="float-right">
             <a href="" class="btn btn-outline-success pull-right" role="button">Leaves</a>
            <a href="" class="btn btn-outline-info pull-right" role="button">Attendance</a>
            <a href="" class="btn btn-outline-primary pull-right" role="button">Add User</a>
        </section>
        </h1>


    <div class="card-block table-border-style">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Date</th>
                        <th>Satus</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
<tr>
    <th></th>
    <th></th>
    <th>
                        <form method="post" action="">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
                        <td><button type="submit" name="update" class="btn btn-danger" value="Absent">Mark Absent</button>
                            <button type="submit" name="update" class="btn btn-info " value="Present">Mark Present</button>
                            <button type="submit" name="update" class="btn btn-warning " value="On Leave">Mark Leave</button>
                        </td>
                    </form>
    </th>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
