@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Hi, {{ $user->first_name }}</h1>

        <a class="btn btn-primary" href="{{ route('membership.renew', ['id' => $user->id]) }}">Renew Membership</a>
    </div>
@endsection
