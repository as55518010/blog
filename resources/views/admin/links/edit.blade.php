@extends('layouts.admin')
    @section('content')
        <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo;友情鏈接管理
    </div>
    <!--麵包屑導航 結束-->

    <!--結果集標題與導航組件 開始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>編輯友情鏈接</h3>
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
      <div class="short_wrap">
                    <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>添加鏈接</a>
                    <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>全部鏈接</a>
                </div>
            </div>
        </div>
    </div>
    <!--結果集標題與導航組件 結束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/links/'.$field->link_id.'')}}" method="post">
            {{method_field('PUT')}}
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
        
                    <tr>
                        <th><i class="require">*</i>鏈接名稱：</th>
                        <td>
                            <input type="text" name="link_name" value="{{$field->link_name}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>鏈接名稱必須填寫</span>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>Url：</th>
                        <td>
                            <input type="text" class="lg" name="link_url" value="{{$field->link_url}}">
                        </td>
                    </tr>

                    <tr>
                        <th>鏈接標題：</th>
                        <td>
                            <input type="text" class="lg" name="link_title" value="{{$field->link_title}}">
                        </td>
                    </tr>
                  
                     
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text" name="link_order" value="{{$field->link_order}}">
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
    