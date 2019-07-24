@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
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
                                        <th scope="row"><a href="bundles/{{ $bundle->id }}/products">
                                                <h4 class="h6 g-mb-2">#{{ $bundle->id }}</h4>
                                            </a></th>
                                        <td>{{ $bundle->getStatusName() }}</td>
                                        <td>{{  date('d/m/Y', strtotime($bundle->created_at)) }}</td>
                                        <td>{{ count($bundle->products)  }}</td>
                                        <td>
                                            {{ $bundle->donor->getFullName() }}
                                        </td>
                                        <td style="display: flex;">
                                            <form action="{{ route('admin.bundles.validate', $bundle->id) }}"
                                                  method="POST">
                                                @csrf
                                                <input type="hidden" name="bundle_id" value="{{ $bundle->id  }}">
                                                <button type="button" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.bundles.reject', $bundle->id) }}"
                                                  method="POST">
                                                @csrf
                                                <input type="hidden" name="bundle_id" value="{{ $bundle->id  }}">
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>

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
