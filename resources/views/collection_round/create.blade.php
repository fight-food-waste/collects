@extends('layouts.main')

@section('content')
    <section class="g-bg-gray-light-v5">
        <div class="container g-py-100">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-9 col-lg-6">
                    <div class="u-shadow-v21 g-bg-white rounded g-py-40 g-px-30">
                        <header class="text-center mb-4">
                            <h2 class="h2 g-color-black g-font-weight-600">New collect</h2>
                        </header>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif

                    <!-- Form -->
                        <form class="g-py-15" method="POST" action="{{ route('collection-rounds.store') }}">
                            @csrf

                            <div class="mb-4">
                                <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Employee:</label><br>

                                <select class="js-custom-select u-select-v1 g-brd-gray-light-v3 g-color-gray-dark-v5 rounded g-py-12" name="user_id">

                                    <option>Select Employee</option>

                                    @foreach ($employees as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>


{{--                                @if ($errors->has('user_id'))--}}
{{--                                    <span class="text-danger">{{ $errors->first('user_id') }}</span>--}}
{{--                                @endif--}}
                            </div>

                            <div class="mb-4">
                                <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Collection date:</label>
                                <input name="round_date" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="date">
{{--                                @if ($errors->has('password'))--}}
{{--                                    <span class="text-danger">{{ $errors->first('password') }}</span>--}}
{{--                                @endif--}}
                            </div>

                            <center>
                                <button class="btn btn-md u-btn-primary rounded g-py-13 g-px-25" type="submit">Open collection</button>
                            </center>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Signup -->
@endsection
