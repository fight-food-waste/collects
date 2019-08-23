<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('main.login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('main.register') }}</a>
                            </li>
                        @endif
                        @foreach (Config::get('languages') as $locale => $language)
                            @if ($locale != App::getLocale())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('lang.switch', $locale) }}">{{$language}}</a>
                                </li>
                            @endif
                        @endforeach
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                @if(Auth::user()->type == "donor")
                                    <a class="dropdown-item" href="{{ route('bundle.index') }}">
                                        {{ __('main.bundles') }}
                                    </a>
                                @endif

                                @if(Auth::user()->type == "needyperson")
                                    <a class="dropdown-item" href="{{ route('delivery_requests.index') }}">
                                        {{ __('main.delivery_requests') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('products.index') }}">
                                        {{ __('main.products') }}
                                    </a>
                                @endif

                                @if(Auth::user()->type == "member")
                                    <a class="dropdown-item" href="{{ route('membership') }}">
                                        {{ __('main.membership') }}
                                    </a>
                                @endif


                                @if(Auth::user()->type == "employee")
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                        {{ __('main.admin') }}
                                    </a>
                                @endif

                                    @if(Auth::user()->type == "storekeeper")
                                        <a class="dropdown-item" href="{{ route('membership') }}">
                                            {{ __('main.membership') }}
                                        </a>
                                    @endif

                                <a class="dropdown-item" href="{{ route('account.index') }}">
                                    {{ __('main.account') }}
                                </a>

                                    @foreach (Config::get('languages') as $locale => $language)
                                        @if ($locale != App::getLocale())
                                            <a class="dropdown-item"
                                               href="{{ route('lang.switch', $locale) }}">{{$language}}</a>
                                        @endif
                                    @endforeach


                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('main.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-{{ $layout_size }}">

                    @include('partials.alert')

                    @yield('content')

                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
