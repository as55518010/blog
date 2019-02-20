@extends('layouts.admin')
    @section('content')
        <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo;自訂義導航管理
    </div>
    <!--麵包屑導航 結束-->

    <!--結果集標題與導航組件 開始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>添加自訂義導航</h3>
          <!-- 秀出錯誤訊息   -->
             @if(is_object($errors))
                 @if(count($errors)>0)
                        <div class="mark">               
                                @foreach($errors->all() as $error)
                                    <p>{{$error}}</p>
                                @endforeach             
                         </div>
                    @endif
                     @else
                     <div class="mark">
                     <p>{{$errors}}</p>
                     </div>
                 @endif                 
        </div>
        <div class="result_content">
            <div class="short_wrap">
                     <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>添加導航</a>
                    <a href="{{url('admin/navs')}}"><i class="fa fa-recycle"></i>導航列表</a>
            </div>
        </div>
    </div>
    <!--結果集標題與導航組件 結束-->
  
    <div class="result_wrap">
        <form action="{{url('admin/navs')}}" method="post">
               {{csrf_field()}}
            <table class="add_tab">
                <tbody>
        
                    <tr>
                        <th><i class="require">*</i>導航名稱：</th>
                        <td>
                            <input type="text" name="nav_name">
                            <input type="text" class="sm" name="nav_alias">
                            <span><i class="fa fa-exclamation-circle yellow"></i>導航名稱必須填寫</span>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>Url：</th>
                        <td>
                            <input type="text" class="lg" name="nav_url" value="http://">
                        </td>
                    </tr>
                  
                     
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text" name="nav_order" value="0">
                        </td>
                    </tr>
                    
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    @endsection
    