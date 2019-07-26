@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card card-more">
                    <div class="card-header" style="font-weight: bold; font-size: large">
                        {{ __('Warehouses') }}</div>

                    <div class="card-body">

                        @if (sizeof($warehouses) > 0)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Number of shelves</th>
                                    <th scope="col">Used weight</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($warehouses as $warehouse)
                                    <tr>
                                        <th scope="row">
                                            {{ $warehouse->id }}
                                        </th>
                                        <td>{{ $warehouse->name }}</td>
                                        <td>{{ $warehouse->address }}</td>
                                        <td>{{ count($warehouse->shelves) }}</td>
                                        <td>{{ $warehouse->weightAsMass()->toUnit('kg') }} kg</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There is no product in the database.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
