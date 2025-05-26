@extends('layouts.master')
@section('pageTitle')
   Permission
@endsection

@section('content')
    <div class="content">
        <div class="card mb-3" >
            <div class="card-header">

        <h4 class="col-12 d-flex no-block align-items-center">{{ $title }} </h4> </div>

        <div class="card-body">
            <form role="form" action="{{$url }}" method="post">
                {{ csrf_field() }}
                  <div class="box-body">
                  <div class="col-lg-offset-3 col-lg-6">
                    <div class="form-group">
                      <label for="name">Permission title</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Permission  Title" value="{{old('name', $permission->name) }}">
                    <span class="text-danger ">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                    </div>
                    <div class="form-group">
                        <label for="for">Permission for</label>
                        <select name="for" id="for" class="form-control">
                            <option selected disable>Select Permission for</option>

                            <option value="department"  @if($permission->for == 'department')  {{'selected' }} @endif>Department</option>
                            <option value="employee"  @if($permission->for == 'employee')  {{'selected' }} @endif>Employee</option>
                            <option value="attendance"  @if($permission->for == 'attendance')  {{'selected' }} @endif>Attendance</option>
                            <option value="leave"  @if($permission->for == 'leave')  {{'selected' }} @endif>Leave</option>
                            <option value="payroll"  @if($permission->for == 'payroll')  {{'selected' }} @endif>Payroll</option>
                            <option value="other"  @if($permission->for == 'other')  {{'selected' }} @endif>Other</option>

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
