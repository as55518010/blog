<?php
namespace App\Http\Controllers\Admin;
use App\Http\Model\Links;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class LinksController extends CommonController
{
	//資源控制器給的get方法 全部分類列表
	public function index(){
 $date = Links::orderBy('link_order','asc')->get();
        return view('admin.links.index',compact('date'));
	}

	//get.admin/links ajax異步方法排序
	public function changeOrder(){
		$input=Input::all();
		$links=Links::find($input['link_id']);
		$links->link_order=$input['link_order'];
		$re=$links->update();
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

	//get.admin/links/create 添加友情鏈接
	public function create(){
		
		return view('admin/links/add');
	}

		//post.admin/links 添加友情鏈接提交
	public function store(){
		//排除某個不需要的input則可以用except()
		$input=Input::except('_token');
			// 定義驗證規則
    	$rules=[    		
    		'link_name'=>'required',
    		'link_url'=>'required',
    	];
    	// 定義觸發規則的警告語
    	$message=[
    		'link_name.required'=>'友情鏈接名稱不能為空',
    		'link_url.required'=>'Url不能為空',
    	];

    	//驗證
    	$Validator=Validator::make($input,$rules,$message);
    	 	if($Validator->passes()){
    			//將取得數值直接寫入數據庫
    			$re=Links::create($input);
    			if($re){
    				return redirect('admin/links');
    			}else{
    				return back()->with('errors','友情鏈接填充失敗'); 
    			}
    	}else{
    			// 顯示錯誤訊息
    		// print_r($Validator->errors()->all());
    		
    		//winhError可以把錯誤訊息傳遞回去並且賦值
    		return back()->withErrors($Validator); 
    	}
	}

		//get.admin/links/{links}/edit 編輯友情鏈接
	public function edit($link_id){
		$field=Links::find($link_id);
		return view('admin/links/edit',compact('field'));
	}
		//put.admin/links/{links} 更新友情鏈接
		//put提交方式可以用<input type="hidden" name="_method" value="put">
	public function update($link_id){
		$input=Input::except('_token','_method');
		// print_r($input);die;
		$re=Links::where('link_id',$link_id)->update($input);
		if($re){
			return redirect('admin/links');
		}else{
			return back()->with('errors','友情鏈接更新失敗'); 
		}
	}


	//get.admin/category/{category} 顯示單個分類訊息
	public function show(){

	}
	//delete.admin/links/{links} 刪除單個友情鏈接
	public function destroy($link_id){
		$re=Links::where('link_id',$link_id)->delete();
		if($re){
			$data=[
				'status'=>0,
				'msg'=>'友情鏈接刪除成功'
			];
		}else{
				$data=[
				'status'=>1,
				'msg'=>'友情鏈接刪除失敗'
			];
		}
		return $data;
	}

}
