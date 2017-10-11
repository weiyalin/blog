<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ url('dist/img/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ url('dist/element-theme/index.css') }}" />
    <link rel="stylesheet" href="{{ url('dist/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('dist/css/app.css') }}">
    <title>MyBlog</title>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id='app'></div >
</body>
<script type="text/javascript" src="{{ url('dist/js/manifest.js') }}"></script>
<script type="text/javascript" src="{{ url('dist/js/vendor.js') }}"></script>
<script type="text/javascript" src="{{ url('dist/js/app.js') }}"></script>
<!-- include summernote -->
<link rel="stylesheet" href="{{ url('dist/bootstrap-3.3.7/dist/css/bootstrap.css') }}">
<script src="{{ url('dist/bootstrap-3.3.7/dist/js/bootstrap.min.js') }}" ></script>
<link type="text/css" rel="stylesheet" href="{{ url('dist/summernote-master/dist/summernote.css') }}" />
<script type="text/javascript" src="{{ url('dist/summernote-master/dist/summernote.js') }}"></script>
</html>