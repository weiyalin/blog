<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ url('dist/css/app.css') }}">
    <title>Document</title>
</head>
<body style="background: url({{ url('dist/img/body_bg.jpg') }})">
<div style="background: url({{ url('dist/img/head_bg.jpg') }}) no-repeat center -79px;
        min-height: 300px;">
    <div id='app'></div >
</div>
</body>
<script type="text/javascript" src="{{ url('dist/js/manifest.js') }}"></script>
<script type="text/javascript" src="{{ url('dist/js/vendor.js') }}"></script>
<script type="text/javascript" src="{{ url('dist/js/app.js') }}"></script>
</html>