    <!-- Header -->
    <header id="js-header" class="u-header u-header--static">
        <div class="u-header__section u-header__section--light g-bg-white g-transition-0_3 g-py-10">
            <nav class="js-mega-menu navbar navbar-expand-lg hs-menu-initialized hs-menu-horizontal">
                <div class="container">
                    <!-- Responsive Toggle Button -->
                    <button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-minus-3 g-right-0" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                  <span class="hamburger hamburger--slider">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                  </span>
                  </span>
                    </button>
                    <!-- End Responsive Toggle Button -->

                    <!-- Logo -->
                    <a href="{{ url('/') }}" class="navbar-brand d-flex">
                        @if (Auth::check())
                            @if (Auth::user()->type == 'employee')
                                <h1 class="d-inline-block g-brd-around g-brd-2 g-brd-white g-color-black g-font-weight-700 g-font-size-20 g-font-size-32--md text-uppercase g-line-height-1_2 g-letter-spacing-5 g-py-12 g-px-20 g-mb-50">FFW ADMIN</h1>
                            @else
                                <img src="{{ url('assets/img/logo/logo-ffw.svg') }}" alt="Logo">
                            @endif
                        @endif
                    </a>
                    <!-- End Logo -->

                    <!-- Navigation -->
                    <div class="collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg g-mr-40--lg" id="navBar">
                        <ul class="navbar-nav text-uppercase g-pos-rel g-font-weight-600 ml-auto">
                            <!-- Intro -->
                            <li class="nav-item  g-mx-10--lg g-mx-15--xl">
                                <a href="{{ route('home') }}" class="nav-link g-py-7 g-px-0">Home</a>
                            </li>
                            <li class="nav-item  g-mx-10--lg g-mx-15--xl">
                                <a href="{{ route('3d_demo') }}" class="nav-link g-py-7 g-px-0">3D Demonstration</a>
                            </li>
                            <!-- End Intro -->

                            <!-- Features -->
                            <li class="nav-item hs-has-sub-menu  g-mx-10--lg g-mx-15--xl" data-animation-in="fadeIn" data-animation-out="fadeOut">
                                <a id="nav-link--features" class="nav-link g-py-7 g-px-0" href="#" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu--features">Rounds</a>

                                <ul class="hs-sub-menu list-unstyled u-shadow-v11 g-brd-top g-brd-primary g-brd-top-2 g-min-width-220 g-mt-18 g-mt-8--lg--scrolling" id="nav-submenu--features" aria-labelledby="nav-link--features">
                                    <!-- Features - Headers -->
                                    <li class="dropdown-item ">
                                        <a class="nav-link" href="{{ route('collection-rounds.index') }}">Collection</a>
                                    </li>
                                    <!-- End Features - Headers -->

                                    <!-- Features - Promo blocks -->
                                    <li class="dropdown-item ">
                                        <a class="nav-link" href="#">Delivery</a>
                                    </li>
                                    <!-- End Features - Promo blocks -->

                                    <!-- End Features - Sliders -->
                                </ul>
                            </li>
                            <!-- End Features -->
                            <li class="nav-item g-mx-10--lg g-mx-15--xl" data-animation-in="fadeIn" data-animation-out="fadeOut">
                                <a href="{{ route('logout') }}" class="nav-link g-py-7 g-px-0" >Log out</a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Navigation -->

                    @if (!Auth::check())
                        <div class="d-inline-block g-hidden-md-down g-pos-rel g-valign-middle g-pl-30 g-pl-0--lg">
                            <a class="btn u-btn-outline-primary g-font-size-13 text-uppercase g-py-10 g-px-15" href="{{ url('register') }}">Join the program</a>
                        </div>
                    @endif
                </div>
            </nav>
        </div>
    </header>
    <!-- End Header -->
