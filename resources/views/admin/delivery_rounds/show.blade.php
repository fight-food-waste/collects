@extends('layouts.main', ['layout_size' => 12])

@section('content')
    @if (sizeof($deliveryRequests) > 0)
        <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
        <link type="text/css" rel="stylesheet"
              href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>
        <script type="text/javascript">
            window.onload = function () {
                L.mapquest.key = '{{ config('app.mapquest_api_key') }}';

                var directions = L.mapquest.directions();
                directions.route({
                    start: '{{ $deliveryRound->warehouse->address }}',
                    end: '{{ $deliveryRound->warehouse->address }}',
                    waypoints: [
                        @foreach ($deliveryRequests->reverse() as $deliveryRequest)
                            '{{ $deliveryRequest->needyperson->address->getFormatted() }}',
                        @endforeach
                    ]
                }, directionsCallback);

                function directionsCallback(error, response) {
                    var map = L.mapquest.map('map', {
                        center: [0, 0],
                        layers: L.mapquest.tileLayer('map'),
                        zoom: 7
                    });

                    var directionsLayer = L.mapquest.directionsLayer({
                        directionsResponse: response
                    }).addTo(map);
                }
            };

            function toggleMap() {
                if (document.getElementById('mapquest').style.display !== 'none') {
                    document.getElementById('mapquest').style.display = 'none';
                } else {
                    document.getElementById('mapquest').style.display = '';
                }
            }
        </script>
    @endif

    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            <a href="{{ route('admin.delivery_rounds.index') }}">
                <button class="btn btn-sm btn-primary" style="margin-right:5px">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </a>
            Delivery round #{{ $deliveryRound->id  }} ({{ $deliveryRound->getStatusName() }})

            @if (sizeof($deliveryRequests) > 0)
                <button class="btn btn-sm btn-primary"
                        onclick="toggleMap()">
                    <i class="fas fa-map"></i>
                </button>
            @endif

            @if($deliveryRound->status === 0)
                <form action="{{ route('admin.delivery_rounds.destroy') }}" method="POST"
                      class="fa-pull-right">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="delivery_round_id" value="{{ $deliveryRound->id }}">
                    <button type="submit" class="btn btn-sm btn-danger"
                            style="margin-left: 5px">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                <a href="{{ route('admin.delivery_rounds.add_delivery_requests', $deliveryRound->id) }}"
                   class="fa-pull-right">
                    <button type="submit" class="btn btn-sm btn-secondary"
                            style="margin-left: 5px">
                        <i class="fas fa-plus"></i>
                    </button>
                </a>

                @if(sizeof($deliveryRequests) > 0)
                    <form act ion="{{ route('admin.delivery_rounds.update', $deliveryRound->id) }}"
                          method="POST" class="fa-pull-right">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="delivery_round_status" value="1">
                        <button type="submit"
                                class="btn btn-sm btn-primary"
                                style="margin-left: 5px">
                            Close
                        </button>
                    </form>
                @endif
            @elseif($deliveryRound->status === 1)
                <form action="{{ route('admin.delivery_rounds.update', $deliveryRound->id) }}"
                      method="POST" class="fa-pull-right">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="delivery_round_status" value="2">
                    <button type="submit"
                            class="btn btn-sm btn-primary"
                            style="margin-left: 5px">
                        Start delivery
                    </button>
                </form>
                <form action="{{ route('admin.delivery_rounds.update', $deliveryRound->id) }}"
                      method="POST" class="fa-pull-right">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="delivery_round_status" value="0">
                    <button type="submit"
                            class="btn btn-sm btn-primary"
                            style="margin-left: 5px">
                        Reopen
                    </button>
                </form>
            @elseif($deliveryRound->status === 2)
                <form action="{{ route('admin.delivery_rounds.update', $deliveryRound->id) }}"
                      method="POST" class="fa-pull-right">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="delivery_round_status" value="3">
                    <button type="submit"
                            class="btn btn-sm btn-primary"
                            style="margin-left: 5px">
                        Terminate delivery
                    </button>
                </form>
            @endif

        </div>
        <div class="card-body">
            @if (sizeof($deliveryRequests) > 0)
                <div id="mapquest"><h4>Map</h4>
                    <hr>
                    <div id="map" style="width: 100%; height: 400px;"></div>
                    <br>
                </div>

                <p>{{ __('admin.delivery_rounds.delivery_round_detail', ['count' => count($deliveryRound->deliveryRequests), 'weight' => $deliveryRound->weightAsMass()->toUnit('kg'), 'name' => $deliveryRound->warehouse->name]) }}</p>
                @if($deliveryRound->status == 2)
                    <p>{{ __('admin.delivery_rounds.no_delivery_round_with_truck') }} #{{ $deliveryRound->truck->id }}.</p>
                @endif

                <div style="display: flex">
                    <h4>Delivery requests
                        <a href="{{ route('admin.delivery_rounds.export', $deliveryRound->id) }}">
                            <button type="button" class="btn btn-sm btn-secondary"
                                    style="margin-left: 5px">
                                <i class="fas fa-download"></i>
                            </button>
                        </a>
                    </h4>
                    @if($deliveryRound->status === 0)
                        <form
                            action="{{ route('admin.delivery_rounds.auto_add_delivery_requests', $deliveryRound->id) }}"
                            method="POST" class="fa-pull-right">
                            @csrf
                            <button type="submit"
                                    class="btn btn-sm btn-primary"
                                    style="margin-left: 5px">Automatically add delivery requests
                            </button>
                        </form>
                    @endif
                </div>
                <hr>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.status') }}</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.submission_date') }}</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.number_of_products') }}</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.weight') }}</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.requester') }}</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.address') }}</th>
                        <th scope="col">{{ __('admin.delivery_rounds.columns.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($deliveryRequests->reverse() as $deliveryRequest)
                        <tr>
                            <th scope="row"><a href="{{ '' }}">
                                    <h4 class="h6 g-mb-2">#{{ $deliveryRequest->id }}</h4>
                                </a></th>
                            <td>{{ $deliveryRequest->getStatusName() }}</td>
                            <td>{{ $deliveryRequest->created_at->diffForHumans() }}</td>
                            <td>{{ count($deliveryRequest->products)  }}</td>
                            <td>{{ $deliveryRequest->weightAsMass()->toUnit('g') }} g</td>
                            <td>
                                {{ $deliveryRequest->needyPerson->getFullName() }}
                            </td>
                            <td>{{ $deliveryRequest->needyPerson->address->getFormatted() }}</td>
                            <td style="display: flex;">
                                @if($deliveryRound->status == 0)
                                    <form action="{{ route('admin.delivery_rounds.delivery_round.remove') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="delivery_round_id"
                                               value="{{ $deliveryRound->id }}">
                                        <input type="hidden" name="delivery_request_id"
                                               value="{{ $deliveryRequest->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ '' }}">
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
                {{ __('admin.delivery_rounds.no_delivery_request_message') }}
                <div style="display: inline">
                    <form
                        action="{{ route('admin.delivery_rounds.auto_add_delivery_requests', $deliveryRound->id) }}"
                        method="POST" class="fa-pull-right">
                        @csrf
                        <button type="submit"
                                class="btn btn-sm btn-primary"
                                style="margin-left: 5px">{{ __('admin.delivery_rounds.auto_add_delivery_requests') }}
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
