<?php
namespace App\Http\Controllers\Home;
use App\Http\Model\Navs;
use App\Http\Model\Article;
use App\Http\Model\Links;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;




class IndexController extends CommonController
{
  public function index(){
    //點擊量最高的6篇文章(站長推薦區)
    $pics=Article::orderBy('art_view','desc')->take(6)->get();
    //圖文列表5篇(帶分頁)
    $data=Article::orderBy('art_time','desc')->paginate(5);  
    //友情鏈接
    $links=Links::orderBy('link_order','asc')->get();
   return view('home/index',compact('pics','data','links'));

  }
   public function cate($cate_id){
    //圖文列表4篇(帶分頁)
    $data=Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(4);

    //查看分類次數的自增
     Category::where('cate_id',$cate_id)->increment('cate_view');

    //當前分類的子分類
    $submenu=Category::where('cate_pid',$cate_id)->get();

    $field=Category::find($cate_id);


   return view('home/list',compact('field','data','submenu'));

  }

   public function article($art_id){
    $field=Article::join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();

    //查看文章次數的自增
    Article::where('art_id',$art_id)->increment('art_view');

    //取得上一篇內容
    $article['pre']=Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
    $article['next']=Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();

    //相關文章
    $data=Article::where('cate_id',$field->cate_id)->take(6)->orderBy('art_id','desc')->get();
   return view('home/new',compact('field','article','data'));

  }
}
