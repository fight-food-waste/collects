@extends('layouts.main')

@section('content')
<!-- Home -->
<section class="g-bg-gray-light-v5">
    <div class="container g-py-100">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-9 col-lg-6">
                <h1>Home</h1>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <h3>Welcome, {{ $user->first_name }}</h3>
            </div>
        </div>
    </div>
</section>
<!-- End Home -->
@endsection
