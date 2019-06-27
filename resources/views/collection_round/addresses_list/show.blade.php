@extends('layouts.main')

@section('content')
    <div class="card border-0 collections-container">
        <div class="container">
            <div class="card-header d-flex align-items-center justify-content-between g-bg-gray-light-v5 border-0 g-mb-15">
                <h3 class="h6 mb-0">
                    <i class="icon-directions g-pos-rel g-top-1 g-mr-5"></i> Journey: addresses
                </h3>
            </div>

            <div class="card-block g-pa-0">
                <div class="table-responsive">
                    <table class="table table-bordered u-table--v2">
                        <thead class="text-uppercase g-letter-spacing-1">
                        <tr>
                            <th class="g-font-weight-300 g-color-black">ID</th>
                            <th class="g-font-weight-300 g-color-black">Donor name</th>
                            <th class="g-font-weight-300 g-color-black g-min-width-200">Full Address</th>
{{--                            <th class="g-font-weight-300 g-color-black">Donor name</th>--}}
                        </tr>
                        </thead>

                        <tbody>

                        @foreach ($addresses->reverse() as $address)
                            <tr>
                                <td class="align-middle text-nowrap">
                                    <a href="{{ route('bundles.products', $address->id) }}">
                                        <h4 class="h6 g-mb-2">#{{ $address->id }}</h4>
                                    </a>
                                </td>
                                <td class="align-middle">
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex">
                                        <h4 class="h6 g-mb-2">{{ App\Address::fullAddress($address->id) }}</h4>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- AFFICHER LES PRODUITS DU BUNDLE --}}
