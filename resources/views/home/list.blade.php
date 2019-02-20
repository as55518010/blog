@extends('layouts.home')
@section('info')
    <title>{{ $field->cate_name }} - {{ Config::get('web.web_title') }}</title>
    <meta name="keywords" content="{{ $field->cate_keywords }}" />
    <meta name="description" content="{{ $field->cate_description }}" />
@endsection
@section('content')
    <article>
        <h1 class="t_nav"><span>{{ $field->cate_title }}</span><a href="{{ url('/') }}" class="n1">網站首頁</a><a href="{{ url('cate/'.$field->cate_id) }}" class="n2">{{ $field->cate_name }}</a></h1>
        <div class="newblog left">
            @foreach($data as $v)
            <h2>{{ $v->art_title }}</h2>
            <p class="dateview"><span>發布時間：{{ date('Y-m-d',$v->art_time) }}</span><span>作者：{{ $v->art_author }}</span><span>分類：[<a href="{{url('cate/'.$field->cate_id)}}">{{ $field->cate_name }}</a>]</span></p>
            <figure><img src="{{ url($v->art_thumb) }}"></figure>
            <ul class="nlist">
                <p>{{ $v->art_description }}</p>
                <a title="{{ $v->art_title }}" href="{{url('a/'.$v->art_id)}}" target="_blank" class="readmore">閱讀全文>></a>
            </ul>
            <div class="line"></div>
               @endforeach 
            <div class="page">
                {{ $data->links() }}
            </div>
        </div>
        <aside class="right">

            @if($submenu->all())
            <div class="rnav">
                <ul>
                    @foreach($submenu as $k=>$v1)
                    <li class="rnav{{ $k+1 }}"><a href="{{ url('cate/'.$v1->cate_id) }}" target="_blank">{{ $v1->cate_name }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif

             <!-- Baidu Button BEGIN -->
       
            <!-- Baidu Button END -->

            <div class="news" style="float: left;">
                <!-- 繼承模板 -->
                @parent
             </div>
           
        </aside>
    </article>
@endsection


