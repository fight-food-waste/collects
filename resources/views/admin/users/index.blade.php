@extends('layouts.main', ['layout_size' => 12])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('Users') }}</div>

        <div class="card-body">

            @if (sizeof($users) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">
                                {{ $user->id }}
                            </th>
                            <td>{{ $user->getFullName() }}</td>
                            <td>{{ $user->email }} kg</td>
                            <td>{{ $user->address->getFormatted() }}</td>
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->type }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                There is no truck in the database.
            @endif
        </div>
    </div>

    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('Unapproved needy people') }}</div>

        <div class="card-body">

            @if (sizeof($unapprovedNeedyPeople) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($unapprovedNeedyPeople as $user)
                        <tr>
                            <th scope="row">
                                {{ $user->id }}
                            </th>
                            <td>{{ $user->getFullName() }}</td>
                            <td>{{ $user->email }} kg</td>
                            <td>{{ $user->address->getFormatted() }}</td>
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->type }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                There is no truck in the database.
            @endif
        </div>
    </div>
@endsection
