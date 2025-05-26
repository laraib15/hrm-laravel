@extends('layouts.master')
@section('pageTitle')
    Employees
@endsection
@section('content')
    <div id="main-wrapper">
        <div class="page-wrapper">
                <div class="row text-black">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                        <h1 class="col-12 d-flex no-block align-items-center">{{ $title }}</h1>
                        <div class="px-2">
                            <form action="{{$url }}" class="justify-content-center" method="POST">
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
                                    <select name="department_name" id="" class="form-control">
                                        <option value="">Department Name</option>
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
                                    <label class="sr-only">Phone No</label>
                                    <input type="number" class="form-control" placeholder="Phone Number" name="phoneNo" value="{{ old('phoneNo',$employee->phoneNumber) }}">
                                    <span class="text-danger ">
                                        @error('phoneNo')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection
