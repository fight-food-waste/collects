@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            Create new delivery round
        </div>

        <div class="card-body">

            {!! form($form) !!}
        </div>
    </div>


    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('Delivery Rounds') }}
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
                        <th scope="col">Status</th>
                        <th scope="col">Warehouse</th>
                        <th scope="col">Creation date</th>
                        <th scope="col">Number of delivery requests</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Action</th>
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
                There is no delivery round in the database.
            @endif
        </div>
    </div>
@endsection
