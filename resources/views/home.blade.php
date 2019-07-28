@extends('layouts.main', ['layout_size' => 8])

@section('content')
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            You are logged in!

            @if(Auth::user()->type == "employee")
                Go to the<a href="{{ route('admin.index') }}">
                    {{ __('Admin') }}.
                </a>
            @endif
        </div>
    </div>
@endsection
