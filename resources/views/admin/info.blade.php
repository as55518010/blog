@extends('layouts.admin')
@section('content')
    <!--麵包屑導航 開始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 歡迎使用登陸網站後台，建站的首選工具。-->
        <i class="fa fa-home"></i> <a href="{{ url('admin/info') }}">後台首頁</a> &raquo;系統基本訊息
    </div>
    <!--麵包屑導航 結束-->
    

    <!--結果集標題與導航組件 結束-->

    
    <div class="result_wrap">
        <div class="result_title">
            <h3>系統基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系統</label><span>{{ PHP_OS }}</span>
                </li>
                <li>
                    <label>運行環境</label><span>{{ $_SERVER['SERVER_SOFTWARE'] }}</span>
                </li>
                <li>
                    <label>PHP運行方式</label><span>apache2handler</span>
                </li>
                <li>
                    <label>靜靜設計-版本</label><span>v-1.0</span>
                </li>
                <li>
                    <label>上傳附件限制</label><span><?php echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允許上傳附件"; ?></span>
                </li>
                <li>
                    <!-- //記得去config->app.php內改時區 -->
                    <label>台北時間</label><span><?php echo date('Y年m月d日 H時i分s秒'); ?></span>
                </li>
                <li>
                    <label>服務器域名/IP</label><span>{{ $_SERVER['SERVER_NAME'] }}/{{ $_SERVER['SERVER_ADDR'] }}</span>
                </li>
                <li>
                    <label>訪問IP</label><span>{{ $_SERVER['REMOTE_ADDR'] }}</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="result_wrap">
        <div class="result_title">
            <h3>使用幫助</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>laravela中文網站：</label><span><a href="http://laravelacademy.org/"><img width="100px" border="0" src="https://lccdn.phphub.org/uploads/sites/hG5JuDSqZ7Y26Kuh0Qat8EYv6XNT0fGc.png"></a></span>
                </li>
                <li>
                    <label>bootstrap中文網站：</label><span><a href="https://bootstrap.hexschool.com/"><img width="50px" border="0" src="http://www.runoob.com/wp-content/uploads/2013/10/bs.png"></a></span>
                </li>
            </ul>
        </div>
    </div>
    <!--結果集列表組件 結束-->

    

