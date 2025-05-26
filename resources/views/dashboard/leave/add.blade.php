@extends('layouts.master')
@section('pageTitle')
    Leave
@endsection

@section('content')
<div class="content1">
    <div class="card border-light mb-3" style="width: 52%;">


        <div class="card-header">  <h5 class="display-7 py-2 text-truncate ">{{ $title }}</h5> </div>
        <div class="card-body">
        <div class="px-2">
            <br>

            <form action="{{$url }}" class="justify-content-center"  id="form" method="POST">
                @csrf
                <div class="form-group">
                    <select name="type" id="type" class="form-control">
                        <option value="">Select Leave Type</option>
                        <option value="Medical" @if($leave->type == 'Medical')  {{'selected' }} @endif>Medical</option>
                        <option value="Casual" @if($leave->type == 'Casual')  {{'selected' }}@endif>Casual</option>
                        <option value="Others" @if($leave->type == 'others')  {{'selected' }}@endif>Others</option>
                    </select>

                    <span class="text-danger ">
                        @error('type')
                            {{ $message }}
                        @enderror
                    </span>
                </div>


    <div class="form-group">

        <label class="sr-only">From</label>
        <input type="text" id="start_date" class="form-control" placeholder="From" name="start_date" value="{{ old('start_date',$leave->start_date) }}">
        <span class="text-danger ">
            @error('start_date')
                {{ $message }}
            @enderror
        </span>
    </div>

                <div class="form-group">
                    <label class="sr-only">To</label>
                    <input type="text" id="end_date" class="form-control" placeholder="To" name="end_date" value="{{ old('end_date',$leave->end_date) }}">
                    <span class="text-danger ">
                        @error('end_date')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <input  name="employee_id" type="hidden" value="{{$leave->employee_id}}">
                <div class="form-group">
                    <label class="sr-only">To</label>
                    <textarea name="reason" rows="3" cols="90" class="form-control"placeholder="Comments" >{{$leave->reason}}</textarea>

                    <span class="text-danger ">
                        @error('reason')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                @if( auth()->user()->role_id == 1 )
                <div class="form-group">
                    <select name="status" id="type" class="form-control">
                        <option value="">Action</option>
                        <option value="Pending"  {{($leave->status == 'Pending')? 'selected' : ''}}>Pending</option>
                        <option value="Approved" @if($leave->status == 'Approved')  {{'selected' }}@endif>Approved</option>
                        <option value="Rejected" @if($leave->status == 'Rejected')  {{'selected' }}@endif>Rejected</option>
                    </select>
                </div>
                @endif
                <button type="submit" class="btn btn-success btn-lg">Apply</button>
            </form>
</div>
        </div>
    </div>
<script type="text/javascript">

$(function() {
  $("#start_date").datepicker({
    dateFormat: "yy-mm-dd",
    autoclose: true
  });
    $( "#end_date" ).datepicker({
        dateFormat: "yy-mm-dd",
        autoclose: true
    });
});
</script>
@endsection
