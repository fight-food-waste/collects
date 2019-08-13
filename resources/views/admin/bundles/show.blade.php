@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            <a href="{{ route('admin.bundles.index') }}">
                <button class="btn btn-sm btn-primary" style="margin-right:5px">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </a>
            {{ __('admin.products.bundle') }} #{{ $bundle->id }}

        </div>


        <div class="card-body">

            <p>{{ __('admin.products.bundle_detail', ['count' => count($bundle->products), 'weight' => $bundle->weightAsMass()->toUnit('kg')]) }}</p>

            @if (sizeof($products) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('admin.products.columns.barcode') }}</th>
                        <th scope="col">{{ __('admin.products.columns.name') }}</th>
                        <th scope="col">{{ __('admin.products.columns.expiration_date') }}</th>
                        <th scope="col">{{ __('admin.products.columns.quantity') }}</th>
                        <th scope="col">{{ __('admin.products.columns.weight') }}</th>
                        <th scope="col">{{ __('admin.products.columns.remove') }}</th>
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
                            <td>
                                <form action="{{ route('admin.bundles.product.reject') }}"
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
                {{ __('admin.products.no_product_message') }}
            @endif
        </div>
    </div>
@endsection
