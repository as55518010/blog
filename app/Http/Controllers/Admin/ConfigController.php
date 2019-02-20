<?php
namespace App\Http\Controllers\Admin;
use App\Http\Model\Config;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class ConfigController extends CommonController
{
	//資源控制器給的get方法 全部配置項列表
	public function index(){
 		$date = Config::orderBy('conf_order','asc')->get();
 		foreach ($date as $k => $v) {
 			switch ($v->field_type) {
 				case 'input'://單行文本
 					$date[$k]->_html='<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'">';
 					break;
 				case 'textarea'://多行文本
 					$date[$k]->_html='<textarea type="text" class="lg" name="conf_content[]" >'.$v->conf_content.'</textarea>';
 					break;
 				case 'radio'://單選框
 					//1|開啟，0關閉
 					$arr=explode(',',$v->field_value);

 					$str='';
 					if(strpos($arr,'|')){
 						foreach ($arr as $k1 => $v1) {
 						//1|開啟
 						
 						$r=explode('|',$v1);
 						$c=$v->conf_content==$r[0]?' checked ':'';
 						var_dump($arr);die;
 						$str.='<input type="radio" name="conf_content[]" value="'.$r[0].'"'.$c.'>'.$r[1].'　';

 						}
 					} 			
 					
 					$date[$k]->_html=$str;
 					break;
 			}
 		}

        return view('admin.config.index',compact('date'));
	}
	    //把配置項提交數據
	public function changeContent(){
		$input=Input::all();
		foreach ($input['conf_id'] as $k => $v) {
			Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
		}
		$this->putFile();
		return back()->with('errors','配置項更新成功'); 

	}

	//get.admin/config ajax異步方法排序
	public function changeOrder(){
		$input=Input::all();
		$Config=Config::find($input['conf_id']);
		$Config->conf_order=$input['conf_order'];
		$re=$Config->update();
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

	//get.admin/config/create 添加配置項
	public function create(){
		
		return view('admin/config/add');
	}

		//post.admin/config 添加配置項提交
	public function store(){
		//排除某個不需要的input則可以用except()
		$input=Input::except('_token');
		var_dump($input);
			// 定義驗證規則
    	$rules=[    		
    		'conf_name'=>'required',
    		'conf_title'=>'required',
    	];
    	// 定義觸發規則的警告語
    	$message=[
    		'conf_name.required'=>'配置項名稱不能為空',
    		'conf_title.required'=>'配置項標題不能為空',
    	];

    	//驗證
    	$Validator=Validator::make($input,$rules,$message);
    	 	if($Validator->passes()){
    	 		if(empty($_FILES)){
    	 		 // 上傳圖片
    	 			if($_FILES["field_thumb"]["error"]>0){		 			
		 				return back()->with('errors','圖片上傳失敗'); 
		             }else{

		             	$type=strrchr($_FILES['field_thumb']['name'],".");//獲取後墜
		             	$_FILES['field_thumb']['name']=date('YmdHis',time()).$type;
		             	move_uploaded_file($_FILES["field_thumb"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/uploads/".$_FILES["field_thumb"]["name"]);
		             	$input['field_thumb']="/uploads/".$_FILES["field_thumb"]["name"];

		             }
    	 		}
    			//將取得數值直接寫入數據庫
    			$re=Config::create($input);
    			if($re){
    				return redirect('admin/config');
    			}else{
    				return back()->with('errors','配置項填充失敗'); 
    			}
    	}else{
    			// 顯示錯誤訊息
    		// print_r($Validator->errors()->all());
    		
    		//winhError可以把錯誤訊息傳遞回去並且賦值
    		return back()->withErrors($Validator); 
    	}
	}

		//get.admin/config/{Config}/edit 編輯配置項
	public function edit($Config_id){
		$field=Config::find($Config_id);
		return view('admin/config/edit',compact('field'));
	}
		//put.admin/config/{Config} 更新配置項
		//put提交方式可以用<input type="hidden" name="_method" value="put">
	public function update($conf_id){
		$input=Input::except('_token','_method');
		// print_r($input);die;
		$re=Config::where('conf_id',$conf_id)->update($input);
		if($re){
			$this->putFile();
			return redirect('admin/config');
		}else{
			return back()->with('errors','配置項更新失敗'); 
		}
	}


	//get.admin/category/{category} 顯示單個分類訊息
	public function show(){

	}
	//delete.admin/config/{Config} 刪除單個配置項
	public function destroy($conf_id){
		$re=Config::where('conf_id',$conf_id)->delete();
		if($re){
			$this->putFile();
			$data=[
				'status'=>0,
				'msg'=>'配置項刪除成功'
			];
		}else{
				$data=[
				'status'=>1,
				'msg'=>'配置項刪除失敗'
			];
		}
		return $data;
	}

	//把配置項寫入配置文件
	public function putFile(){
		$config=Config::pluck('conf_content','conf_name')->all();
		//將數組轉換字符串
		// echo var_export($config,true);
		//設定配置文件路徑
		$path=base_path().'\config\web.php';
		//要寫入的內容
		$str='<?php return '.var_export($config,true).';';
		//此函數會將 路徑，內容寫入
		file_put_contents($path,$str);
		// echo $path;
	}

}
