<?php
namespace App\Http\Controllers\Admin;
use App\Http\Model\Category;
use App\Http\Model\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class ArticleController extends CommonController
{
		//get.admin/article 全部文章列表
	public function index(){
		//框架中提供分頁paginate函數
		$data=\DB::table('article')->select('article.*','category.cate_name','category.cate_name','category.cate_pid')->orderBy('art_time','desc')->join('category','category.cate_id','=','article.cate_id')->paginate(10);
		
		return view('admin/article/index',compact('data'));
	}

	//get.admin/article/create 添加文章
	public function create(){

		$data=(new Category)->tree();
		return view('admin/article/add',compact('data'));
	}

		//post.admin/article 添加分類提交
	public function store(){
		$input=Input::except('_token');

		$input['art_view']=0;
		// print_r($input);die;
		$input['art_time']=time();
			// 定義驗證規則
    	$rules=[    		
    		'art_title'=>'required',
    		'art_content'=>'required',
    	];
    	// 定義觸發規則的警告語
    	$message=[
    		'art_title.required'=>'文章名稱不能為空',
    		'art_content.required'=>'文章內容不能為空',
    	];
    

    	//驗證
    	$Validator=Validator::make($input,$rules,$message);
    	 	if($Validator->passes()){
    	 		// 上傳圖片
    	 		if($_FILES["art_thumb"]["error"]>0){
    	 				return back()->with('errors','圖片上傳失敗'); 
		             }else{
		             	$type=strrchr($_FILES['art_thumb']['name'],".");//獲取後墜
		             	$_FILES['art_thumb']['name']=date('YmdHis',time()).$type;
		             	move_uploaded_file($_FILES["art_thumb"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/uploads/".$_FILES["art_thumb"]["name"]);
		             	$input['art_thumb']="/uploads/".$_FILES["art_thumb"]["name"];
		             }

    			//將取得數值直接寫入數據庫
    				$re=Article::create($input);
				if($re){
					
					// return '文章添加成功';
					return redirect('admin/article');
				}else{
					return back()->with('errors','數據填充失敗'); 
						}
	    	}else{
	    			// 顯示錯誤訊息
	    		// print_r($Validator->errors()->all());
	    		
	    		//winhError可以把錯誤訊息傳遞回去並且賦值
	    		return back()->withErrors($Validator); 
	    	}
	

	}

	
			//get.admin/article/{article}/edit 編輯文章
	public function edit($art_id){
		$data=(new Category)->tree();
		$field=Article::find($art_id);
		return view('admin/article/edit',compact('data','field'));

	}
		//put.admin/article/{article} 更新文章
		//put提交方式可以用<input type="hidden" name="_method" value="put">
	public function update($art_id){
		$input=Input::except('_method','_token');
		$old_thumb=Article::select('art_thumb')->find($art_id);
		
			// 上傳圖片
	if($_FILES["art_thumb"]["name"]){
		if($_FILES["art_thumb"]["error"]){
			
				return back()->with('errors','圖片上傳失敗'); 
         }else{             	
         	$type=strrchr($_FILES['art_thumb']['name'],".");//獲取後墜
         	$_FILES['art_thumb']['name']=date('YmdHis',time()).$type;
         	move_uploaded_file($_FILES["art_thumb"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/uploads/".$_FILES["art_thumb"]["name"]);
         	if($old_thumb['art_thumb']){
         		unlink($_SERVER['DOCUMENT_ROOT'].$old_thumb['art_thumb']);
         	}         	

         	$input['art_thumb']="/uploads/".$_FILES["art_thumb"]["name"];
        } }
		$re=Article::where('art_id',$art_id)->update($input);
		if($re){

			return redirect('admin/article');
		}else{
			return back()->with('errors','文章更新失敗'); 
		}
	}
	//delete.admin/article/{article} 刪除單篇文章
	public function destroy($art_id){
		$old_thumb=Article::select('art_thumb')->find($art_id);
		unlink($_SERVER['DOCUMENT_ROOT'].$old_thumb['art_thumb']);
		$re=Article::where('art_id',$art_id)->delete();
		if($re){
			$data=[
				'status'=>0,
				'msg'=>'文章刪除成功'
			];
		}else{
				$data=[
				'status'=>1,
				'msg'=>'文章刪除失敗'
			];
		}
		return $data;
	}
	
}
