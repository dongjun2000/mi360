<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                border: 1px solid #eee;
                width: 600px;
                border-radius: 10px;
                box-shadow: 1px 1px 10px 1px rgba(0, 0, 0, .5);
            }
        </style>

        @yield('css')
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                @yield('message')
            </div>
        </div>
    </body>
</html>
