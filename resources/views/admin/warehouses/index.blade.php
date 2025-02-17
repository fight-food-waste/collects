@extends('layouts.main', ['layout_size' => 12])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.index.warehouses') }}
            <a href="{{ route('admin.warehouses.create') }}" class="btn btn-sm btn-secondary fa-pull-right">
                <i class="fas fa-plus"></i>
            </a>
        </div>

        <div class="card-body">

            @if (sizeof($warehouses) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('admin.warehouses.columns.name') }}</th>
                        <th scope="col">{{ __('admin.warehouses.columns.address') }}</th>
                        <th scope="col">{{ __('admin.warehouses.columns.number_of_shelves') }}</th>
                        <th scope="col">{{ __('admin.warehouses.columns.used_weight') }}</th>
                        <th scope="col">{{ __('admin.warehouses.columns.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($warehouses as $warehouse)
                        <tr>
                            <th scope="row">
                                {{ $warehouse->id }}
                            </th>
                            <td>{{ $warehouse->name }}</td>
                            <td>{{ $warehouse->address }}</td>
                            <td>{{ count($warehouse->shelves) }}</td>
                            <td>{{ $warehouse->weightAsMass()->toUnit('kg') }} kg</td>
                            <td>
                                <a href="{{ route('admin.warehouses.edit', $warehouse->id) }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                {{ __('admin.warehouses.no_warehouse_message') }}
            @endif
        </div>
    </div>
@endsection
