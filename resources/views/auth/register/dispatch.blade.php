@extends('layouts.main', ['layout_size' => 8])

@section('content')
    <div class="card">
        <div class="card-header">{{ __('signup.register') }}</div>

        <div class="card-body">
            <h2 class="text-center mb-4">{{ __('signup.who_are_you') }}</h2>
            <div>
                <ul>
                    <li><a href="{{ route('register.donor.create') }}">{{ __('admin.singular.donor') }}</a></li>
                    <li><a href="{{ route('register.storekeeper.create') }}">{{ __('admin.singular.storekeeper') }}</a></li>
                    <li><a href="{{ route('register.needyperson.create') }}">{{ __('admin.singular.needy_person') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
