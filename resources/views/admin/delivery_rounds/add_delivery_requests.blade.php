@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            <a href="{{ route('admin.delivery_rounds.show', $deliveryRound->id) }}">
                <button class="btn btn-sm btn-primary" style="margin-right:5px">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </a>
            {{ __('admin.delivery_requests.add_message') }} #{{ $deliveryRound->id }}
            <a href="{{ $request->input('closest') === 'true' ? $request->fullUrlWithQuery(['closest' => 'false']) : $request->fullUrlWithQuery(['closest' => 'true']) }}"
               class="fa-pull-right">
                <button type="submit" class="btn btn-sm btn-secondary">
                    {{ $request->input('closest') === 'true' ? __('admin.delivery_requests.show_all_message') : __('admin.delivery_requests.show_closest_message') }}
                </button>
            </a>
        </div>

        <div class="card-body">

            @if (sizeof($deliveryRequests) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('admin.delivery_requests.columns.status') }}</th>
                        <th scope="col">{{ __('admin.delivery_requests.columns.submission_date') }}</th>
                        <th scope="col">{{ __('admin.delivery_requests.columns.number_of_products') }}</th>
                        <th scope="col">{{ __('admin.delivery_requests.columns.weight') }}</th>
                        <th scope="col">{{ __('admin.delivery_requests.columns.requester') }}</th>
                        <th scope="col">{{ __('admin.delivery_requests.columns.city') }}</th>
                        <th scope="col">{{ __('admin.delivery_requests.columns.action') }}</th>
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
                {{ __('admin.delivery_requests.no_available') }}
            @endif
        </div>
    </div>
@endsection
