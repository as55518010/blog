<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
 //因為有用到session所以必須加在中間鍵裡
Route::group(['middleware' => ['web']], function () {
    //首頁
    Route::get('/', 'Home\IndexController@index');
// Route::get('/', function () {
//     return view('admin/index');
// });

    //列表業
    Route::get('/cate/{cate_id}', 'Home\IndexController@cate');
    //文章葉
    Route::get('/a/{art_id}', 'Home\IndexController@article');
    // //處裡帳號密碼
    Route::any('admin/crypt', 'Admin\LoginController@crypt');  
    

    Route::any('admin/login', 'Admin\LoginController@login');
   
    Route::get('admin/code', 'Admin\LoginController@code');
});

 //利用admin.login來進行判斷是否有登入過
Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin' ], function () {    
    
    Route::get('/', 'IndexController@index');

    Route::get('info', 'IndexController@info');
    //退出方法
    Route::get('quit', 'LoginController@quit');
    //修改密碼
    Route::any('pass', 'IndexController@pass');

    //利用jq異步發送請求
    Route::post('cate/changeorder', 'CategoryController@changeorder');

    //欄目資源路由:框架給予許多曾刪改查的方法給我們使用
    Route::resource('category', 'CategoryController');
    //文章資源路由:框架給予許多曾刪改查的方法給我們使用
    Route::resource('article', 'ArticleController');
    
              //友情鏈接利用jq異步發送請求
    Route::post('links/changeorder', 'LinksController@changeOrder');
     //友情鏈接資源路由:框架給予許多曾刪改查的方法給我們使用
    Route::resource('links', 'LinksController');

                      //自訂義導航利用jq異步發送請求
    Route::post('navs/changeorder', 'NavsController@changeOrder');
    //自訂義導航
    Route::resource('navs', 'NavsController');

    //把配置項寫入配置文件
    Route::get('config/putfile', 'ConfigController@putFile');
    //把配置項寫入數據庫
    Route::post('config/changecontent', 'ConfigController@changeContent');
      //配置項利用jq異步發送請求
    Route::post('config/changeorder', 'ConfigController@changeOrder');
     //配置項資源路由:框架給予許多曾刪改查的方法給我們使用
    Route::resource('config', 'ConfigController');

    //圖片上傳
    Route::any('upload', 'CommonController@upload');

});

