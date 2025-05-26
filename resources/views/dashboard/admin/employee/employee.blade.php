@extends('layouts.master')
@section('pageTitle')
    Employees
@endsection

@section('content')
<div class="content1">

                    <div class=" col-md-8 col-sm-10 mx-auto text-center form p-4">
                        <h1 class="col-12 d-flex no-block align-items-center">{{ $title }}</h1>
                        <div class="px-2">
                            <br>
                            <h5 class="col-12 d-flex no-block align-items-center">Personal Details</h5>
                            <form action="{{$url }}" class="justify-content-center"  id="form" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="sr-only">First Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" name="firstName" value="{{old('firstName', $employee->firstName) }}">
                                    <span class="text-danger ">
                                        @error('firstName')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" name="lastName" value="{{old('lastName', $employee->lastName) }}">
                                    <span class="text-danger ">
                                        @error('lastName')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label class="sr-only">Email</label>
                                    <input type="email" class="form-control" placeholder="jane.doe@example.com" name="email" value="{{ old('email',$employee->email) }}">
                                    <span class="text-danger ">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <select name="department_name" id="department" class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach ($department as $item )
                                            <option value="{{ $item->department_id}}"
                                                @if($item->department_id == $employee->department_id)  {{'selected' }} @endif >
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger ">
                                        @error('department_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <select name="designation_id" id="designation_id" class="form-control">
<option value="">Select designation</option>

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Phone No</label>
                                    <input type="number" class="form-control" placeholder="Phone Number" name="phoneNo" value="{{ old('phoneNo',$employee->phoneNumber) }}">
                                    <span class="text-danger ">
                                        @error('phoneNo')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Address</label>
                                    <input type="text" class="form-control" placeholder="Address" name="address" value="{{ old('address',$employee->address) }}">
                                    <span class="text-danger ">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Joining Date</label>
                                    <input type="text" id="datepicker" class="form-control" placeholder="Joining Date" name="joing_date" value="{{ old('joing_date',$employee->joing_date) }}">
                                    <span class="text-danger ">
                                        @error('joing_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="female" />
                                    <label class="form-check-label" for="inlineRadio1">female</label>

                                    <input class="form-check-input" type="radio" name="gender" id="female" value="male" />
                                    <label class="form-check-label" for="inlineRadio2">Male</label>
                                  </div>

                                <div class="form-group">
                                    <label class="sr-only">Salary</label>
                                    <input type="number" class="form-control" placeholder="Salary" name="salary" value="{{ old('salary',$employee->salary) }}">
                                    <span class="text-danger ">
                                        @error('salary')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input"  name="is_active" value="active">
                                    <label class="form-check-label" for="flexCheckChecked">Active</label>

                                    <span class="text-danger ">
                                        @error('is_active')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <br>
                                <h5 class="col-12 d-flex no-block align-items-center">Login Details</h5>
                                <div class="form-group">
                                    <label class="sr-only">Email</label>
                                    <input type="email" class="form-control" placeholder="jane.doe@example.com" name="email_login" value="{{ old('email',$employee->email) }}">
                                    <span class="text-danger ">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Password</label>
                                    <input type="password" class="form-control" placeholder="password" name="password" value="">
                                    <span class="text-danger ">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="admin" value="admin" />
                                    <label class="form-check-label" for="inlineRadio1">Admin</label>



                                    <input class="form-check-input" type="radio" name="role" id="staff" value="staff" />
                                    <label class="form-check-label" for="inlineRadio2">Staff</label>
                                  </div>
                                </br>
                            </br>

                                <button type="submit" class="btn btn-primary btn-lg">Add</button>
                            </form>
                        </div>

                    </div>



            </div>


        <script type="text/javascript">

            $( "#datepicker" ).datepicker();

        </script>

        <script type="text/javascript">

            $(document).ready(function () {
                $('#department').on('change', function () {
                    var departmentId = this.value;
                    if (departmentId) {
                    $.ajax({
                        url: '{{ route('getDesignation') }}?department_id='+departmentId,
                        type: 'get',

                        success: function (res) {
                            if (res) {
                                $("#designation_id").empty();
                            $('#designation_id').html('<option value="">Select designation</option>');
                            $.each(res, function (key, designation_id) {
                                $('select[name="designation_id"]').append('<option value="' + designation_id.designation_id + '">' + designation_id.name + '</option>');

                                });
                    }


        else {
            $("#designation_id").empty();
        }
                     }
                   });
               }else{$("#designation_id").empty();
            }
            });
            });

</script>


@endsection

