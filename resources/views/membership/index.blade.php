@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card">
        <div class="card-header">{{ __('admin.membership.membership_management') }}</div>

        <div class="card-body">
            @if($user->hasValidMembership())
                {{ __('admin.membership.membership_active_until', ['date' => $user->membership_end_date]) }}
            @else
                {{ __('admin.membership.membership_not_active') }}
                <a href="{{ url('/membership/renew') }}">
                    <button type="button" class="btn btn-primary">{{ __('admin.membership.subscribe') }}</button>
            @endif
        </div>
    </div>
@endsection
