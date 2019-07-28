@extends('layouts.main', ['layout_size' => 6])

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Register') }}</div>

        <div class="card-body">
            {!! form($form) !!}
        </div>
    </div>
@endsection
