@extends('layouts.master')
@section('pageTitle')
    dashboard
@endsection

@section('content')
<div class="content1">
            <div class="card" style=" width:80%">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>
                <div class="card-body">
<h3> Welcome  {{Auth::user()->id}}</h3>
<hr>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>

</div>
@endsection
