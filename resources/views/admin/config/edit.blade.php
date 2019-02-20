@extends('layouts.admin')
    @section('content')
        <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo;配置項管理
    </div>
    <!--麵包屑導航 結束-->

    <!--結果集標題與導航組件 開始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>修改配置項</h3>
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
                     <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置項</a>
                    <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>配置項列表</a>
            </div>
        </div>
    </div>
    <!--結果集標題與導航組件 結束-->
    
    <div class="result_wrap">
            <form action="{{url('admin/config/'.$field->conf_id.'')}}" method="post">
            {{method_field('PUT')}}
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
        
                    <tr>
                        <th><i class="require">*</i>配置項標題：</th>
                        <td>
                            <input type="text" name="conf_title" value="{{$field->conf_title}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>配置項標題必須填寫</span>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>配置項名稱：</th>
                        <td>
                            <input type="text" name="conf_name" value="{{$field->conf_name}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>配置項名稱必須填寫</span>
                        </td>
                    </tr>




                   <tr>
                        <th>類型：</th>
                        <td>
                            
                            <input type="radio" name="field_type" value="input" @if($field->field_type=='input') checked @endif onclick="showTr()">input　
                            <input type="radio" name="field_type" value="textarea" @if($field->field_type=='textarea') checked @endif onclick="showTr()">textarea　
                            <input type="radio" name="field_type" value="radio" @if($field->field_type=='radio') checked @endif onclick="showTr()">radio
                        </td>
                    </tr>
                    <tr class="field_value">
                        <th>類型值：</th>
                        <td>
                            <input type="text" class="lg" name="field_value" value="{{$field->field_value}}">
                            <p><i class="fa fa-exclamation-circle yellow"></i>類型值只有在radio的情況下才需要配置，格式1|開啟 ，0|關閉</p>
                        </td>
                    </tr>
                  
                     
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input class="sm"  type="number" name="conf_order" value="{{$field->conf_order}}">
                        </td>
                    </tr>
                    <tr>
                        <th>說明：</th>
                        <td>
                            <textarea name="conf_tips" id="" cols="30" rows="10">{{$field->conf_tips}}</textarea>
                        </td>
                    </tr>
                    

                    <tr>
                        <th></th>
                        <td>
                            <input  type="submit" value="提交">
                            <input  type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <script>
        //初始化
        showTr();
    function showTr(){
       var type=$('input[name=field_type]:checked').val();
       if(type=='radio'){
        $('.field_value').show();
       }else{
        $('.field_value').hide();
       }
    }    
        
    </script>

    @endsection
    