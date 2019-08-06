@extends('layouts.main', ['layout_size' => 12])

@section('content')
    @if (sizeof($bundles) > 0)
        <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
        <link type="text/css" rel="stylesheet"
              href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>
        <script type="text/javascript">
            window.onload = function () {
                L.mapquest.key = '{{ config('app.mapquest_api_key') }}';

                var directions = L.mapquest.directions();
                directions.route({
                    start: '{{ $collectionRound->warehouse->address }}',
                    end: '{{ $collectionRound->warehouse->address }}',
                    waypoints: [
                        @foreach ($bundles->reverse() as $bundle)
                            '{{ $bundle->donor->address->getFormatted() }}',
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
            <a href="{{ route('admin.collection_rounds.index') }}">
                <button class="btn btn-sm btn-primary" style="margin-right:5px">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </a>
            {{ __('admin.collection_rounds.collection_round') }} #{{ $collectionRound->id  }} ({{ $collectionRound->getStatusName() }})

            @if (sizeof($bundles) > 0)
                <button class="btn btn-sm btn-primary"
                        onclick="toggleMap()">
                    <i class="fas fa-map"></i>
                </button>
            @endif

            @if($collectionRound->status === 0)
                <form action="{{ route('admin.collection_rounds.destroy') }}" method="POST"
                      class="fa-pull-right">
                    @csrf
                    <input type="hidden" name="collection_round_id" value="{{ $collectionRound->id }}">
                    <button type="submit" class="btn btn-sm btn-danger"
                            style="margin-left: 5px">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
                <a href="{{ route('admin.collection_rounds.add_bundles', $collectionRound->id) }}"
                   class="fa-pull-right">
                    <button type="submit" class="btn btn-sm btn-secondary"
                            style="margin-left: 5px">
                        <i class="fas fa-plus"></i>
                    </button>
                </a>

                @if(sizeof($bundles) > 0)
                    <form act ion="{{ route('admin.collection_rounds.update', $collectionRound->id) }}"
                          method="POST" class="fa-pull-right">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="collection_round_status" value="1">
                        <button type="submit"
                                class="btn btn-sm btn-primary"
                                style="margin-left: 5px">
                            {{ __('admin.collection_rounds.actions.close') }}
                        </button>
                    </form>
                @endif
            @elseif($collectionRound->status === 1)
                <form action="{{ route('admin.collection_rounds.update', $collectionRound->id) }}"
                      method="POST" class="fa-pull-right">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="collection_round_status" value="2">
                    <button type="submit"
                            class="btn btn-sm btn-primary"
                            style="margin-left: 5px">
                        {{ __('admin.collection_rounds.actions.start_collect') }}
                    </button>
                </form>
                <form action="{{ route('admin.collection_rounds.update', $collectionRound->id) }}"
                      method="POST" class="fa-pull-right">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="collection_round_status" value="0">
                    <button type="submit"
                            class="btn btn-sm btn-primary"
                            style="margin-left: 5px">
                        {{ __('admin.collection_rounds.actions.reopen') }}
                    </button>
                </form>
            @elseif($collectionRound->status === 2)
                <form action="{{ route('admin.collection_rounds.update', $collectionRound->id) }}"
                      method="POST" class="fa-pull-right">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="collection_round_status" value="3">
                    <button type="submit"
                            class="btn btn-sm btn-primary"
                            style="margin-left: 5px">
                        {{ __('admin.collection_rounds.actions.terminate_collect') }}
                    </button>
                </form>
            @endif

        </div>
        <div class="card-body">
            @if (sizeof($bundles) > 0)
                <div id="mapquest"><h4>{{ __('admin.collection_rounds.map') }}</h4>
                    <hr>
                    <div id="map" style="width: 100%; height: 400px;"></div>
                    <br>
                </div>

                <p>{{ __('admin.collection_rounds.collection_round_detail', ['count' => count($collectionRound->bundles), 'weight' => $collectionRound->weightAsMass()->toUnit('kg'), 'name' => $collectionRound->warehouse->name]) }}</p>
                @if($collectionRound->status == 2)
                    <p>{{ __('admin.collection_rounds.on_going_truck', ['truck' => $collectionRound->truck->id ]) }}</p>
                @endif

                <div style="display: flex">
                    <h4>Bundles
                        <a href="{{ route('admin.collection_rounds.export', $collectionRound->id) }}">
                            <button type="button" class="btn btn-sm btn-secondary"
                                    style="margin-left: 5px">
                                <i class="fas fa-download"></i>
                            </button>
                        </a>
                    </h4>
                    @if($collectionRound->status === 0)
                        <form
                            action="{{ route('admin.collection_rounds.auto_add_bundles', $collectionRound->id) }}"
                            method="POST" class="fa-pull-right">
                            @csrf
                            <button type="submit"
                                    class="btn btn-sm btn-primary"
                                    style="margin-left: 5px">{{ __('admin.collection_rounds.auto_add_bundles') }}
                            </button>
                        </form>
                    @endif
                </div>
                <hr>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('admin.bundles.columns.status') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.submission_date') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.number_of_products') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.weight') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.donor') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.address') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($bundles->reverse() as $bundle)
                        <tr>
                            <th scope="row"><a href="{{ route('admin.bundles.show', $bundle->id) }}">
                                    <h4 class="h6 g-mb-2">#{{ $bundle->id }}</h4>
                                </a></th>
                            <td>{{ $bundle->getStatusName() }}</td>
                            <td>{{ $bundle->created_at->diffForHumans() }}</td>
                            <td>{{ count($bundle->products)  }}</td>
                            <td>{{ $bundle->weightAsMass()->toUnit('g') }} g</td>
                            <td>
                                {{ $bundle->donor->getFullName() }}
                            </td>
                            <td>{{ $bundle->donor->address->getFormatted() }}</td>
                            <td style="display: flex;">
                                @if($collectionRound->status == 0)
                                    <form action="{{ route('admin.collection_rounds.bundles.remove') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="collection_round_id"
                                               value="{{ $collectionRound->id }}">
                                        <input type="hidden" name="bundle_id" value="{{ $bundle->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.bundles.show', $bundle->id) }}">
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
                {{ __('admin.collection_rounds.no_bundle_message') }}
                <div style="display: inline">
                    <form
                        action="{{ route('admin.collection_rounds.auto_add_bundles', $collectionRound->id) }}"
                        method="POST" class="fa-pull-right">
                        @csrf
                        <button type="submit"
                                class="btn btn-sm btn-primary"
                                style="margin-left: 5px">{{ __('admin.collection_rounds.auto_add_bundles') }}
                        </button>
                    </form>
                </div>
            @endif
            @if($collectionRound->status == 3)
                <h4>{{ __('admin.index.products') }}</h4>
                <hr>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('admin.products.columns.barcode') }}</th>
                        <th scope="col">{{ __('admin.products.columns.name') }}</th>
                        <th scope="col">{{ __('admin.products.columns.expiration_date') }}</th>
                        <th scope="col">{{ __('admin.products.columns.quantity') }}</th>
                        <th scope="col">{{ __('admin.products.columns.weight') }}</th>
                        <th scope="col">{{ __('admin.products.columns.shelf') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">
                                {{ $product->barcode }}
                            </th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->expiration_date }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->weightAsMass()->toUnit('g') }} g</td>
                            <td>{{ $product->shelf_id }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
