@extends('layouts.main', ['layout_size' => 12])

@section('content')
    <div class="card card-more">
        <div class="card-header" style="font-weight: bold; font-size: large">
            {{ __('admin.index.categories') }}</div>

        <div class="card-body">

            @if (sizeof($categories) > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">EN</th>
                        <th scope="col">FR</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">
                                {{ $category->id }}
                            </th>
                            <td>{{ $category->translation('en') === null ? '-' : $category->translation('en')->name }}</td>
                            <td>{{ $category->translation('fr') === null ? '-' : $category->translation('fr')->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                {{ __('admin.categories.no_category_message') }}
            @endif
        </div>
    </div>
@endsection
