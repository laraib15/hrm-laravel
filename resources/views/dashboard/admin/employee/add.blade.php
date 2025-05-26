@extends('layouts.master')
@section('pageTitle')
    Employees
@endsection

@section('content')
<div class="content">
    <div class="card  mb-3">
        <div class="card-header">

                        <h4 >{{ $title }}</h4>
                    </div>
        </div>
        <div class="card-deck">
            <div class="card  mb-3">

                            <div class="card-header">
                            <h6>Personal Details</h6></div>
                            <div class=" col-md-8 col-sm-10 mx-auto text-center form p-4">
                                <div class="px-2">
                            <form action="{{$url }}" class="justify-content-center"  id="create-employee" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="sr-only">First Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" name="firstName" value="{{old('firstName', $employee->firstName) }}">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" name="lastName" value="{{old('lastName', $employee->lastName) }}">
                                    
                                </div>

                                <div class="form-group">
                                    <label class="sr-only">Email</label>
                                    <input type="email" class="form-control" placeholder="jane.doe@example.com" name="email" value="{{ old('email',$employee->email) }}">
                                    
                                </div>
                                <div class="form-group">
                                    <select name="department_id" id="department" class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach ($department as $item )
                                            <option value="{{ $item->department_id}}"
                                                @if($item->department_id == $employee->department_id)  {{'selected' }} @endif >
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                   
                                </div>
                                <div class="form-group">
                                    <select name="designation_id" id="designation_id" class="form-control">
                                        <option value="">Select designation</option>
                                        @foreach ($designation as $item )
            <option value="{{ $item->designation_id }}"
                {{ $item->designation_id == $employee->designation_id ? 'selected' : '' }}>
                {{ $item->name }}
            </option>
        @endforeach
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Phone No</label>
                                    <input type="number" class="form-control" placeholder="Phone Number" name="phoneNo" value="{{ old('phoneNo',$employee->phoneNumber) }}">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Address</label>
                                    <input type="text" class="form-control" placeholder="Address" name="address" value="{{ old('address',$employee->address) }}">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Joining Date</label>
                                    <input type="text" id="datepicker" class="form-control" placeholder="Joining Date" name="joing_date" value="{{ old('joing_date',$employee->join_date) }}">
                                    
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="female" {{$employee->gender=="female" ? "checked" : ""}} />
                                    <label class="form-check-label" for="inlineRadio1">female</label>

                                    <input class="form-check-input" type="radio" name="gender" id="female" value="male"{{$employee->gender=="male" ? "checked" : ""}}  />
                                    <label class="form-check-label" for="inlineRadio2">Male</label>
                                    
                                  </div>

                                <div class="form-group">
                                    <label class="sr-only">Salary</label>
                                    <input type="number" class="form-control" placeholder="Salary" name="salary" value="{{ old('salary',$employee->salary) }}">
                                    
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="is_active" value="0"{{$employee->is_active=="1" ? "checked" : ""}}>
                                    <input type="checkbox" class="form-check-input"  name="is_active" value="1" {{$employee->is_active=="1" ? "checked" : ""}}>
                                    <label class="form-check-label" for="flexCheckChecked">Active</label>

                                    
                                </div>

                            </div>
                </div>
            </div>

                <div class="card  mb-3">
                    <div class="card-header">
                        <h6 >Login Details</h6>
                    </div>
                    <div class=" col-md-8 col-sm-10 mx-auto text-center form p-4">
                            <div class="px-2">


                                <div class="form-group">
                                    <label class="sr-only">Email</label>
                                    <input type="email" class="form-control" placeholder="jane.doe@example.com" name="email_login" value="{{ old('email_login',$user->email) }}">
                                    
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Password</label>
                                    <input type="password" class="form-control" placeholder="password" name="password" value="{{ old('password',$user->password) }}">
                                    
                                </div>

                                <div class="form-group">
                                    <label>Assign Role</label>
                                    <div class="row">

                                      @foreach ($roles as $role)
                                          <div class="col-lg-4">
                                            <div class="checkbox">
                                              <label ><input type="checkbox" name="role" value="{{ $role->id }}"
                                              @foreach ($user->roles as $user_role)
                                              @if ($user_role->id == $role->id)
                                                checked
                                              @endif


                                      @endforeach > {{ $role->name }}</label>
                                    </div>
                                </div>

                                    @endforeach</div>
                                    
                                  </div>

                                <br>
                            <br>

                                <button type="submit" class="btn btn-primary btn-lg">Add</button>
                            </form>
                        </div>
        </div>
</div>
        </div></div>






        <script type="text/javascript">
$(document).ready(function() {
   // var now = new Date();
    $("#datepicker").datepicker({
        dateFormat:"yy-mm-dd"
    });
});

        </script>

        <script type="text/javascript">

            $(document).ready(function () {
                // Get the selected department ID from the dropdown
        var departmentId = $('#department').val();

        // If a department is already selected, populate the designation dropdown with options specific to that department
        if (departmentId) {
            $.ajax({
                url: '{{ route('getDesignation') }}?department_id=' + departmentId,
                type: 'get',
                success: function (res) {
                    if (res) {
                        $('#designation_id').html('<option value="">Select designation</option>');
                        $.each(res, function (key, value) {
                            // Set the selected designation if it matches the current employee's designation
                            var selected = (value.designation_id == {{ $employee->designation_id }}) ? 'selected' : '';
                            $('#designation_id').append('<option value="' + value.designation_id + '" ' + selected + '>' + value.name + '</option>');
                        });
                    }
                }
            });
        }
                $('#department').on('change', function () {
                    var departmentId = this.value;
                    if (departmentId) {
                    $.ajax({
                        url: '{{ route('getDesignation') }}?department_id='+departmentId,
                        type: 'get',

                        success: function (res) {
                            if (res) {
                            $('#designation_id').html('<option value="">Select designation</option>');
                            $.each(res, function (key, value) {
                                $('#designation_id').append('<option value="' + value
                                    .designation_id+ '">' + value.name + '</option>');

                                });
                    }
                }
            });
        } else {
            $("#designation_id").empty();
        }
                });


        });

</script>
        <script>
            $("#create-employee").on("submit", function (e) {
        e.preventDefault();
            var FormData = $(this).serialize();
            $.ajax({
                url: $(this).attr("action"),
                method: "POST",
                data: FormData,
                success: function (response) {
                    // Handle the success response
                    $("#create-employee")[0].reset();
                    //location.reload();
                    // Optionally, you can redirect or show a success message
                    // For example: $('#success-message').text('Stage created successfully!').show();
                },
                error: function (xhr) {
                    if (xhr.responseJSON.errors) {
                        // Clear previous errors
                        $('.invalid-feedback').remove();

                        // Loop through each error and display it
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            var input = $('[name="' + key + '"]');
                            input.addClass('is-invalid'); // Add error class
                            input.after('<div class="invalid-feedback">' + value[0] + '</div>'); // Show error message
                        });
                    }
                },
            });

    });
            </script>

@endsection

