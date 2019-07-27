@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card card-more">
                    <div class="card-header">Bundle {{ $bundle->id  }}</div>

                    <div class="card-body">

                        @if (sizeof($bundle->products) > 0)
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
                                @foreach ($bundle->products as $product)
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
                            There is no product in this bundle.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
