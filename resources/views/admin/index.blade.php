@extends('layouts.main', ['layout_size' => 8])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            <h3>{{ __('admin.index.admin') }}</h3></div>

        <div class="card-body">
            <p>{{ __('admin.index.message_donation') }}</p>

            <ul>
                <li><a href="{{ route('admin.bundles.index') }}">{{ __('admin.index.bundles') }}</a></li>
                <li><a href="{{ route('admin.products.index') }}">{{ __('admin.index.products') }}</a></li>
                <li><a href="{{ route('admin.collection_rounds.index') }}">{{ __('admin.index.collection_rounds') }}</a></li>
                <li><a href="{{ route('admin.trucks.index') }}">{{ __('admin.index.trucks') }}</a></li>
                <li><a href="{{ route('admin.warehouses.index') }}">{{ __('admin.index.warehouses') }}</a></li>
                <li><a href="{{ route('admin.categories.index') }}">{{ __('admin.index.categories') }}</a></li>
                <li><a href="{{ route('admin.users.index') }}">{{ __('admin.index.users') }}</a></li>
                <li><a href="{{ route('admin.delivery_requests.index') }}">{{ __('admin.index.delivery_requests') }}</a></li>
                <li><a href="{{ route('admin.delivery_rounds.index') }}">{{ __('admin.index.delivery_rounds') }}</a></li>
            </ul>

        </div>
    </div>
@endsection
