@extends('layouts.main', ['layout_size' => 8])

@section('content')
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            {{ __('home.message') }}

            @if(Auth::user()->type == "employee")
                {{ __('home.goto') }}<a href="{{ route('admin.index') }}">
                    {{ __('home.admin_panel') }}.
                </a>
            @endif
        </div>
    </div>
@endsection
