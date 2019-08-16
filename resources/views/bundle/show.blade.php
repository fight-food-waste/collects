@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header">{{ __('admin.products.bundle') }} #{{ $bundle->id  }}</div>

        <div class="card-body">

            @if (sizeof($bundle->products) > 0)
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
                    @foreach ($bundle->products as $product)
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
                            <td>
                                <form action="{{ route('products.destroy') }}"
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
