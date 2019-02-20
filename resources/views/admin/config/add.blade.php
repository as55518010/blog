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
            <h3>添加配置項</h3>
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
        <form action="{{url('admin/config')}}" method="post" enctype="multipart/form-data">
               {{csrf_field()}}
            <table class="add_tab">
                <tbody>
        
                    <tr>
                        <th><i class="require">*</i>配置項標題：</th>
                        <td>
                            <input type="text" name="conf_title">
                            <span><i class="fa fa-exclamation-circle yellow"></i>配置項標題必須填寫</span>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>配置項名稱：</th>
                        <td>
                            <input type="text" name="conf_name">
                            <span><i class="fa fa-exclamation-circle yellow"></i>配置項名稱必須填寫</span>
                        </td>
                    </tr>




                   <tr>
                        <th>類型：</th>
                        <td>
                        
                            <input type="radio" name="field_type" value="input" checked onclick="showTr()">input　
                            <input type="radio" name="field_type" value="textarea" onclick="showTr()">textarea　
                            <input type="radio" name="field_type" value="radio" onclick="showTr()">radio 
                            <input type="radio" name="field_type" value="field_thunb" onclick="showTr()">field_thunb
                        </td>
                    </tr>
                    <tr class="field_value">
                        <th>類型值：</th>
                        <td>
                            <input type="text" class="lg" name="field_value" value="1231321" >
                            <p><i class="fa fa-exclamation-circle yellow"></i>類型值只有在radio的情況下才需要配置，格式1|開啟 ，0|關閉</p>
                        </td>
                    </tr>
                    
                    <tr class="field_thunb">
                    
                        <th>縮略圖：</th>
                        <td>
                            <input  type="file" name="field_thumb" id="file0" multiple="multiple" /><br>
                             <img  width="125px" src="" src="" id="img0" >
                        </td>
                   
                    </tr>
                     
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input class="sm" value="0" type="number" name="conf_order" >
                        </td>
                    </tr>
                    <tr>
                        <th>說明：</th>
                        <td>
                            <textarea name="conf_tips" id="" cols="30" rows="10"></textarea>
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
            $('.field_thunb').hide();
            $('.field_value').show();

       }else if(type=='field_thunb'){
            $('.field_value').hide();
            $('.field_thunb').show();
       }else{
            $('.field_value').hide();
            $('.field_value input').val('');                     
            $('.field_thunb').hide();
            $('.field_thunb img').attr('src','');    
            $('.field_thunb input').val('');    
       }
    }    
     $("#file0").change(function(){
        var reader = new FileReader();

        reader.onload = function (event) {
            $("#img0").attr("src", event.target.result) ;
        }

        reader.readAsDataURL(this.files[0]);

    }) ;
        
    </script>

    @endsection
    