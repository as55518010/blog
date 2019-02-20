<?php
namespace App\Http\Controllers\Admin;
use App\Http\Model\Navs;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class NavsController extends CommonController
{
	//資源控制器給的get方法 全部分類列表
	public function index(){
 		$date = Navs::orderBy('nav_order','asc')->get();
        return view('admin.navs.index',compact('date'));
	}

	//get.admin/Navs ajax異步方法排序
	public function changeOrder(){
		$input=Input::all();
		$Navs=Navs::find($input['nav_id']);
		$Navs->nav_order=$input['nav_order'];
		$re=$Navs->update();
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

	//get.admin/Navs/create 添加自訂義導航
	public function create(){		
 		$cate = Category::where('cate_pid',0)->get();

		return view('admin/navs/add',compact('cate'));
	}

		//post.admin/Navs 添加自訂義導航提交
	public function store(){
		//排除某個不需要的input則可以用except()
		$input=Input::except('_token');
			// 定義驗證規則
    	$rules=[    		
    		'nav_name'=>'required',
    		'nav_url'=>'required',
    	];
    	// 定義觸發規則的警告語
    	$message=[
    		'nav_name.required'=>'自訂義導航名稱不能為空',
    		'nav_url.required'=>'Url不能為空',
    	];

    	//驗證
    	$Validator=Validator::make($input,$rules,$message);
    	 	if($Validator->passes()){
    			//將取得數值直接寫入數據庫
    			$re=Navs::create($input);
    			if($re){
    				return redirect('admin/navs');
    			}else{
    				return back()->with('errors','自訂義導航填充失敗'); 
    			}
    	}else{
    			// 顯示錯誤訊息
    		// print_r($Validator->errors()->all());
    		
    		//winhError可以把錯誤訊息傳遞回去並且賦值
    		return back()->withErrors($Validator); 
    	}
	}

		//get.admin/Navs/{Navs}/edit 編輯自訂義導航
	public function edit($navs_id){
		$field=Navs::find($navs_id);
		return view('admin/navs/edit',compact('field'));
	}
		//put.admin/Navs/{Navs} 更新自訂義導航
		//put提交方式可以用<input type="hidden" name="_method" value="put">
	public function update($nav_id){
		$input=Input::except('_token','_method');
		// print_r($input);die;
		$re=Navs::where('nav_id',$nav_id)->update($input);
		if($re){
			return redirect('admin/navs');
		}else{
			return back()->with('errors','自訂義導航更新失敗'); 
		}
	}


	//get.admin/category/{category} 顯示單個分類訊息
	public function show(){

	}
	//delete.admin/Navs/{Navs} 刪除單個自訂義導航
	public function destroy($nav_id){
		$re=Navs::where('nav_id',$nav_id)->delete();
		if($re){
			$data=[
				'status'=>0,
				'msg'=>'自訂義導航刪除成功'
			];
		}else{
				$data=[
				'status'=>1,
				'msg'=>'自訂義導航刪除失敗'
			];
		}
		return $data;
	}

}
