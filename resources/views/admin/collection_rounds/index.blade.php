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
                    <div class="card-header">{{ __('Collection Rounds') }}</div>

                    <div class="card-body">

                        @if (sizeof($collectionRounds) > 0)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Creation date</th>
                                    <th scope="col">Number of bundles</th>
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
                                        <td>{{  date('d/m/Y', strtotime($collectionRound->created_at)) }}</td>
                                        <td>{{ count($collectionRound->bundles)  }}</td>
                                        <td>
                                            <a href="collection-rounds/{{ $collectionRound->id }}">
                                                <button class="btn btn-secondary">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There is no bundle in the database.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
