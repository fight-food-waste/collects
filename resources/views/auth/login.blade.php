@extends('layouts.main')

@section('content')
<!-- Signup -->
<section class="g-bg-gray-light-v5">
    <div class="container g-py-100">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-9 col-lg-6">
                <div class="u-shadow-v21 g-bg-white rounded g-py-40 g-px-30">
                    <header class="text-center mb-4">
                        <h2 class="h2 g-color-black g-font-weight-600">Login</h2>
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
                    <form class="g-py-15" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Email:</label>
                            <input name="email" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="email" placeholder="johndoe@gmail.com">
                            @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Password:</label>
                            <input name="password" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="password" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <center>
                            <button class="btn btn-md u-btn-primary rounded g-py-13 g-px-25" type="submit">Login</button>
                        </center>
                    </form>
                    <!-- End Form -->

                    <footer class="text-center">
                        <p class="g-color-gray-dark-v5 g-font-size-13 mb-0">Don't have an account? <a class="g-font-weight-600" href="{{ url('register') }}">Sign up</a>
                        </p>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Signup -->
@endsection
