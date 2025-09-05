@extends('layouts.app') {{-- or your main layout --}}

@section('title', 'Access Denied')

@section('content')
    <div class="container text-center mt-5">
        <h1 class="display-4 text-danger">403</h1>
        <h2 class="mb-3">Access Denied</h2>
        <p class="text-muted">You don’t have permission to access this page.</p>

        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-3">Go Back</a>
        {{-- <a href="{{ route('/') }}" class="btn btn-danger mt-3">Go to Dashboard</a> --}}
    </div>
@endsection
