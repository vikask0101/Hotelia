<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Morris -->
    <link href="{{ asset('css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <div id="wrapper">
        <x-backend.sidebar />

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <x-backend.navbar />
            </div>
            {{-- Only show when admin access dashboard --}}
            @if (Route::currentRouteName() === 'admin.dashboard')
            <div class="wrapper wrapper-content">
                {{ $slot }}
            </div>
            @else
            {{-- For other routes --}}
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>{{ $pageHeading }}</h2>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                {{ $slot }}
            </div>
            @endif
            <x-backend.footer />
        </div>
    </div>

    <!-- Mainly scripts -->
    <x-backend.scripts />
    @stack('scripts')
</body>

</html>
