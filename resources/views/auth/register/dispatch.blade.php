@extends('layouts.main', ['layout_size' => 8])

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Register') }}</div>

        <div class="card-body">
            <h2 class="text-center mb-4">Who are you?</h2>
            <div>
                <ul>
                    <li><a href="{{ route('register.donor.create') }}">Donor</a></li>
                    <li><a href="{{ route('register.storekeeper.create') }}">Storekeeper</a></li>
                    <li><a href="{{ route('register.needyperson.create') }}">Needy Person</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
