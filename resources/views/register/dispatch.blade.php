@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <h2 class="text-center mb-4">Who are you?</h2>
                        <div>
                            <ul>
                                <li><a href="{{ route('register.donor.create') }}">Donor</a></li>
                                <li><a href="{{ route('register.storekeeper.create') }}">Storekeeper</a></li>
                                <li><a href="{{ route('register.storekeeper.create') }}">Needy Person</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
