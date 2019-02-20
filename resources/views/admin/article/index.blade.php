@extends('layouts.admin')
    @section('content')
    <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
         <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo;文章管理
    </div>
    <!--麵包屑導航 結束-->

    <!--結果頁快捷搜索框 開始-->
  
    <!--結果頁快捷搜索框 結束-->

    <!--搜索結果頁面 列表 開始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷導航 開始-->
        <div class="result_title">
            <h3>文章列表</h3>
        </div>
           <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                    <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
                </div>
            </div>
            <!--快捷導航 結束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>分類</th>
                        <th>標題</th>
                        <th>點擊</th>
                        <th>編輯</th>
                        <th>發布時間</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr> 
                        <td class="tc">{{ $v->art_id }}</td>
                        <td class="tc">{{ $v->cate_name }}</td>
                        <td>
                            <a  target="_blank" href="{{ url('a/'.$v->art_id) }}">{{ $v->art_title }}</a>
                        </td>
                        <td>{{ $v->art_view}}</td>
                        <td>{{ $v->art_editor }}</td>
                        <td>{{ date('Y-m-d',$v->art_time)}}</td>
                        <td>
                            <a href="{{ url('admin/article/'.$v->art_id.'/edit') }}">修改</a>
                            <a href="javascript:;" onclick="delArt({{$v->art_id}})">刪除</a>
                     </td>
                    </tr>
                    @endforeach
                </table>  
     <div class="page_list">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </form>
    <!--搜索結果頁面 列表 結束-->

  <style>
      .result_content ul li span{
        font-size: 15px;
        padding: 6px 12px;
      }
  </style>
  <script type="text/javascript">
            //刪除分類，詢問是否真的要刪除
      function delArt(art_id){
        layer.confirm('您確定要刪除這篇文章嗎？', {
          btn: ['確定','取消'] //按鈕
        }, function(){            
            $.post("{{url('admin/article/')}}/"+art_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
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
  