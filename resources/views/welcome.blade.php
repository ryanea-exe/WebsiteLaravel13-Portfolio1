<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Responsive Portfolio Website</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('template/assets/fonts/unicons/css/line.css') }}">

        @if (Request::is('/'))
            <!-- CSS -->
            <!-- SWIPER CSS -->
            <link rel="stylesheet" href="{{ asset('template/assets/css/swiper-bundle.min.css') }}">
            <link rel="stylesheet" href="{{ asset('template/assets/css/styles.css') }}">
            @fonts

            <!-- Styles / Scripts -->
            @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
                @vite(['resources/css/app.css', 'resources/js/app.js'])
            @endif

            <!--==================== SWIPER JS ====================-->
            <script src="{{ asset('template/assets/js/swiper-bundle.min.js') }}" defer></script>
            <!--==================== MAIN JS ====================-->
            <script src="{{ asset('template/assets/js/main.js') }}" defer></script>

        @else
            <!-- Fonts -->
            <link rel="stylesheet" href="{{ asset('template/assets/fonts/fontawesome-free/css/all.min.css') }}">
            <!-- CSS -->
            <link rel="stylesheet" href="{{ asset('template/assets/css/admin.css') }}">

            <!-- Styles / Scripts -->
            @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
                @vite(['resources/css/admin.css', 'resources/js/admin.js'])
            @endif

            <script src="{{ asset('template/assets/js/admin.js') }}" defer></script>
            <script src="{{ asset('template/assets/js/Chart.min.js') }}" defer></script>
            <script defer>
                const ctx = document.getElementById('myChart');
            
                new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                    y: {
                        beginAtZero: true
                    }
                    }
                }
                });
            </script>

        @endif
    </head>

    <body>
        @if (Request::is('/'))
            <div id="app"></div>
        @else
            <main>
                <div id="admin"></div>
            </main>
        @endif
    </body>
</html>
