@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            <a href="{{ route('admin.delivery_rounds.show', $deliveryRound->id) }}">
                <button class="btn btn-sm btn-primary" style="margin-right:5px">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </a>
            Add delivery request to delivery round #{{ $deliveryRound->id }}
            <a href="{{ $request->input('closest') === 'true' ? $request->fullUrlWithQuery(['closest' => 'false']) : $request->fullUrlWithQuery(['closest' => 'true']) }}"
               class="fa-pull-right">
                <button type="submit" class="btn btn-sm btn-secondary">
                    {{ $request->input('closest') === 'true' ? 'Show all available delivery requests' : 'Show closest delivery requests' }}
                </button>
            </a>
        </div>

        <div class="card-body">

            @if (sizeof($deliveryRequests) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Status</th>
                        <th scope="col">Submission date</th>
                        <th scope="col">Number of products</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Requester</th>
                        <th scope="col">City</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($deliveryRequests->reverse() as   $deliveryRequest)
                        <tr>
                            <th scope="row"><a href="{{ '' }}">
                                    <h4 class="h6 g-mb-2">#{{ $deliveryRequest->id }}</h4>
                                </a></th>
                            <td>{{ $deliveryRequest->getStatusName() }}</td>
                            <td>{{  $deliveryRequest->created_at->diffForHumans() }}</td>
                            <td>{{ count($deliveryRequest->products)  }}</td>
                            <td>{{ $deliveryRequest->weightAsMass()->toUnit('kg') }} kg</td>
                            <td>
                                {{ $deliveryRequest->needyPerson->getFullName() }}
                            </td>
                            <td>{{ $deliveryRequest->needyPerson->address->city }}</td>
                            <td style="display: flex;">
                                @if($deliveryRequest->status >= 0)
                                    <form action="{{ route('admin.delivery_rounds.add_delivery_request') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="delivery_request_id"
                                               value="{{ $deliveryRequest->id  }}">
                                        <input type="hidden" name="delivery_round_id"
                                               value="{{ $deliveryRound->id  }}">
                                        <button type="submit" class="btn btn-sm btn-secondary">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                There is no available delivery request.<br>
                Either there isn't any approved delivery request not assigned to a delivery round, or there isn't
                enough free weight left in this delivery round.
            @endif
        </div>
    </div>
@endsection
