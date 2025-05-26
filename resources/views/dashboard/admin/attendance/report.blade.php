@extends('layouts.master')
@section('pageTitle')
    Attendence
@endsection

@section('content')
    <div class="content">
        <div class="card mb-3">
            <div class="card-header">

                <h4 class="col-12 d-flex no-block align-items-center">Attendance Report</h4>
            </div>
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
                                <label style="max-width:200px;"name="year">Year</label>
                            </div>
                            <div class="form-group col-sm-3">
                                <label style="max-width:200px;"name="month">Month</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <select style="max-width:200px;"name="department_id" id="department_id"
                                    class="form-control">
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
                                <select style="max-width:200px;" name="year" id="year" class="form-control">
                                    <?php
                                    $currentYear = date('Y');
                                    for ($i = 1990; $i <= $currentYear; $i++) {
                                        echo "<option value='" . $i . "'>" . $i . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <select id="month" name="month" style="max-width:200px;"class="form-control">
                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                        echo "<option value='" . str_pad($i, 2, '0', STR_PAD_LEFT) . "'>" . date('F', mktime(0, 0, 0, $i, 1)) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-2">
                                <button type="submit" id="search-btn">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- HTML markup for the editable table -->

                <div id="attendanceTable"></div>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {

            document.getElementById("searchForm").addEventListener("submit", function(event) {

                event.preventDefault(); // prevent the default form submission

                var department_id = document.getElementById("department_id").value;
                var month = document.getElementById("month").value;
                var year = document.getElementById("year").value;

                // Send an AJAX request to search for the attendance data
                $.ajax({
                    url: '{{ route('admin.attendance.report') }}',
                    type: 'GET',
                    data: {
                        department_id: department_id,
                        month: month,
                        year: year
                    },
                    success: function(data) {
                        console.log(data);
                        // Get all unique dates from the attendance data
                        var dates = [...new Set(data.map(item => item.date))];
                        console.log(dates);
                        // Get all unique employee IDs from the attendance data
                        var employeeIds = [...new Set(data.map(item => item.employee_id))];
                        console.log(employeeIds);


                        // Generate the table header with all dates
                        var table =
                            '<table id="attendance" class="table table-bordered table-striped style="width:90% "><thead><tr><th>Employee id</th><th>Department</th>';
                        for (var i = 0; i < dates.length; i++) {
                            table += '<th>' + dates[i] + '</th>';
                        }
                        table += '</tr></thead><tbody>';

                        // Generate the table body with all employees and their attendance data

                        for (var i = 0; i < employeeIds.length; i++) {
                            //table += '<tr><td>' + employeeIds[i] + '</td>';
                            var employee = data.find(item => item.employee_id === employeeIds[
                                i]);
                            table += '<tr><td>' + employee.name + '</td><td>' + employee
                                .department + '</td>';
                            for (var j = 0; j < dates.length; j++) {
                                // Find the attendance data for the current employee and date
                                var record = data.find(item => item.date === dates[j] &&
                                    item.employee_id === employeeIds[i]);
                                console.log(record);
                                if (record) {
                                    // Attendance data is found, display it in the table
                                    table += '<td>' + record.status + '</td>';
                                } else {
                                    // Attendance data is not found, display an empty cell
                                    table += '<td></td>';
                                }
                            }

                            table += '</tr>';
                        }
                        table += '</tbody></table>';

                        ;
                        document.getElementById("attendanceTable").innerHTML = table;

                        $('#attendance').DataTable({
                            scrollX: true,
                            scrollCollapse: true,
                            pageLength: -1,
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'print',
                                {
                                    extend: 'pdfHtml5',
                                    pageSize: {
                                        width: 1000,
                                        height: 1400
                                    },
                                    orientation: 'landscape',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                }
                            ]

                        });

                    }
                });
            });
        });
    </script>
@endsection
