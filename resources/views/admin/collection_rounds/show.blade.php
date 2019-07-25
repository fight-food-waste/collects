@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if (sizeof($bundles) > 0)
                    <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
                    <link type="text/css" rel="stylesheet"
                          href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>
                    <script type="text/javascript">
                        window.onload = function () {
                            L.mapquest.key = 'yrCvLqrZ5IY2zsIcQqHF1ZlbkGsU7TJ5';

                            var directions = L.mapquest.directions();
                            directions.route({
                                start: '242 Rue du Faubourg Saint-Antoine, 75012 Paris',
                                end: '220 Rue du Faubourg Saint-Antoine, 75012 Paris',
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
                        Collection round #{{ $collectionRound->id  }}

                        @if (sizeof($bundles) > 0)
                            <button class="btn btn-sm btn-primary"
                                    onclick="toggleMap()">
                                <i class="fas fa-map"></i>
                            </button>
                        @endif

                        <form action="{{ route('admin.collection_rounds.destroy') }}" method="POST"
                              class="fa-pull-right">
                            @csrf
                            <input type="hidden" name="collection_round_id" value="{{ $collectionRound->id }}">
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{ route('admin.collection_rounds.add_bundles', $collectionRound->id) }}"
                           class="fa-pull-right">
                            <button type="submit" class="btn btn-sm btn-secondary">
                                <i class="fas fa-plus"></i>
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        @if (sizeof($bundles) > 0)
                            <div id="mapquest">Map
                                <hr>
                                <div id="map" style="width: 100%; height: 400px;"></div>
                                <br>
                            </div>

                            <p>This collection round contains {{ count($collectionRound->bundles)  }} bundles for a
                                total of {{ $collectionRound->weightAsMass()->toUnit('kg') }} kg. It is attached to
                                the {{ $collectionRound->warehouse->name }} warehouse.</p>

                            <div style="display: inline">
                                Bundles
                                <form action="{{ route('admin.collection_rounds.auto_add_bundles', $collectionRound->id) }}"
                                      method="POST" class="fa-pull-right">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"
                                            style="margin-left: 5px">Automatically add bundles
                                    </button>
                                </form>
                            </div>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Submission date</th>
                                    <th scope="col">Number of products</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Donor</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($bundles->reverse() as $bundle)
                                    <tr>
                                        <th scope="row"><a href="{{ route('admin.bundles.show', $bundle->id) }}">
                                                <h4 class="h6 g-mb-2">#{{ $bundle->id }}</h4>
                                            </a></th>
                                        <td>{{ $bundle->getStatusName() }}</td>
                                        <td>{{  date('d/m/Y', strtotime($bundle->created_at)) }}</td>
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
                                                <button class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There is no bundle in this collection round.
                            <div style="display: inline">
                                <form action="{{ route('admin.collection_rounds.auto_add_bundles', $collectionRound->id) }}"
                                      method="POST" class="fa-pull-right">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"
                                            style="margin-left: 5px">Automatically add bundles
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
