@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        You are logged in!

                        @if(Auth::user()->type == "employee")
                            Go to the<a href="{{ route('admin.index') }}">
                                {{ __('Admin') }}.
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
