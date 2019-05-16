@extends('layouts.main')

@section('content')
<!-- Signup -->
<section class="g-bg-gray-light-v5">
    <div class="container g-py-100">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-9 col-lg-6">
                <div class="u-shadow-v21 g-bg-white rounded g-py-40 g-px-30">
                    <header class="text-center mb-4">
                        <h2 class="h2 g-color-black g-font-weight-600">Who are you?</h2>
                    </header>

                    <div>
                        <ul>
                            <li><a href="{{ url('register/donor') }}">Donor</a></li>
                            <li><a href="{{ url('register/needy_person') }}">Needy Person</a></li>
                            <li><a href="{{ url('register/storekeeper') }}">Storekeeper</a></li>
                        </ul>
                    </div>

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
