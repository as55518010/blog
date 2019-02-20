@extends('layouts.admin')
    @section('content')
          <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo;鏈接管理
    </div>
    <!--麵包屑導航 結束-->

    <!--結果頁快捷搜索框 開始-->
<!--     <div class="search_wrap">
        <form action="" method="post">
            <table class="search_tab">
            <div class="result_title">
                <h3>分類管理</h3>
            </div>
                <tr>
                    <th width="120">選擇分類:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="http://www.baidu.com">百度</option>
                            <option value="http://www.sina.com">新浪</option>
                        </select>
                    </td>
                    <th width="70">關鍵字:</th>
                    <td><input type="text" name="keywords" placeholder="關鍵字"></td>
                    <td><input type="submit" name="sub" value="查詢"></td>
                </tr>
            </table>
        </form>
    </div> -->
    <!--結果頁快捷搜索框 結束-->

    <!--搜索結果頁面 列表 開始-->
    <div class="result_wrap">
    <form action="#" method="post">
        <table class="search_tab">
        <div class="result_title">
            <h3>鏈接列表</h3>
        </div>
        <div class="result_wrap">
            <!--快捷導航 開始-->
            <div class="result_content">
         <div class="short_wrap">
                    <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>添加鏈接</a>
                    <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>全部鏈接</a>
                </div>
                </div>
            </div>
            <!--快捷導航 結束-->
    </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                       <th class="tc" width="5%">排序</th>
                    <th class="tc" width="5%">ID</th>
                    <th>鏈接名稱</th>
                    <th>鏈接標題</th>
                    <th>鏈接地址</th>
                    <th>操作</th>
                    </tr>
                    @foreach($date as $v)
                    <tr>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{ $v->link_id }})" value="{{$v->link_order}}">
                        </td>
                        <td class="tc">{{$v->link_id}}</td>
                        <td>
                            <a href="#">{{$v->link_name}}</a>
                        </td>
                        <td>{{$v->link_title}}</td>
                        <td>{{$v->link_url}}</td>
                   
                        <td>
                            <a href="{{url('admin/links/'.$v->link_id .'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delLinks({{$v->link_id}})">刪除</a>
                        </td>
                    </tr>
                    @endforeach
        
                </table>
            </div>
        </div>
    </form>

    <!--搜索結果頁面 列表 結束-->
    
    <script >
        // 利用jq異步發送請求
      function changeOrder(obj,link_id){
        var link_order=$(obj).val();
        $.post("{{ url('admin/links/changeorder') }}",{'_token':'{{csrf_token() }}','link_id':link_id,'link_order':link_order},function(date){
          if(date['status']==0){
             location.href=location.href;
             layer.msg(date['msg'], {icon: 6});//引入第三方http://layer.layui.com/插件，進行彈出提示
          }else{
             layer.msg(date['msg'], {icon: 5});//引入第三方http://layer.layui.com/插件，進行彈出提示
          }
        })  
      }

      //刪除分類，詢問是否真的要刪除
      function delLinks(link_id){
        layer.confirm('您確定要刪除這個友情鏈接嗎？', {
          btn: ['確定','取消'] //按鈕
        }, function(){            
            $.post("{{url('admin/links/')}}/"+link_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
                 if(data.status==0){
                    //刷新當前葉面
                    location.href=location.href;

                    layer.msg(data.msg, {icon: 6});
                }else{
                    layer.msg(data.msg, {icon: 5});
                }

            })
         
          
        }, function(){
       
        });
      }

 
    </script>
    @endsection
  