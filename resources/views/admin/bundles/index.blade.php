@extends('layouts.main', ['layout_size' => 12])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.index.bundles') }}</div>

        <div class="card-body">

            @if (sizeof($bundles) > 0)
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
                            <td>{{ $bundle->weightAsMass()->toUnit('kg') }} kg</td>
                            <td>{{ $bundle->donor->getFullName() }}</td>
                            <td>{{ $bundle->donor->address->getFormatted() }}</td>
                            <td style="display: flex;">
                                @if($bundle->status <= 0)
                                    <form action="{{ route('admin.bundles.approve') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="bundle_id" value="{{ $bundle->id  }}">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                                @if($bundle->status >= 0)
                                    <form action="{{ route('admin.bundles.reject') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="bundle_id" value="{{ $bundle->id  }}">
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
                {{ __('admin.bundles.no_bundle_message') }}
            @endif
        </div>
    </div>
@endsection
