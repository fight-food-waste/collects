@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.collection_rounds.create_new_collection_round') }}
        </div>

        <div class="card-body">

            {!! form($form) !!}
        </div>
    </div>


    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.index.collection_rounds') }}
            <form action="{{ route('admin.collection_rounds.store') }}" method="POST" class="fa-pull-right">
                @csrf
                <button type="submit" class="btn btn-sm btn-secondary">
                    <i class="fas fa-plus"></i>
                </button>
            </form>
        </div>

        <div class="card-body">
            @if (sizeof($collectionRounds) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('admin.collection_rounds.columns.status') }}</th>
                        <th scope="col">{{ __('admin.collection_rounds.columns.warehouse') }}</th>
                        <th scope="col">{{ __('admin.collection_rounds.columns.creation_date') }}</th>
                        <th scope="col">{{ __('admin.collection_rounds.columns.number_of_bundles') }}</th>
                        <th scope="col">{{ __('admin.collection_rounds.columns.weight') }}</th>
                        <th scope="col">{{ __('admin.collection_rounds.columns.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($collectionRounds->reverse() as $collectionRound)
                        <tr>
                            <th scope="row">
                                <a href="collection-rounds/{{ $collectionRound->id }}">
                                    <h4 class="h6 g-mb-2">#{{ $collectionRound->id }}</h4>
                                </a>
                            </th>
                            <td>{{ $collectionRound->getStatusName() }}</td>
                            <td>{{ $collectionRound->warehouse->name }}</td>
                            <td>{{ $collectionRound->created_at->diffForHumans() }}</td>
                            <td>{{ count($collectionRound->bundles)  }}</td>
                            <td>{{ $collectionRound->weightAsMass()->toUnit('kg') }} kg</td>
                            <td>
                                <a href="{{ route('admin.collection_rounds.show', $collectionRound->id) }}">
                                    <button class="btn btn-secondary edit-btn-table">
                                        <i class="far fa-edit"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                {{ __('admin.collection_rounds.no_collection_round_message') }}
            @endif
        </div>
    </div>
@endsection
