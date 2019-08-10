@extends('layouts.main', ['layout_size' => 12])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.index.delivery_requests') }}</div>

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
                        <th scope="col">{{ __('admin.delivery_requests.columns.address') }}</th>
                        <th scope="col">{{ __('admin.delivery_requests.columns.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($deliveryRequests->reverse() as $deliveryRequest)
                        <tr>
                            <th scope="row"><a href="{{ route('admin.delivery_requests.show', $deliveryRequest->id) }}">
                                    <h4 class="h6 g-mb-2">#{{ $deliveryRequest->id }}</h4>
                                </a></th>
                            <td>{{ $deliveryRequest->getStatusName() }}</td>
                            <td>{{ $deliveryRequest->created_at->diffForHumans() }}</td>
                            <td>{{ count($deliveryRequest->products)  }}</td>
                            <td>{{ $deliveryRequest->weightAsMass()->toUnit('kg') }} kg</td>
                            <td>{{ $deliveryRequest->needyPerson->getFullName() }}</td>
                            <td>{{ $deliveryRequest->needyPerson->address->getFormatted() }}</td>
                            <td style="display: flex;">
                                @if($deliveryRequest->status <= 0)
                                    <form action="{{ route('admin.delivery_requests.approve') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="delivery_request_id"
                                               value="{{ $deliveryRequest->id  }}">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                                @if($deliveryRequest->status >= 0 && $deliveryRequest->status <=1)
                                    <form action="{{ route('admin.delivery_requests.reject') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="delivery_request_id"
                                               value="{{ $deliveryRequest->id  }}">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.delivery_requests.show', $deliveryRequest->id) }}">
                                    <button class="btn btn-sm btn-secondary"
                                            style="margin-left: 5px">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                {{ __('admin.delivery_requests.no_bundle_message') }}
            @endif
        </div>
    </div>
@endsection
