@extends('layouts.home')

@section('content')
    <div class="container my-5 py-5">
        <div class="card">
            <div class="card-header">
                <h4>Dashboard</h4>
            </div>
            <div class="card-body">
                <p>Welcome, {{ Auth::user()->name }}!</p>
                <p>You are logged in as {{ Auth::user()->role }}.</p>
            </div>
        </div>
    </div>
@endsection
