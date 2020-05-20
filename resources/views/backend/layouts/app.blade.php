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
    <title>@yield('title', 'Camokakis Music Stations')</title>
    <!--<meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">-->
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @push('before-styles')
    	
    @endpush
    
    @push('after-styles')
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    @endpush

    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}

    @stack('after-styles')
    @yield('pagestyles')
</head>

<body class="{{ config('backend.body_classes') }}">
    @include('backend.includes.header')

    <div class="app-body">
        @include('backend.includes.sidebar')

        <main class="main">
            @include('includes.partials.logged-in-as')
            @if (Breadcrumbs::exists()) 
                {!! Breadcrumbs::render() !!}
            @endif

            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div><!--content-header-->

                    @include('includes.partials.messages')
                    @yield('content')
                </div><!--animated-->
            </div><!--container-fluid-->
        </main><!--main-->

        @include('backend.includes.aside')
    </div><!--app-body-->

    @include('backend.includes.footer')

    <!-- Scripts -->
   @push('before-scripts') 

  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#date').datetimepicker({
            format: 'YYYY/MM/DD'
        });

        $('#datetimepicker').datetimepicker(
            {                
                format: 'HH:mm',
                pickDate:false
            });
        $('#datetimepicker_end').datetimepicker(
            {                
                format: 'HH:mm',
                pickDate:false
            });

        $('#datetimepicker_edit').datetimepicker(
            {
                format: 'HH:mm',
                pickDate:false

            });
        $('#datetimepicker_end_edit').datetimepicker(
            {
                format: 'HH:mm',
                pickDate:false

            });

        $('#select_days').select2();
    </script>

@endpush

    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    @stack('after-scripts')
    @yield('pagescripts')
</body>
</html>
