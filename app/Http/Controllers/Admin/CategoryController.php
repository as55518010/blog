<?php
namespace App\Http\Controllers\Admin;
use App\Http\Model\Category;
use App\Http\Model\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class CategoryController extends CommonController
{
	//資源控制器給的get方法 全部分類列表
	public function index(){
		 //以靜態方式調用
		// $categorys=Category::tree();

		$categorys=(new Category)->tree();
		//將數據分配到模板中
		return view('admin.category.index')->with('date',$categorys);
	}

	//ajax異步方法排序
	public function changeorder(){
		$input=Input::all();
		$cate=Category::find($input['cate_id']);
		$cate->cate_order=$input['cate_order'];
		$re=$cate->update();
		if($re){
			$data=[
				'status'=>0,
				'msg'=>'分類排序更新成功'
			];
		}else{
				$data=[
				'status'=>1,
				'msg'=>'分類排序更新失敗'
			];
		}
		return $data;
	}

	//get.admin/category/create 添加分類
	public function create(){
		$data=Category::where('cate_pid',0)->get();
		return view('admin/category/add',compact('data'));
	}

		//post.admin/category 添加分類提交
	public function store(){
		//排除某個不需要的input則可以用except()
		$input=Input::except('_token');
			// 定義驗證規則
    	$rules=[    		
    		'cate_name'=>'required',
    	];
    	// 定義觸發規則的警告語
    	$message=[
    		'cate_name.required'=>'分類名稱不能為空',
    	];

    	//驗證
    	$Validator=Validator::make($input,$rules,$message);
    	 	if($Validator->passes()){
    			//將取得數值直接寫入數據庫
    			$re=Category::create($input);
    			if($re){
    				return redirect('admin/category');
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

		//get.admin/category/{category}/edit 編輯分類
	public function edit($cate_id){
		$field=Category::find($cate_id);
		$data=Category::where('cate_pid',0)->get();
		return view('admin/category/edit',compact('field','data'));
	}
		//put.admin/category/{category} 更新分類 
		//put提交方式可以用<input type="hidden" name="_method" value="put">
	public function update($cate_id){
		$input=Input::except('_token','_method');
		$re=Category::where('cate_id',$cate_id)->update($input);
		if($re){
			return redirect('admin/category');
		}else{
			return back()->with('errors','分類訊息更新失敗'); 
		}
	}


	//get.admin/category/{category} 顯示單個分類訊息
	public function show(){

	}
	//delete.admin/category/{category} 刪除單個分類
	public function destroy($cate_id){

		$ra=Article::where('cate_id',$cate_id)->select('art_id')->get();
		
		$re=Category::where('cate_id',$cate_id)->delete();

		Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
		if($re){
			$article=new ArticleController;
			foreach ($ra as $k => $v) {
				$article->destroy($v->art_id);
			}
			$data=[
				'status'=>0,
				'msg'=>'分類刪除成功'
			];
		}else{
				$data=[
				'status'=>1,
				'msg'=>'分類刪除失敗'
			];
		}
		return $data;
	}

}
