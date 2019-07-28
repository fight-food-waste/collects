@extends('layouts.main', ['layout_size' => 10])


@section('content')
    <div class="card card-more">
        <div class="card-header">{{ __('Bundles') }}</div>

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
                            <th scope="row"><a href="{{ route('bundle.show', $bundle->id) }}">
                                    <h4 class="h6 g-mb-2">#{{ $bundle->id }}</h4>
                                </a></th>
                            <td>{{ $bundle->getStatusName() }}</td>
                            <td>{{  date('d/m/Y', strtotime($bundle->created_at)) }}</td>
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
                There is no bundle in the database.
            @endif
        </div>
    </div>
@endsection
