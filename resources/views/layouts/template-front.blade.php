<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       @include('components.partials_frontend.head')
    </head>
    <body>
    <!--::header part start::-->
    @include('components.partials_frontend.header')
    <!-- Header part end-->

    @yield('content')

    <!--::footer_part start::-->
    @include('components.partials_frontend.footer')
    <!--::footer_part end::-->
    </body>
     <!-- jquery plugins here-->
     <script src="{{ asset('frontend/js/jquery-1.12.1.min.js') }}"></script>
     <!-- popper js -->
     <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
     <!-- bootstrap js -->
     <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
     <!-- easing js -->
     <script src="{{ asset('frontend/js/jquery.magnific-popup.js') }}"></script>
     <!-- swiper js -->
     <script src="{{ asset('frontend/js/swiper.min.js') }}"></script>
     <!-- swiper js -->
     <script src="{{ asset('frontend/js/masonry.pkgd.js') }}"></script>
     <!-- particles js -->
     <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
     <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
     <!-- slick js -->
     <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
     <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
     <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
     <script src="{{ asset('frontend/js/contact.js') }}"></script>
     <script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
     <script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
     <script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
     <script src="{{ asset('frontend/js/mail-script.js') }}"></script>
     <!-- custom js -->
     <script src="{{ asset('frontend/js/custom.js') }}"></script>
     @yield('js')
</html>
