<!DOCTYPE html>
<html>
    <head>
        <title>FourOh!Four</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            *{transition: all ease 500ms}
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
                background: #263238 url(/img/svgbull.svg) no-repeat center top;
                background-size: 15em;
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
            .container a {
                color: white;
                display: inline-block;
                min-width: 60px;
                border: 1px solid #fff;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                text-decoration: none;
                line-height: 24px;
                font-size: 14px;

            }
            .container a:hover {
                color: #B0BEC5;
                border: 1px solid #B0BEC5;

            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <h1>FourOh!Four<br>
                <small>We could not find what you were looking for!</small></h1>
                <strong><a href="{{ url('/') }}">Home</a>
                 <a href="{{ url('/login') }}">Login</a>
                </strong>
            </div>
        </div>
    </body>
</html>
