@extends('layouts.main')

@section('content')

    <!-- Product Table Panel -->
    <div class="card border-0 collections-container">
        <div class="container">
{{--            <a href="#"--}}
{{--               class="btn u-btn-primary float-right"--}}
{{--               style="margin-bottom: 30px"--}}
{{--               data-modal-target="#modal1" data-modal-effect="fadein">Open New Round</a>--}}
{{--            <form method="POST" action="{{ route('collection-rounds.store') }}">--}}
{{--                @csrf--}}
{{--                <button type="submit"--}}
{{--                   class="btn u-btn-primary float-right"--}}
{{--                   style="margin-bottom: 30px">Open New Round</button>--}}
{{--            </form>--}}
            <a href="{{ route('collection-rounds.create') }}"
               class="btn u-btn-primary float-right"
               style="margin-bottom: 30px">Open New Round</a>
        </div>

        <div class="card-header d-flex align-items-center justify-content-between g-bg-gray-light-v5 border-0 g-mb-15">
            <h3 class="h6 mb-0">
                <i class="icon-directions g-pos-rel g-top-1 g-mr-5"></i> All collections rounds
            </h3>
        </div>

        <div class="card-block g-pa-0">
            <div class="table-responsive">
                <table class="table table-bordered u-table--v2">
                    <thead class="text-uppercase g-letter-spacing-1">
                    <tr>
                        <th class="g-font-weight-300 g-color-black">ID</th>
                        <th class="g-font-weight-300 g-color-black g-min-width-200">Round date</th>
                        <th class="g-font-weight-300 g-color-black">Employee name</th>
                        <th class="g-font-weight-300 g-color-black">Status</th>
                        <th class="g-font-weight-300 g-color-black">Action</th>
                        <th class="g-font-weight-300 g-color-black">Journey</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach ($collection_rounds->reverse() as $round)
                    <tr>
                        <td class="align-middle text-nowrap">
                            <a href="{{ route('collection-rounds.bundles', $round->id) }}">
                                <h4 class="h6 g-mb-2">#{{ $round->id }}</h4>
                            </a>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex">
                                <span>{{ date('d/m/Y', strtotime($round->round_date)) }}</span>
                            </div>
                        </td>
                        <td class="align-middle">
                            <h4 class="h6 g-mb-2">{{ App\CollectionRound::employeeFullName($round->user_id) }}</h4>
                        </td>
                        <td class="align-middle text-nowrap">
                            <h4 class="h6 g-mb-2">{{ $round->is_completed ? 'Completed' : 'Not completed' }}</h4>
                        </td>
                        <td class="align-middle">
                            @if (!$round->is_completed or $round->started_at == null)
                                <form action="{{ route('collection_rounds.start_round') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="round_id" value="{{ $round->id  }}">

                                    <button class="btn btn-primary" type="submit">Start round</button>
                                </form>
                            @elseif (!$round->is_completed and $round->started_at != null)
                                <form action="{{ route('collection_rounds.close_round') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="round_id" value="{{ $round->id  }}">

                                    <button class="btn btn-warning" type="submit">Close round</button>
                                </form>
                            @endif

                            <a href="{{ route('collection-rounds.bundles', $round->id) }}" class="btn btn-info">View round</a>
                        </td>
                        <td class="align-middle">
                            <a href="{{route('collection-rounds.addresses', $round->id) }}" class="btn btn-dark">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
