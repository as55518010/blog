@extends('layouts.admin')
    @section('content')
        <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo;文章管理
    </div>
    <!--麵包屑導航 結束-->

    <!--結果集標題與導航組件 開始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>添加文章</h3>
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
                     <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                    <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
            </div>
        </div>
    </div>
    <!--結果集標題與導航組件 結束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/article')}}" role="form"  method="post"  enctype="multipart/form-data">
               {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120">分類：</th>
                        <td>
                            <select name="cate_id">                            
                                @foreach($data as $d)
                                <option value="{{ $d->cate_id }}">{{ $d->_cate_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                   

                    <tr>
                        <th><i class="require">*</i>文章標題：</th>
                        <td>
                            <input type="text" class="lg" name="art_title">
                        </td>
                    </tr>

                    <tr>
                        <th>編輯：</th>
                        <td>
                            <input type="text" class="cate_order" name="art_editor">
                        </td>
                    </tr>

                    <tr>
                        <th>縮略圖：</th>
                        <td>
                            <input  type="file" name="art_thumb" id="file0" multiple="multiple" /><br>
                             <img  width="125px" src="" src="" id="img0" >
                        </td>
                    </tr>

                      <tr>
                        <th>關鍵詞：</th>
                        <td>
                           <input type="text" class="lg" name="art_tag">
                        </td>
                    </tr>
                      <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="art_description"></textarea>
                        </td>
                    </tr>

                 
                       <tr>
                        <th>文章內容:</th>
                        <td>
                            <script type="text/javascript" charset="utf-8" src="{{url('resources/org/ueditor/ueditor.config.js')}}"></script>
                            <script type="text/javascript" charset="utf-8" src="{{url('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
                            <script type="text/javascript" charset="utf-8" src="{{url('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                            <script id="editor" name="art_content" type="text/plain" style="width:860px;height:500px;"></script>
                            <script type="text/javascript">
                            //實例化編輯器
                            //建議使用工廠方法getEditor創建和引用編輯器實例，如果在某個閉包下引用該編輯器，直接調用UE.getEditor('editor')就能拿到相關的實例
                            var ue = UE.getEditor('editor');
                            </script>
                            <style>
                                .edui-default{line-height: 28px;}
                                div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                {overflow: hidden; height:20px;}
                                div.edui-box{overflow: hidden; height:22px;}
                            </style>


                            <script>
                                 
                                $("#file0").change(function(){
                                    var reader = new FileReader();

                                    reader.onload = function (event) {
                                        $("#img0").attr("src", event.target.result) ;
                                    }

                                    reader.readAsDataURL(this.files[0]);

                                }) ;
                            </script>
                          
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
    