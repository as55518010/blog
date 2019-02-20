<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Navs;
use App\Http\Model\Category;
use App\Http\Model\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
  //初始化
  public function __construct(){
       $navs=Navs::all();
  	   $cate=Category::orderBy('cate_order')->where('cate_pid',0)->get();
  	          //點擊量最高的5篇文章
    $hot=Article::orderBy('art_view','desc')->take(5)->get();
    //最新發布文章8篇
    $new=Article::orderBy('art_time','desc')->take(8)->get();
       //模板參數共享
       View::share('cate',$cate);
       View::share('navs',$navs);
       View::share('hot',$hot);
       View::share('new',$new);

 		 }
	
}
