@extends('layouts.master')
    @section('pageTitle')
    Department
    @endsection
    @section('content')
<div class="content1">

            <div class=" col-sm-8 mx-auto text-center form p-4">
                <h1 class="col-12 d-flex no-block align-items-center">{{ $title }}</h1>

                <div class="px-2">
                    <form action="{{ $url }}" class="justify-content-center"method="POST" class="dropzone" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="department_id" name="department_id" id="department_id" value="">
                        <div class="form-group">
                            <label class="sr-only">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name', $department->name) }}">
                            <span class="text-danger ">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="sr-only">Email</label>
                            <input type="email" class="form-control" placeholder="jane.doe@example.com" name="email" value="{{ old('email',$department->email) }}">
                            <span class="text-danger ">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Phone No</label>
                            <input type="number" class="form-control" placeholder="Phone Number" name="phoneNo" value="{{ old('phoneNo',$department->phoneNumber) }}">
                            <span class="text-danger ">
                                @error('phoneNo')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Description</label>
                            <input type="text" class="form-control" placeholder="description" name="description" value="{{ old('address',$department->description) }}">
                            <span class="text-danger ">
                                @error('address')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </form>
                </div>
            </div>


@endsection


