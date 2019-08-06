@extends('layouts.main', ['layout_size' => 12])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.index.trucks') }}</div>

        <div class="card-body">

            @if (sizeof($trucks) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('admin.trucks.columns.warehouse') }}</th>
                        <th scope="col">{{ __('admin.trucks.columns.capacity') }}</th>
                        <th scope="col">{{ __('admin.trucks.columns.status') }}</th>
                        <th scope="col">{{ __('admin.trucks.columns.collection_round') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($trucks as $truck)
                        <tr>
                            <th scope="row">
                                {{ $truck->id }}
                            </th>
                            <td>{{ $truck->warehouse->name }}</td>
                            <td>{{ $truck->capacity }} kg</td>
                            <td>{{ $truck->collection_round_id == null ? __('admin.trucks.statuses.available') : __('admin.trucks.statuses.ongoing') }}</td>
                            <td>
                                @if($truck->collection_round_id == null)
                                    {{ __('admin.trucks.statuses.none') }}
                                @else
                                    <a href="{{ route('admin.collection_rounds.show', $truck->collection_round_id) }}">#{{ $truck->collection_round_id }}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                {{ __('admin.trucks.no_truck_message') }}
            @endif
        </div>
    </div>
@endsection
