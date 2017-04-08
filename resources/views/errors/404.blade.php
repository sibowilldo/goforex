<!DOCTYPE html>
<html>
    <head>
        <title>FourOFour</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
                background: #ecf0f5 url(/img/svgbull.svg) no-repeat fixed 50%/50%;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <h1>404 <br>
                <small>We could not find what you were looking for!</small></h1>
                <div class="title">You gotta give us credit for trying though.</div>
                <strong><a href="{{ url('/') }}">Home</a> | <a href="{{ url('/home') }}">Dashboard</a> @if(!Auth::check()) 
                | <a href="{{ url('/login') }}">Login</a> 
                @endif</strong>
            </div>
        </div>
    </body>
</html>
