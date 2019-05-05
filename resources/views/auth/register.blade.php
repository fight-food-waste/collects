@extends('layouts.main')

@section('content')
<!-- Signup -->
<section class="g-bg-gray-light-v5">
    <div class="container g-py-100">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-9 col-lg-6">
                <div class="u-shadow-v21 g-bg-white rounded g-py-40 g-px-30">
                    <header class="text-center mb-4">
                        <h2 class="h2 g-color-black g-font-weight-600">Register</h2>
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

                  @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                  @endif

                    <!-- Form -->
                    <form class="g-py-15" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 mb-4">
                                <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">First name:</label>
                                <input name="first_name" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="text" placeholder="John">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>

                            <div class="col-xs-12 col-sm-6 mb-4">
                                <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Last name:</label>
                                <input name="last_name" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="text" placeholder="Doe">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Email:</label>
                            <input name="email" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="email" placeholder="johndoe@gmail.com">
                            @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 mb-4">
                                <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Password:</label>
                                <input name="password" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="password" placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="col-xs-12 col-sm-6 mb-4">
                                <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Confirm Password:</label>
                                <input name="password_confirmation" class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="password" placeholder="Password">
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row justify-content-between mb-5">
                            <div class="col-8 align-self-center">
                                <label class="form-check-inline u-check g-color-gray-dark-v5 g-font-size-13 g-pl-25">
                                    <input name="terms" class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                                    <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
                                        <i class="fa" data-check-icon="&#xf00c"></i>
                                    </div>
                                    I accept the <a href="#!">Terms and Conditions</a>
                                </label>
                                @if ($errors->has('terms'))
                                    <br><span class="text-danger">{{ $errors->first('terms') }}</span>
                                @endif
                            </div>
                            <div class="col-4 align-self-center text-right">
                                <button class="btn btn-md u-btn-primary rounded g-py-13 g-px-25" type="submit">Signup</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Form -->

                    <footer class="text-center">
                        <p class="g-color-gray-dark-v5 g-font-size-13 mb-0">Already have an account? <a class="g-font-weight-600" href="login">Login</a>
                        </p>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Signup -->
@endsection
