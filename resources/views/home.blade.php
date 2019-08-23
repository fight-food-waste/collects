@extends('layouts.main', ['layout_size' => 8])

@section('content')
    <div class="card">
        <div class="card-header">{{ __('home.dashboard') }}</div>

        <div class="card-body">
            {{ __('home.message') }}

            @if(Auth::user()->type == "employee")
                {{ __('home.goto') }}<a href="{{ route('admin.index') }}">
                    {{ __('home.admin_panel') }}.
                </a>
            @endif

            @if(Auth::user()->type == "storekeeper")
                <a href="{{ route('membership') }}">
                    {{ __('admin.membership.membership_management') }}
                </a>
            @endif
        </div>
    </div>
@endsection
