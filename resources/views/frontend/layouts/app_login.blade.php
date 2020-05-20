<!DOCTYPE html>


    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Radio CMS')</title>
        <!--<meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">-->
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
         @push('after-styles')

         	<link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}">

         @endpush
        

        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/frontend.css')) }}

        @stack('after-styles')
    </head>
    <body>
        <!--<div id="app">-->
            @include('includes.partials.logged-in-as')
          <!--  @include('frontend.includes.nav_login')-->

            <div class="container_login" style="background-image: url(../img/backend/Login-background.png);height:1080px">
                @include('includes.partials.messages')
                @yield('content')
            </div><!-- container -->
        <!--</div>--><!-- #app -->

        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!}
        
        @stack('after-scripts')

        @include('includes.partials.ga')
    </body>
</html>
