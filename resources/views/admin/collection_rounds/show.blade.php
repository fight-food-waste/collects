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
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card card-more">
                    <div class="card-header">Collection round #{{ $collectionRound->id  }}</div>

                    <div class="card-body">

                        @if (sizeof($bundles) > 0)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Submission date</th>
                                    <th scope="col">Number of products</th>
                                    <th scope="col">Donor</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($bundles->reverse() as $bundle)
                                    <tr>
                                        <th scope="row"><a href="bundles/{{ $bundle->id }}">
                                                <h4 class="h6 g-mb-2">#{{ $bundle->id }}</h4>
                                            </a></th>
                                        <td>{{ $bundle->getStatusName() }}</td>
                                        <td>{{  date('d/m/Y', strtotime($bundle->created_at)) }}</td>
                                        <td>{{ count($bundle->products)  }}</td>
                                        <td>
                                            {{ $bundle->donor->getFullName() }}
                                        </td>
                                        <td style="display: flex;">
                                            <form action="{{ route('admin.collection_rounds.bundles.remove', $collectionRound->id) }}"
                                                  method="POST">
                                                @csrf
                                                <input type="hidden" name="bundle_id" value="{{ $bundle->id  }}">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There is no bundle in this collection round.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
