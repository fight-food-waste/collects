@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            <a href="{{ route('admin.delivery_requests.index') }}">
                <button class="btn btn-sm btn-primary" style="margin-right:5px">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </a>
            Delivery request #{{ $deliveryRequest->id  }}

        </div>


        <div class="card-body">

            <p>This delivery request contains {{ count($deliveryRequest->products)  }} products for a total
                of {{ $deliveryRequest->weightAsMass()->toUnit('kg') }} kg.</p>

            @if (sizeof($products) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Barcode</th>
                        <th scope="col">Name</th>
                        <th scope="col">Expiration Date</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Action</th>
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
                                @if($deliveryRequest->status == 0)
                                    <form action="{{ route('admin.delivery_requests.product.reject') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id  }}">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ '' }}">
                                    <button class="btn btn-sm btn-secondary"
                                            style="margin-left: 5px">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                There is no product in this bundle.
            @endif
        </div>
    </div>
@endsection
