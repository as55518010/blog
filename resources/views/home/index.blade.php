@extends('layouts.home')
@section('info')
<title>{{ Config::get('web.web_title') }} - {{ Config::get('web.seo_title') }}</title>
<link rel="shortcut icon" href="{{ url('uploads/image.png') }}" type="image/x-icon" />
<link rel="icon" href="{{ url('uploads/image.png') }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ url('uploads/image.png') }}" />
<link rel="apple-touch-icon" sizes="72x72" href="{{ url('uploads/image.png') }}" />
<link rel="apple-touch-icon" sizes="144x144" href="{{ url('uploads/image.png') }}" />
<meta name="keywords" content="{{ Config::get('web.keywords') }}" />
<meta name="description" content="{{ Config::get('web.description') }}" />
@endsection
@section('content')
    <div class="banner">
        <section class="box">
            <ul class="texts">
                <p>打了死結的青春，捆死一顆蒼白絕望的靈魂。</p>
                <p>為自己掘一個墳墓來葬心，紅塵一夢，不再追尋。</p>
                <p>加了鎖的青春，不會再因誰而推開心門。</p>
            </ul>
            <div class="avatar"><a href="/"><span>德福</span></a> </div>
        </section>
    </div>
    <div class="template">
        <div class="box">
            <h3>
                <p><span>站長</span>推薦 Recommend</p>
            </h3>
            <ul>
                @foreach($pics as $v1)
                <li><a href="{{ url('a/'.$v1->art_id) }}"  target="_blank"><img  src="{{ url($v1->art_thumb) }}"></a><span>{{ $v1->art_title }}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
    <article class="blogs">
        <h2 class="title_tj">
            <p>文章<span>推薦</span></p>
        </h2>
        <div class="bloglist left">
            @foreach($data as $v2)
           <a  target="_blank"  href="{{ url('a/'.$v2->art_id) }}"> <h3>{{ $v2->art_title }}</h3></a>
            <figure>  <a  target="_blank"  href="{{ url('a/'.$v2->art_id) }}"><img  src="{{ url($v2->art_thumb) }}"></a></figure>
            <ul>
                <p>{{ $v2->art_description }}</p>
                <a title="{{ $v2->art_title }}" href="{{ url('a/'.$v2->art_id) }}" target="_blank" class="readmore">閱讀全文>></a>
            </ul>
            <p class="dateview"><span>{{ date('Y-m-d',$v2->art_time) }}</span><span>{{ $v2->art_deitor }}</span>
            @endforeach
            <div class="page">
                {{$data->links()}}
            </div>           
        </div>
        <aside class="right"> 
  
            <!-- Baidu Button END -->           
            <div class="news" style="float: left;">
               @parent
                <h3 class="links">
                    <p>友情<span>鏈接</span></p>
                </h3>
                <ul class="website">
                    @foreach($links as $v5)
                    <li><a href="{{ $v5->link_url }}" target="_blank">{{ $v5->link_name }}</a></li>
                    @endforeach 
                </ul>
            </div>
            
        </aside>
    </article>
@endsection