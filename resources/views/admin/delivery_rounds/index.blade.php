@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.delivery_rounds.create_new_delivery_round') }}
        </div>

        <div class="card-body">

            {!! form($form) !!}
        </div>
    </div>


    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.index.delivery_rounds') }}
            <form action="{{ route('admin.delivery_rounds.store') }}" method="POST" class="fa-pull-right">
                @csrf
                <button type="submit" class="btn btn-sm btn-secondary">
                    <i class="fas fa-plus"></i>
                </button>
            </form>
        </div>

        <div class="card-body">
            @if (sizeof($deliveryRounds) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.status') }}</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.warehouse') }}</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.creation_date') }}</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.number_of_delivery_requests') }}</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.weight') }}</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($deliveryRounds->reverse() as $deliveryRound)
                        <tr>
                            <th scope="row">
                                <a href="delivery-rounds/{{ $deliveryRound->id }}">
                                    <h4 class="h6 g-mb-2">#{{ $deliveryRound->id }}</h4>
                                </a>
                            </th>
                            <td>{{ $deliveryRound->getStatusName() }}</td>
                            <td>{{ $deliveryRound->warehouse->name }}</td>
                            <td>{{ $deliveryRound->created_at->diffForHumans() }}</td>
                            <td>{{ count($deliveryRound->deliveryRequests)  }}</td>
                            <td>{{ $deliveryRound->weightAsMass()->toUnit('kg') }} kg</td>
                            <td>
                                <a href="{{ route('admin.delivery_rounds.show', $deliveryRound->id) }}">
                                    <button class="btn btn-secondary edit-btn-table">
                                        <i class="far fa-edit"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                {{ __('admin.delivery_rounds.no_delivery_round_message') }}
            @endif
        </div>
    </div>
@endsection
