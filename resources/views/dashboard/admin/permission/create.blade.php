@extends('layouts.master')
@section('pageTitle')
   Permission
@endsection

@section('content')
    <div class="content">
      <a href="{{ url()->previous() }}" class="btn btn-secondary">
    ← Back
</a>
        <div class="card mb-3" >
          @if ($errors->any())
    <div class="alert alert-danger">
        {{-- <strong>There were some problems with your input:</strong> --}}
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="card-header">

        <h4 class="col-12 d-flex no-block align-items-center">{{ $title }} </h4> </div>

        <div class="card-body">
          
            <form role="form" action="{{$url }}" method="post">
                {{ csrf_field() }}
                   @php
                          $parts = explode('.', $permission->name);
                          $module = $parts[0] ?? '';
                          $action = $parts[1] ?? '';
                          
                      @endphp
                  <div class="box-body">
                  <div class="col-lg-offset-3 col-lg-6">
                    <div class="form-group">
                      <label for="name">Permission title</label>
                      <div class="form-group mt-2">
    <label for="action">Action</label>
    <select class="form-control" id="action" name="action" required>
        <option value="">-- Select Action --</option>
        <option  @if($action == 'view')  {{'selected' }} @endif value="view">View</option>
        <option  @if($action == 'edit')  {{'selected' }} @endif value="edit">Edit</option>
        <option  @if($action == 'manage')  {{'selected' }} @endif value="manage">Manage</option>
        <!-- Add more actions as needed -->
    </select>
</div>


                    </div>
                   
                    <div class="form-group">
                        <label for="for">Permission for</label>
                        <select name="for" id="for" class="form-control">
                            <option selected disable>Select Permission for</option>

                            <option value="department"  @if($module == 'department')  {{'selected' }} @endif>Department</option>
                            <option value="employee"  @if($module == 'employee')  {{'selected' }} @endif>Employee</option>
                            <option value="attendance"  @if($module == 'attendance')  {{'selected' }} @endif>Attendance</option>
                            <option value="leave"  @if($module == 'leave')  {{'selected' }} @endif>Leave</option>
                            <option value="payroll"  @if($module == 'payroll')  {{'selected' }} @endif>Payroll</option>
                            {{-- <option value="other"  @if($module == 'other')  {{'selected' }} @endif>Other</option> --}}

                        </select>
                    </div>


                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href='{{ route('permission.view') }}' class="btn btn-warning">Back</a>
                  </div>

                  </div>

                  </div>

                </form>
              </div>
              <!-- /.box -->


            </div>
            <!-- /.col-->
          </div>
          <!-- ./row -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
  @endsection
