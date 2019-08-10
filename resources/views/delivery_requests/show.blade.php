@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header">{{ __('admin.delivery_requests.delivery_request') }} {{ $deliveryRequest->id  }}</div>

        <div class="card-body">

            @if (sizeof($deliveryRequest->products) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('admin.products.columns.barcode') }}</th>
                        <th scope="col">{{ __('admin.products.columns.name') }}</th>
                        <th scope="col">{{ __('admin.products.columns.expiration_date') }}</th>
                        <th scope="col">{{ __('admin.products.columns.quantity') }}</th>
                        <th scope="col">{{ __('admin.products.columns.remove') }}</th>
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
                                @if($deliveryRequest->status == 0)
                                    <form action="{{ route('products.delivery_request.remove') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="delivery_request_id"
                                               value="{{ $deliveryRequest->id }}">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                {{ __('admin.products.no_product_message') }}
            @endif
        </div>
    </div>
@endsection
