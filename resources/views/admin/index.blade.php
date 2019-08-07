@extends('layouts.main', ['layout_size' => 8])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            <h3>Admin</h3></div>

        <div class="card-body">
            <p>Click a link below to manage donations.</p>

            <ul>
                <li><a href="{{ route('admin.bundles.index') }}">Bundles</a></li>
                <li><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li><a href="{{ route('admin.collection_rounds.index') }}">Collections Rounds</a></li>
                <li><a href="{{ route('admin.trucks.index') }}">Trucks</a></li>
                <li><a href="{{ route('admin.warehouses.index') }}">Warehouses</a></li>
                <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                <li><a href="{{ route('admin.delivery_requests.index') }}">Delivery Requests</a></li>
                <li><a href="{{ route('admin.delivery_rounds.index') }}">Delivery Rounds</a></li>
            </ul>

        </div>
    </div>
@endsection
