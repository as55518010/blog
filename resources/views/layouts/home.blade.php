<!DOCTYPE html>
<html lang="en">
<head>
@yield('info')
  <link rel="icon" href="{{asset('resources/views/admin/style/img/vimeo.png')}}" type="image/x-icon" />
  <link rel="shortcut icon" href="{{asset('resources/views/admin/style/img/vimeo.png')}}" type="image/x-icon" />
<meta charset="utf-8">
<link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
<link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
<link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
<link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- [if lt IE 9] -->
<script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <![endif] -->
</head>
<body>
<header>
  <div id="logo"><a href="{{ url('/') }}"><img height="100px" src="{{ url('resources/views/home/images/138.png') }}" alt=""></a></div>
  <nav class="topnav" id="topnav">
   <ul class="nav justify-content-end"> 
      <li class="nav-item">
         <a href="{{ url('') }}"><span>首頁</span></span><span class="en">Protal</span></a>              
      </li>
     @foreach($cate as $k=>$v)
      <li class="nav-item">
         <a href="{{ url('cate/'.$v->cate_id) }}"><span>{{ $v->cate_name }}</span></span><span class="en">{{ $v->nav_alias }}</span></a>              
      </li>
    @endforeach
  	@foreach($navs as $k=>$v)
      <li class="nav-item">
  	     <a href="{{ $v->nav_url?$v->nav_url:url('') }}"><span>{{ $v->nav_name }}</span><span class="en">{{ $v->nav_alias }}</span></a>         
      </li>
    @endforeach

   </ul> 
  </nav>
</header>

@section('content')
 <h3>
    <p>最新<span>文章</span></p>
</h3>
<ul class="rank">
    @foreach($new as $v3)
    <li><a href="{{ url('a/'.$v3->art_id) }}" title="{{ $v3->art_title }}" target="_blank">{{ $v3->art_title }}</a></li>  
    @endforeach                 
</ul>
<h3 class="ph">
    <p>点击<span>排行</span></p>
</h3>
<ul class="paih">
    @foreach($hot as $v4)
    <li><a href="{{ url('a/'.$v4->art_id) }}" title="{{ $v4->art_title }}" target="_blank">{{ $v4->art_title }}</a></li>
    @endforeach                    
</ul>
@show
<footer>
  <p>{!! Config::get('web.copyright') !!} {!! Config::get('web.web_count') !!}</p>
</footer>
<script src="{{asset('resources/views/home/js/silder.js')}}"></script>
</body>
</html>
