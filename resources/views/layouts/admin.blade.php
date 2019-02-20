<!DOCTYPE html>
<html lang="en">
<head>
	 <title>{{ Config::get('web.web_title') }}系統後台</title>
	<link rel="icon" href="{{asset('resources/views/admin/style/img/vimeo.png')}}" type="image/x-icon" />
	<link rel="shortcut icon" href="{{asset('resources/views/admin/style/img/vimeo.png')}}" type="image/x-icon" />
	<meta charset="utf-8">
	<!-- <link rel="stylesheet" href="{{asset('resources/views/admin/style/css/bootstrap.min.css')}}"> -->
	<link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
	
	
	<link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">
	<script type="text/javascript" src="{{asset('resources/views/admin/style/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/admin/style/js/ch-ui.admin.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/org/layer/layer.js')}}"></script>

</head>
<body>
	<!-- 子視圖繼承 -->
@yield('content')

</body>
</html>