@extends('layouts.main', ['layout_size' => 12])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.index.products') }}
        </div>

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
                        <th scope="col">{{ __('admin.products.bundle') }}</th>
                        <th scope="col">{{ __('admin.products.columns.shelf') }}</th>
                        <th scope="col">{{ __('admin.products.columns.status') }}</th>
                        <th scope="col">{{ __('admin.products.columns.action') }}</th>
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
                                <a href="{{ route('admin.bundles.show', $product->bundle_id) }}">{{ $product->bundle_id }}</a>
                            </td>
                            <td>{{ $product->shelf == null ? '-' : $product->shelf->id }}</td>
                            <td>
                                {{ $product->getStatusName() }}
                            </td>
                            <td>
                                @if($product->status == 1)
                                    <form action="{{ route('admin.products.reject', $product->id) }}"
                                          method="POST">
                                        @csrf

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
