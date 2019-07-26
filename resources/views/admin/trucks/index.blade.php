@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card card-more">
                    <div class="card-header" style="font-weight: bold; font-size: large">
                        {{ __('Trucks') }}</div>

                    <div class="card-body">

                        @if (sizeof($trucks) > 0)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Warehouse</th>
                                    <th scope="col">Capacity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Collection Round</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($trucks as $truck)
                                    <tr>
                                        <th scope="row">
                                            {{ $truck->id }}
                                        </th>
                                        <td>{{ $truck->warehouse->name }}</td>
                                        <td>{{ $truck->capacity }} kg</td>
                                        <td>{{ $truck->collection_round_id == null ? 'Available' : 'Ongoing' }}</td>
                                        <td>
                                            @if($truck->collection_round_id == null)
                                                None
                                            @else
                                                <a href="{{ route('admin.collection_rounds.show', $truck->collection_round_id) }}">#{{ $truck->collection_round_id }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There is no truck in the database.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
