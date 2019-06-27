@extends('layouts.main')

@section('content')
    <div class="card border-0 collections-container">
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="card-header d-flex align-items-center justify-content-between g-bg-gray-light-v5 border-0 g-mb-15">
                <h3 class="h6 mb-0">
                    <i class="icon-directions g-pos-rel g-top-1 g-mr-5"></i> All bundles
                </h3>
            </div>

            <div class="card-block g-pa-0">
                <div class="table-responsive">
                    <table class="table table-bordered u-table--v2">
                        <thead class="text-uppercase g-letter-spacing-1">
                        <tr>
                            <th class="g-font-weight-300 g-color-black">ID</th>
                            <th class="g-font-weight-300 g-color-black g-min-width-200">Status</th>
                            <th class="g-font-weight-300 g-color-black">Submission Date</th>
                            <th class="g-font-weight-300 g-color-black">Validation Date</th>
                            <th class="g-font-weight-300 g-color-black">Donor name</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach ($bundles->reverse() as $bundle)
                            <tr>
                                <td class="align-middle text-nowrap">
                                    <a href="{{ route('bundles.products', $bundle->id) }}">
                                        <h4 class="h6 g-mb-2">#{{ $bundle->id }}</h4>
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex">
                                        <h4 class="h6 g-mb-2">{{ $bundle->bundle_status_id ? App\Bundle::bundleStatusName($bundle->bundle_status_id) : 'Not validated' }}</h4>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span>{{  date('d/m/Y', strtotime($bundle->created_at)) }}</span>
                                </td>
                                <td class="align-middle text-nowrap">
                                    <span>{{ $bundle->validated_at ? date('d/m/Y', strtotime($bundle->validated_at)) : 'Not validated' }}</span>
                                </td>
                                <td class="align-middle">
                                    <h4 class="h6 g-mb-2">
                                        {{ App\Bundle::bundleUserName($bundle->user_id) }}
                                    </h4>
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
