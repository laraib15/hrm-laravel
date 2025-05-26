@extends('layouts.master')
@section('pageTitle')
    Employees
@endsection

@section('content')
<div class="content">


                <div class="card-header">{{ __(' User Dashboard') }}</div>

                <table class="table">

                    <tbody>
                        <tr>


                            <th rowspan="2"> <canvas id="canvas" width="150" height="150"
                            style="background-color:#ffffff">
                            </canvas></th>
                            <th>Employee Id </th>
                            <td>{{ Auth::user()->id }}</td>
                            <th>Name</th>
                            <td>{{ Auth::user()->name }}</td>

                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ Auth::user()->email }}</td>
                            <th>Joining Date</th>
                            <td>{{ Auth::user()->created_at }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center" colspan="2">


                                    <select name="employee_id" hidden="">
                                        <option>{{ Auth::user()->id }}</option>
                                    </select>
                                    <button type="submit" id="submitButton">Start Work</button>




                            </td>
                        </tbody>
                    </table>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {

    $.ajax({
        type: "GET",
        url: "attendance/getButtonState",
        success: function (response) {
           // alert(response.buttonState);
            if (response.buttonState === 'start Work') {
                $("#submitButton").text('Start Work');
            } else  if (response.buttonState === 'end Work') {
                $("#submitButton").text('End Work');
            }
        },
        error: function(ts) { alert(ts.responseText) }
    });

    //... other code ...
});
</script>
                    <script>
                        $(document).ready(function () {
   $("#submitButton").click(function () {
     var buttonText = $(this).text();
     var url = '';
     if (buttonText === 'Start Work') {
       url = "startWork";
     } else if (buttonText === 'End Work') {
       url = "endWork";
     }

     $.ajax({
             type: "POST",
             url: url,
             data: {   "_token": "{{ csrf_token() }}",
            },
             success: function(response) {
              console.log(response);
               if (buttonText === 'Start Work') {
             $("#submitButton").text('End Work');}
             else if (buttonText === 'End Work') {
             $("#submitButton").text('Start Work');
           }
             },
             error: function(jqXHR, textStatus, errorThrown) {
               console.error(textStatus, errorThrown);
             }
           });
   });
 });

     </script>
                <script>
                    var canvas = document.getElementById("canvas");
                    var ctx = canvas.getContext("2d");
                    var radius = canvas.height / 2;
                    ctx.translate(radius, radius);
                    radius = radius * 0.90
                    setInterval(drawClock, 1000);

                    function drawClock() {
                      drawFace(ctx, radius);
                      drawNumbers(ctx, radius);
                      drawTime(ctx, radius);
                    }

                    function drawFace(ctx, radius) {
                      var grad;
                      ctx.beginPath();
                      ctx.arc(0, 0, radius, 0, 2*Math.PI);
                      ctx.fillStyle = 'white';
                      ctx.fill();
                      grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
                      grad.addColorStop(0, '#333');
                      grad.addColorStop(0.5, 'white');
                      grad.addColorStop(1, '#333');
                      ctx.strokeStyle = grad;
                      ctx.lineWidth = radius*0.1;
                      ctx.stroke();
                      ctx.beginPath();
                      ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
                      ctx.fillStyle = '#333';
                      ctx.fill();
                    }

                    function drawNumbers(ctx, radius) {
                      var ang;
                      var num;
                      ctx.font = radius*0.15 + "px arial";
                      ctx.textBaseline="middle";
                      ctx.textAlign="center";
                      for(num = 1; num < 13; num++){
                        ang = num * Math.PI / 6;
                        ctx.rotate(ang);
                        ctx.translate(0, -radius*0.85);
                        ctx.rotate(-ang);
                        ctx.fillText(num.toString(), 0, 0);
                        ctx.rotate(ang);
                        ctx.translate(0, radius*0.85);
                        ctx.rotate(-ang);
                      }
                    }

                    function drawTime(ctx, radius){
                        var now = new Date();
                        var hour = now.getHours();
                        var minute = now.getMinutes();
                        var second = now.getSeconds();
                        //hour
                        hour=hour%12;
                        hour=(hour*Math.PI/6)+
                        (minute*Math.PI/(6*60))+
                        (second*Math.PI/(360*60));
                        drawHand(ctx, hour, radius*0.5, radius*0.07);
                        //minute
                        minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
                        drawHand(ctx, minute, radius*0.8, radius*0.07);
                        // second
                        second=(second*Math.PI/30);
                        drawHand(ctx, second, radius*0.9, radius*0.02);
                    }

                    function drawHand(ctx, pos, length, width) {
                        ctx.beginPath();
                        ctx.lineWidth = width;
                        ctx.lineCap = "round";
                        ctx.moveTo(0,0);
                        ctx.rotate(pos);
                        ctx.lineTo(0, -length);
                        ctx.stroke();
                        ctx.rotate(-pos);
                    }
                    </script>
</div>
@endsection
