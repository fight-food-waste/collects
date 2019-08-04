@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header">Delivery Request {{ $deliveryRequest->id  }}</div>

        <div class="card-body">

            @if (sizeof($deliveryRequest->products) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Barcode</th>
                        <th scope="col">Name</th>
                        <th scope="col">Expiration Date</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($deliveryRequest->products as $product)
                        <tr>
                            <th scope="row">
                                {{ $product->barcode }}
                            </th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->expiration_date }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <form action="{{ route('product.destroy') }}"
                                      method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id  }}">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                There is no product in this delivery request.
            @endif
        </div>
    </div>
@endsection
