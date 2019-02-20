@extends('layouts.home')
@section('info')
    <title>{{$field->art_title}} - {{Config::get('web.web_title')}}</title>
    <meta name="keywords" content="{{$field->art_tag}}" />
    <meta name="description" content="{{$field->art_description}}" />
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span>您當前的位置：<a href="{{url('/')}}">首頁</a>&nbsp;&gt;&nbsp;<a href="{{url('cate/'.$field->cate_id)}}">{{$field->cate_name}}</a></span><a href="{{url('/')}}" class="n1">網站首頁</a><a href="{{url('cate/'.$field->cate_id)}}" class="n2">{{$field->cate_name}}</a></h1>
        <div class="index_about">
            <h2 class="c_titile">{{ $field->art_title }}</h2>
            <p class="box_c"><span class="d_time">發布時間：{{ date('Y-M-d',$field->art_time) }}</span><span>編輯：{{ $field->art_editor }}</span><span>查看次數：{{ $field->art_view }}</span></p>
            <ul class="infos">
               {!! $field->art_content !!}
            </ul>
            <div class="keybq">
                <p><span>關鍵字詞</span>：{{ $field->art_tag }}</p>

            </div>
            <div class="ad"> </div>
            <div class="nextinfo">
                <p>上一篇：
                    @if($article['pre'])
                    <a href="{{ url('a/'.$article['pre']->art_id) }}">{{ $article['pre']->art_title }}</a></p>
                    @else
                        <span>沒有上一篇了</span>
                    @endif
                <p>下一篇：
                    @if($article['next'])
                        <a href="{{ url('a/'.$article['next']->art_id) }}">{{ $article['next']->art_title }}</a></p>
                    @else
                        <span>沒有下一篇了</span>
                   @endif
            </div>
            <div class="otherlink">
                <h2>相關文章</h2>
                <ul>
                    @foreach($data as $v)
                    <li><a href="{{ url('a/'.$v->art_id) }}" title="{{ $v->art_title }}">{{ $v->art_title }}</a></li>
                    @endforeach          
                </ul>
            </div>
        </div>
        <aside class="right">
          
            <!-- Baidu Button END -->
            <div class="blank"></div>
            <div class="news">
                @parent
            </div>
        </aside>
    </article>
@endsection