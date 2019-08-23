@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header">{{ __('Delivery requests') }}
            <form action="{{ route('delivery_requests.store') }}" method="POST"
                  class="fa-pull-right">
                @csrf
                <button type="submit" class="btn btn-sm btn-secondary">
                    <i class="fas fa-plus"></i>
                </button>
            </form>
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
                        <th scope="col">{{ __('admin.delivery_requests.columns.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($deliveryRequests->reverse() as $deliveryRequest)
                        <tr>
                            <th scope="row"><a href="{{ route('bundle.show', $deliveryRequest->id) }}">
                                    <h4 class="h6 g-mb-2">#{{ $deliveryRequest->id }}</h4>
                                </a></th>
                            <td>{{ $deliveryRequest->getStatusName() }}</td>
                            <td>{{ $deliveryRequest->created_at->diffForHumans() }}</td>
                            <td>{{ count($deliveryRequest->products)  }}</td>
                            <td style="display: flex;">
                                <a class="btn btn-sm btn-info"
                                   href="{{ route('delivery_requests.show', $deliveryRequest->id) }}"
                                   style="color: #fff" title="Display products">
                                    <i class="fas fa-shopping-basket"></i>
                                </a>
                                @if($deliveryRequest->status >= 0)
                                    <form action="{{ route('delivery_requests.destroy') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="delivery_request_id"
                                               value="{{ $deliveryRequest->id }}">
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
                {{ __('admin.delivery_requests.no_delivery_request') }}
            @endif
        </div>
    </div>
@endsection
