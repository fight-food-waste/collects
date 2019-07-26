@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

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
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
