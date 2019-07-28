@extends('layouts.main', ['layout_size' => 10])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            <a href="{{ route('admin.collection_rounds.show', $collectionRound->id) }}">
                <button class="btn btn-sm btn-primary" style="margin-right:5px">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </a>
            Add bundles to collection round #{{ $collectionRound->id }}
            <a href="{{ $request->input('closest') === 'true' ? $request->fullUrlWithQuery(['closest' => 'false']) : $request->fullUrlWithQuery(['closest' => 'true']) }}"
               class="fa-pull-right">
                <button type="submit" class="btn btn-sm btn-secondary">
                    {{ $request->input('closest') === 'true' ? 'Show all available bundles' : 'Show closest bundles' }}
                </button>
            </a>
        </div>

        <div class="card-body">

            @if (sizeof($bundles) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Status</th>
                        <th scope="col">Submission date</th>
                        <th scope="col">Number of products</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Donor</th>
                        <th scope="col">City</th>
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
                            <td>{{ $bundle->weightAsMass()->toUnit('kg') }} kg</td>
                            <td>
                                {{ $bundle->donor->getFullName() }}
                            </td>
                            <td>{{ $bundle->donor->address->city }}</td>
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
                                    <form action="{{ route('admin.collection_rounds.add_bundle') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="bundle_id" value="{{ $bundle->id  }}">
                                        <input type="hidden" name="collection_round_id"
                                               value="{{ $collectionRound->id  }}">
                                        <button type="submit" class="btn btn-sm btn-secondary">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                There is no available bundle.<br>
                Either there isn't any approved bundle not assigned to a collection round, or there isn't
                enough free weight left in this collection round.
            @endif
        </div>
    </div>
@endsection
