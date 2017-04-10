<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zeit für Bier am Freitag?</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Press+Start+2P|Ubuntu" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet" type="text/css">

        <!-- JavaScripts -->
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery.countdown.min.js"></script>
        <script type="text/javascript" src="/js/app.js"></script>
        @stack('scripts')
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <h5>Ist schon wieder Zeit für</h5>
                    <h2>DEV - BaF</h2>
                    <h5>?</h5>

                    @if($isDevBaF)
                        @include('devbaf')
                    @else
                        @include('nodevbaf')
                    @endif

                </div>
            </div>
        </div>
    </body>
</html>
