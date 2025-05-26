@extends('layouts.master')
@section('pageTitle')
    Attendence
@endsection

@section('content')
    <div class="content">
        <div class="card mb-3" >
            <div class="card-header">

        <h4 class="col-12 d-flex no-block align-items-center">Genrate Attendance Report</h4></div>
        <div class="card-body">
        <div class="px-2">

            <br>

            <form id="searchForm">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label style="max-width:200px;"name="department_id">Employees for Department</label>
                    </div>
                    <div class="form-group col-sm-3">
                        <label style="max-width:200px;"name="date">Date</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-3">
                        <select style="max-width:200px;"name="department_id" id="department_id" class="form-control">
                            <option value="all">All Employees</option>
                            @foreach ($department as $item)
                                <option value="{{ $item->department_id }}">
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger ">
                            @error('department_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group col-sm-3">

                        <input type="text" id="date" name="date" style="max-width:200px;"class="form-control">
                    </div>
                    <div class="form-group col-xs-2">
                        <button type="submit" id="search-btn">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div></div>
    <div class="card">
        <div class="card-body">
        <!-- HTML markup for the editable table -->

        <div id="attendanceTable"></div>
        </div></div>
    </div>




    <script>
        $(document).ready(function() {

            $("#date").datepicker({
               // maxDate: new Date(), // set the maxDate option to today's date
                dateFormat: "yy-mm-dd",
                autoclose: true
            });
            // Prevent default form submission
            document.getElementById("searchForm").addEventListener("submit", search);
        });
    </script>

    <script>
        function search() {
            event.preventDefault(); // prevent the default form submission

            var department_id = document.getElementById("department_id").value;
            var date = document.getElementById("date").value;

            // Send an AJAX request to search for the attendance data
            $.ajax({
                url: '{{ route('attendance.store') }}',
                type: 'GET',
                data: {
                    department_id: department_id,
                    date: date
                },
                success: function(data) {
                    // On success, display the attendance data in a table
                    var table =
                        '<table id="editable" class="table table-bordered table-striped style="width:90% "><thead ><tr><th>Employee id</th><th>Date</th><th>Attendance By</th><th>Status</th><th>Check in</th><th>Check out</th></tr></thead>';
                    for (var i = 0; i < data.length; i++) {

                        table += '<tr><td>' + data[i].employee_id + '</td><td>' + data[i]
                            .date + '</td><td>' + data[i].attendance_by + '</td><td>' +
                            data[i].status + '</td><td>' + data[i].check_in + '</td><td>' +
                            data[i].check_out + '</td></tr>';


                    }
                    table += '</table>';
                    document.getElementById("attendanceTable").innerHTML = table;
                    $('#editable').DataTable();
                    enableInlineEditing();
                }
            });
        }
    </script>

    <script>
        function enableInlineEditing() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $("input[name=_token]").val()
                }
            });
            //var date= document.getElementById("date").value;
            $('#editable').Tabledit({

                url: '{{ route('tabledit.action') }}',
                dataType: "json",
                columns: {
                    identifier: [
                        [0, 'employee_id'],
                        [1, "date"]
                    ],
                    editable: [
                        [3, 'status', '{"Present":"Present", "Absent":"Absent", "On Leave":"On Leave"}'],
                        [4, 'check_in'],
                        [5, 'check_out']
                    ]
                },
                deleteButton: false,
                restoreButton: false,
                onSuccess: function(data, textStatus, jqXHR) {
                    console.log(data);
                    search();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown);
                }
            });

        };


        // Make the table cells editable on click
        /*   $('#attendancetable td').on('click', function() {
               // Save the current value of the cell
               var oldValue = $(this).text();

               // Create an input element with the current value
               var input = $('<input type="text">').val(oldValue);

               // Replace the text with the input
               $(this).html(input);

               // Focus the input and select the text
               input.focus();
               input.select();

               // Handle blur event on the input
               input.on('blur', function() {
                   // Get the new value of the input
                   var newValue = input.val();

                   // Send an AJAX request to the server to save the new value
                   $.ajax({
                       url: '/save-attendance-data',
                       type: 'POST',
                       dataType: 'json',
                       data: {employee_id: $(this).parent().data('employee-id'), date: $(this).parent().data('date'), field: $(this).data('field'), value: newValue},
                       success: function(data) {
                           // Update the cell with the new value
                           $(cell).text(newValue);
                           // Update the status cell
                           var statusCell = $(cell).parent().find('.status');
                           $(statusCell).text(data.status);
                           // Display a success message
                           $('#message').text('Attendance data saved successfully!');
                       },
                       error: function() {
                           // Display an error message
                           $('#message').text('Error saving attendance data!');
                       }
                   });
               });
           */
    </script>
@endsection
