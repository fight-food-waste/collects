            <footer class="g-bg-gray-dark-v1 g-color-white-opacity-0_8 g-py-20">
                <!-- Copyright Footer -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 text-center text-md-left g-mb-10 g-mb-0--md">
                            <div class="d-lg-flex">
                                <small class="d-block g-font-size-default g-mr-10 g-mb-10 g-mb-0--md">2018 &copy; All Rights Reserved.</small>
                                <ul class="u-list-inline">
                                    <li class="list-inline-item">
                                        <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Privacy Policy</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <span>|</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Terms of Use</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <span>|</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">License</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <span>|</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Support</a>
                                        <span>|</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="g-color-white-opacity-0_8 g-color-white--hover" href="#">Français</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4 align-self-center">
                            <ul class="list-inline text-center text-md-right mb-0">
                                <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="Facebook">
                                    <a href="#" class="g-color-white-opacity-0_5 g-color-white--hover">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="Skype">
                                    <a href="#" class="g-color-white-opacity-0_5 g-color-white--hover">
                                        <i class="fa fa-skype"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="Linkedin">
                                    <a href="#" class="g-color-white-opacity-0_5 g-color-white--hover">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="Pinterest">
                                    <a href="#" class="g-color-white-opacity-0_5 g-color-white--hover">
                                        <i class="fa fa-pinterest"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="Twitter">
                                    <a href="#" class="g-color-white-opacity-0_5 g-color-white--hover">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item g-mx-10" data-toggle="tooltip" data-placement="top" title="Dribbble">
                                    <a href="#" class="g-color-white-opacity-0_5 g-color-white--hover">
                                        <i class="fa fa-dribbble"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- JS Global Compulsory -->
                <script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
                <script src="{{ url('assets/vendor/jquery-migrate/jquery-migrate.min.js') }}"></script>
                <script src="{{ url('assets/vendor/popper.min.js') }}"></script>
                <script src="{{ url('assets/vendor/bootstrap/bootstrap.min.js') }}"></script>

                <!-- JS Implementing Plugins -->
                <script src="{{ url('assets/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
                <script src="{{ url('assets/vendor/dzsparallaxer/dzsparallaxer.js') }}"></script>
                <script src="{{ url('assets/vendor/dzsparallaxer/dzsscroller/scroller.js') }}"></script>
                <script src="{{ url('assets/vendor/dzsparallaxer/advancedscroller/plugin.js') }}"></script>
                <script src="{{ url('assets/vendor/chosen/chosen.jquery.js') }}"></script>
                <script src="{{ url('assets/vendor/image-select/src/ImageSelect.jquery.js') }}"></script>
                <script src="{{ url('assets/vendor/masonry/dist/masonry.pkgd.min.js') }}"></script>
                <script src="{{ url('assets/vendor/imagesloaded/imagesloaded.js') }}"></script>
                <script src="{{ url('assets/vendor/slick-carousel/slick/slick.js') }}"></script>

                <!-- JS Unify -->
                <script src="{{ url('assets/js/hs.core.js') }}"></script>
                <script src="{{ url('assets/js/components/hs.header.js') }}"></script>
                <script src="{{ url('assets/js/helpers/hs.hamburgers.js') }}"></script>
                <script src="{{ url('assets/js/components/hs.scroll-nav.js') }}"></script>
                <script src="{{ url('assets/js/components/hs.go-to.js') }}"></script>
                <script src="{{ url('assets/js/components/hs.sticky-block.js') }}"></script>
                <script src="{{ url('assets/js/helpers/hs.height-calc.js') }}"></script>
                <script src="{{ url('assets/js/components/hs.carousel.js') }}"></script>
                <script src="{{ url('assets/js/components/hs.modal-window.js') }}"></script>

                <script  src="{{ url('assets/vendor/custombox/custombox.min.js') }}"></script>

                <!-- JS Custom -->
                <script src="{{ url('assets/js/custom.js') }}"></script>

                <!-- JS Plugins Init. -->
                <script>
                    $(document).on('ready', function () {
                        // initialization of carousel
                        $.HSCore.components.HSCarousel.init('.js-carousel');

                        // Header
                        $.HSCore.components.HSHeader.init($('#js-header'));
                        $.HSCore.helpers.HSHamburgers.init('.hamburger');

                        // Modal
                        $.HSCore.components.HSModalWindow.init('[data-modal-target]');

                        // initialization of HSMegaMenu plugin
                        $('.js-mega-menu').HSMegaMenu({
                            event: 'hover',
                            pageContainer: $('.container'),
                            breakpoint: 991
                        });

                        // initialization of go to
                        $.HSCore.components.HSGoTo.init('.js-go-to');

                        $.HSCore.helpers.HSHeightCalc.init();
                    });

                    $(window).on('load', function () {
                        // initialization of HSScrollNav
                        $.HSCore.components.HSScrollNav.init($('#js-scroll-nav'), {
                            duration: 700,
                            over: $('.u-secondary-navigation')
                        });

                        // initialization of masonry.js
                        $('.masonry-grid').imagesLoaded().then(function () {
                            $('.masonry-grid').masonry({
                                // options
                                columnWidth: '.masonry-grid-sizer',
                                itemSelector: '.masonry-grid-item',
                                percentPosition: true
                            });
                        });

                        // initialization of sticky blocks
                        $.HSCore.components.HSStickyBlock.init('.js-sticky-block');
                    });
                </script>
            </footer>
            <!-- End Copyright Footer -->
            <a class="js-go-to u-go-to-v1" href="#" data-type="fixed" data-position='{
             "bottom": 15,
             "right": 15
           }' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
            <i class="hs-icon hs-icon-arrow-top"></i>
            </a>
        </main>

        <div class="u-outer-spaces-helper"></div>

    </body>
