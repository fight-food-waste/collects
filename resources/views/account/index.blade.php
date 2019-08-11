@extends('layouts.main', ['layout_size' => 8])

@section('content')
    <div class="card">
        <div class="card-header">{{ __('account.account') }}</div>

        <div class="card-body">
            <div>
                <p>{{ __('signup.email') }} : {{ $user->email }}</p>
                <p>{{ __('signup.first_name') }} : {{ $user->first_name }}</p>
                <p>{{ __('signup.last_name') }} : {{ $user->last_name }}</p>
                <p>{{ __('account.full_address') }} : {{ $user->address->getFormatted() }}</p>
            </div>
            <a href="#" class="btn btn-secondary edit-btn-table">
                <i class="far fa-edit"></i> {{ __('account.edit_account') }}
            </a>

            <hr>

            <form action="{{ route('account.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-danger edit-btn-table">
                    <i class="fas fa-exclamation-triangle"></i> {{ __('account.delete_account') }}
                </button>
            </form>
        </div>
    </div>
@endsection
