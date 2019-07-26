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
                        {{ __('Products') }}</div>

                    <div class="card-body">

                        @if (sizeof($products) > 0)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Expiration Date</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Bundle</th>
                                    <th scope="col">Shelf</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">
                                            {{ $product->barcode }}
                                        </th>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->expiration_date }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->weightAsMass()->toUnit('g') }} g</td>
                                        <td>
                                            <a href="{{ route('admin.bundles.show', $product->bundle_id) }}">{{ $product->bundle_id }}</a>
                                        </td>
                                        <td>{{ $product->shelf == null ? '-' : $product->shelf }}</td>
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
