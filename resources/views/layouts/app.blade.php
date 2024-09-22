<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>車のことなら「Car Sommelier」</title>

        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />

        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital@1&family=Orbitron&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru:wght@500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- style.css -->
        <link rel="stylesheet" href="{{ asset('css/fuel.css') }}">
        <link rel="stylesheet" href="{{ asset('css/gas_station.css') }}">
        <link rel="stylesheet" href="{{ asset('css/contact.css') }}">

        <!-- jquery CDN -->
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
        </script>
    </head>
    <body>
        @include('hf.header')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

        @include('hf.footer')

        <!-- js -->
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <script src="{{ asset('js/gas_station.js') }}"></script>
        <script src="https://maps.gsi.go.jp/js/muni.js"></script><!-- 変換表の読込-->
        
    </body>
</html>
