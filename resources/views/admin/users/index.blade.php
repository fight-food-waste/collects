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
                        <th scope="col">{{ __('admin.products.columns.name') }}</th>
                        <th scope="col">{{ __('signup.email') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.address') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.status') }}</th>
                        <th scope="col">{{ __('admin.singular.type') }}</th>
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
                {{ __('admin.trucks.no_truck_message') }}
            @endif
        </div>
    </div>

    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.needy_people.unapproved_needy_people') }}</div>

        <div class="card-body">

            @if (sizeof($unapprovedNeedyPeople) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('admin.products.columns.name') }}</th>
                        <th scope="col">{{ __('signup.email') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.address') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.status') }}</th>
                        <th scope="col">{{ __('admin.singular.type') }}</th>
                        <th scope="col">{{ __('admin.needy_people.application_file') }}</th>
                        <th scope="col">{{ __('admin.bundles.columns.action') }}</th>
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
                            <td>
                                <a href="{{ route('admin.users.application_files.download', $user->application_filename) }}">
                                    <button type="button" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </a>
                            </td>
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
                {{ __('admin.needy_people.no_needy_person_message') }}
            @endif
        </div>
    </div>
@endsection
