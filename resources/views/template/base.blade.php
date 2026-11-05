<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="@yield('meta_description', 'InfoPulso - Tu portal de noticias de actualidad, análisis y opinión comunitaria.')" />
        <meta name="author" content="@yield('meta_author', 'InfoPulso')" />
        <title>@yield('title', 'InfoPulso - Diario de Actualidad')</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        @stack('styles')
    </head>
    <body>
        <!-- Responsive navbar-->
        @include('partials.nav')

        <!-- Page header with logo and tagline (opcional según la vista)-->
        @yield('header')

        <!-- Page content-->
        <div class="@yield('container_class', 'container py-4')">
            <div class="row">
                <!-- Blog entries / Post content-->
                <div class="col-lg-8">
                    @yield('content')
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    @include('partials.sidebar')
                </div>
            </div>
        </div>

        <!-- Footer-->
        @include('partials.footer')

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        @stack('scripts')
    </body>
</html>

