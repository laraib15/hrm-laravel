@extends('layouts.master')
@section('pageTitle')
    Attendance
@endsection

@section('content')
<div class="content">
    <div class="card mb-3" >
        <div class="card-header">

    <h5 class="col-12 d-flex no-block align-items-center">Genrate Attendance Report</h5>
        </div>
    <div class="px-2">
        <br>

        <form id="searchForm">

            <div class="row">
                <div class="form-group col-sm-3">
        <select style="max-width:200px;" name="year" id="year" class="form-control">
        <?php
          $currentYear = date("Y");
          for ($i = 1990; $i <= $currentYear; $i++) {
            echo "<option value='" . $i . "'>" . $i . "</option>";
          }
        ?>
      </select>
                </div>

                    <div class="form-group col-sm-3">
      <select id="month" name="month" style="max-width:200px;"class="form-control">
        <?php
          for ($i = 1; $i <= 12; $i++) {
            echo "<option value='" . str_pad($i, 2, '0', STR_PAD_LEFT) . "'>" . date("F", mktime(0, 0, 0, $i, 1)) . "</option>";
          }
        ?>
      </select>
</div>

<div class="form-group col-xs-2">

    <button type="submit" class="btn btn-success btn-lg" id="searchButton">Search</button>
</div></div>
  </form>


</div>
    </div>
    <div class="card mb-3" >
<div id="attendanceTable"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
               document.getElementById("searchForm").addEventListener("submit", function(event) {
     event.preventDefault(); // prevent the default form submission

     var month = document.getElementById("month").value;
     var year = document.getElementById("year").value;

     // Send an AJAX request to search for the attendance data
     $.ajax({
       url: '{{ route('search') }}',
       type: 'GET',
       data: {
         month: month,
         year: year
       },
       success: function(data) {
        console.log(data);
         // On success, display the attendance data in a table
         var table = '<table id="attendance" class="table table-sm table-dark" style="width:60% "><thead><tr><th>Date</th><th>Status</th></tr></thead><tbody>';
         for (var i = 0; i < data.length; i++) {
            if(data[i].status=="Absent")
           table += '<tr><td class="bg-danger">' + data[i].date + '</td><td class="bg-danger">' + data[i].status + '</td></tr>';
           else if(data[i].status=="Present")
           table += '<tr><td>' + data[i].date + '</td><td >' + 'Present' + '</td></tr>';

         }
         table += '</tbody></table>';
         document.getElementById("attendanceTable").innerHTML = table;

         $('#attendance').DataTable({

            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]

});
       }
     });
   });

   });
       </script>



@endsection
