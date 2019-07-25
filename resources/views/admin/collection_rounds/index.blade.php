@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card card-more">
                    <div class="card-header" style="font-weight: bold; font-size: large">
                        Create new collection round
                    </div>

                    <div class="card-body">

                        {!! form($form) !!}
                    </div>
                </div>


                <div class="card card-more">
                    <div class="card-header" style="font-weight: bold; font-size: large">
                        {{ __('Collection Rounds') }}
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Warehouse</th>
                                    <th scope="col">Creation date</th>
                                    <th scope="col">Number of bundles</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Action</th>
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
                                        <td>{{  date('d/m/Y', strtotime($collectionRound->created_at)) }}</td>
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
                            There is no collection round in the database.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
