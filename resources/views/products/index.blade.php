@extends('layouts.main', ['layout_size' => 12])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.index.products') }}</div>

        <div class="card-body">
            {!! form($form) !!}
        </div>

        <div class="card-body">

            @if (sizeof($products) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('admin.products.columns.barcode') }}</th>
                        <th scope="col">{{ __('admin.products.columns.name') }}</th>
                        <th scope="col">{{ __('admin.products.columns.expiration_date') }}</th>
                        <th scope="col">{{ __('admin.products.columns.quantity') }}</th>
                        <th scope="col">{{ __('admin.products.columns.weight') }}</th>
                        @if(Auth::user()->hasOneOpenDeliveryRequest())
                            <th scope="col">{{ __('products.add_to_delivery_request') }}</th>
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
                            <td @if($product->expiration_date->isBefore(\Carbon\Carbon::now()))
                                style="color: red"
                                @endif >
                                {{ $product->expiration_date->format('d/m/y') }}
                            </td>
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
                {{ __('admin.products.no_product_message') }}
            @endif
        </div>
    </div>
@endsection
