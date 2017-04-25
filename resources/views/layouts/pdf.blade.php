<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style type="text/css">
        a {
            color: #D2AC67;
            text-decoration: underline;
        }
        body {
            position: relative;
            width: 18cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-size: 12px;
            font-family: Arial;
        }
        header {
            padding: 10px 0;
            margin-bottom: 100px;
        }
        #logo {
            text-align: center;
            margin-bottom: 10px;
        }
        #logo img {
            width: 200px;
        }
        h1 {
            border-top: 1px solid  #D2AC67;
            border-bottom: 1px solid  #D2AC67;
            color: #D2AC67;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
        }
        footer {
            color: #D2AC67;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #D2AC67;
            padding: 8px 0;
            text-align: center;
        }
    </style>
    @yield('styles')
</head>
<body>

@yield('content')

</body>
</html>
