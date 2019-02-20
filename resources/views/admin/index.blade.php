@extends('layouts.admin')
@section('content')
	<!--頭部 開始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">後台管理模板</div>
			<ul>
				<li><a href="{{ url('/') }}" target="_blank" class="active">首頁</a></li>
				<li><a href="{{ url('admin/info') }}" target="main">管理頁</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>管理員：admin</li>
				<li><a href="{{ url('admin/pass') }}" target="main">修改密碼</a></li>
				<li><a href="{{ url('admin/quit') }}">退出</a></li>
			</ul>
		</div>
	</div>
	<!--頭部 結束-->

	<!--左側導航 開始-->
	<div class="menu_box">
		<ul>
            <li>
            	<h3><i class="fa fa-fw fa-clipboard"></i>內容管理</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/category/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加分類</a></li>
                    <li><a href="{{url('admin/category')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>分類列表</a></li>
        			 <li><a href="{{url('admin/article/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加文章</a></li>
                    <li><a href="{{url('admin/article')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>文章列表</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-cog"></i>系統設置</h3>
                <ul class="sub_menu" style="display: block;">                                     
                    <li><a href="{{url('admin/links')}}" target="main"><i class="fa fa-fw fa-database"></i>友情鏈接列表</a></li>
                    <li><a href="{{url('admin/navs')}}" target="main"><i class="fa fa-fw fa-navicon"></i>自訂義導航</a></li>
                    <li><a href="{{url('admin/config')}}" target="main"><i class="fa fa-fw fa-cogs"></i>網站配置</a></li>
                </ul>
            </li>
        </ul>
	</div>
	<!--左側導航 結束-->

	<!--主體部分 開始-->
	<div class="main_box">
		<iframe src="{{url('admin/info')  }}" frameborder="0" width="100%" height="100%" name="main"></iframe> 
	</div>
	<!--主體部分 結束-->

	<!--底部 開始-->
	<div class="bottom_box">
		CopyRight © 2018. Powered By <a href="{{ url('') }}">{{ url('') }}</a>.
	</div>
	<!--底部 結束-->

	@endsection

