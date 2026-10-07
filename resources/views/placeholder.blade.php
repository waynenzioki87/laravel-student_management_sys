@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">{{ ucfirst(request()->segment(1) ?: 'Page') }}</h1>
        </div>
    </div>

    <div class="alert alert-light border-0 shadow-sm rounded-4">
        <p class="mb-0 text-muted">This section is ready to be expanded with its own functionality.</p>
    </div>
@endsection
