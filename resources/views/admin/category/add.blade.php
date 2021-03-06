@extends('layouts.admin')
    @section('content')
        <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo;分類管理
    </div>
    <!--麵包屑導航 結束-->

    <!--結果集標題與導航組件 開始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>分類列表</h3>
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
                     <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加分類</a>
                    <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分類</a>
            </div>
        </div>
    </div>
    <!--結果集標題與導航組件 結束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/category')}}" method="post">
               {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>父級分類：</th>
                        <td>
                            <select name="cate_pid">
                                <option value="">==頂級分類==</option>
                                @foreach($data as $d)
                                <option value="{{ $d->cate_id }}">{{ $d->cate_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>分類名稱：</th>
                        <td>
                            <input type="text" name="cate_name">
                            <span><i class="fa fa-exclamation-circle yellow"></i>分類名稱必須填寫</span>
                        </td>
                    </tr>

                    <tr>
                        <th>分類標題：</th>
                        <td>
                            <input type="text" class="lg" name="cate_title">
                        </td>
                    </tr>
                      <tr>
                        <th>關鍵詞：</th>
                        <td>
                            <textarea name="cate_keywords"></textarea>
                        </td>
                    </tr>
                      <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="cate_description"></textarea>
                        </td>
                    </tr>
               
                    <tr>
                        <th><i class="require">*</i>排序：</th>
                        <td>
                            <input type="number" class="cate_order" name="">
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
    