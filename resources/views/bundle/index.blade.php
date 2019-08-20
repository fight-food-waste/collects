@extends('layouts.main', ['layout_size' => 10])


@section('content')
    <div class="card card-more">
        <div class="card-header">{{ __('admin.index.bundles') }}</div>

        <div class="card-body">

            @if (sizeof($bundles) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('admin.bundles.columns.status') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.submission_date') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.number_of_products') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.donor') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($bundles->reverse() as $bundle)
                        <tr>
                            <th scope="row"><a href="{{ route('bundle.show', $bundle->id) }}">
                                    <h4 class="h6 g-mb-2">#{{ $bundle->id }}</h4>
                                </a></th>
                            <td>{{ $bundle->getStatusName() }}</td>
                            <td>{{ $bundle->created_at->diffForHumans() }}</td>
                            <td>{{ count($bundle->products)  }}</td>
                            <td>
                                {{ $bundle->donor->getFullName() }}
                            </td>
                            <td style="display: flex;">
                                <a class="btn btn-sm btn-info" href="{{ route('bundle.show', $bundle->id) }}"
                                   style="color: #fff" title="Display products">
                                    <i class="fas fa-shopping-basket"></i>
                                </a>
                                @if($bundle->status >= 0)
                                    <form action="{{ route('bundle.destroy', $bundle->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="bundle_id" value="{{ $bundle->id }}">
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
