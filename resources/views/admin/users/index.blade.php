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
                            <td>{{ $user->getStatusName() }}</td>
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
                        <th scope="col">Action</th>
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
                            <td>{{ $user->getStatusName() }}</td>
                            <td>{{ $user->type }}</td>
                            <td style="display: flex;">
                                @if($user->status <= 0)
                                    <form action="{{ route('admin.users.approve') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id  }}">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                                @if($user->status >= 0)
                                    <form action="{{ route('admin.users.reject') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id  }}">
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
                There is no needy person waiting for approval.
            @endif
        </div>
    </div>
@endsection
