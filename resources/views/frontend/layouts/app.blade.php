<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Radio CMS')</title>
        <meta name="description" content="@yield('meta_description', 'Camokakis is a brand new free radio app offering uninterrupted streaming of all the music you love (88.3JIA, 88.3JIA WEB HITS, 88.3JIA K-POP, POWER 98 LOVE SONGS, POWER 98 HITS!, POWER 98 RAW). Download Camokakis now and experience the best of music on the go!')">
        <meta name="author" content="@yield('meta_author', 'Camokakis')">
        @yield('meta')
        @yield('pagestyles')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/frontend.css')) }}

        @stack('after-styles')
    </head>
    <body>
        <div id="app">
            @include('includes.partials.logged-in-as')
            @include('frontend.includes.nav')

            <div class="container">
                @include('includes.partials.messages')
                @yield('content')
            </div><!-- container -->
        </div><!-- #app -->

        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!}
        {!! script(mix('js/frontend.js')) !!}
        @stack('after-scripts')
        @yield('pagescripts')

        @include('includes.partials.ga')
    </body>
</html>
