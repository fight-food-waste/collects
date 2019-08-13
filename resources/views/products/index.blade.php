@extends('layouts.main', ['layout_size' => 12])

@section('content')
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
                        @if(Auth::user()->hasOneOpenDeliveryRequest())
                            <th scope="col">Add to delivery request</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">
                                {{ $product->barcode }}
                            </th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->expiration_date->format('d/m/y') }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->weightAsMass()->toUnit('g') }} g</td>
                            @if(Auth::user()->hasOneOpenDeliveryRequest())
                                <td>
                                    <form action="{{ route('products.delivery_request.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id"
                                               value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-sm btn-secondary">
                                            <i class="fas fa-shopping-basket"></i>
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                There is no product in the database.
            @endif
        </div>
    </div>
@endsection
