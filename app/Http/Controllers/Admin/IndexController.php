<?php
namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;




class IndexController extends CommonController
{
  public function index(){
    return view('admin.index');

  }

   public function info(){
    return view('admin.info');

  }

  //更改密碼
    public function pass(){
    if($input=Input::all()){
    	// 定義驗證規則
    	$rules=[    		
    		'password'=>'required|between:6,20|confirmed',
    	];
    	// 定義觸發規則的警告語
    	$message=[
    		'password.required'=>'新密碼不能為空',
    		'password.between'=>'新密碼必須在6~20位數之間',
    		'password.confirmed'=>'新密碼和確認密碼不一致',
    	];

    	//驗證
    	$Validator=Validator::make($input,$rules,$message);
    	if($Validator->passes()){
    		$user=User::first();
    		$_password=Crypt::decrypt($user->user_pass);
    		if($input['password_o']==$_password){
    			// 原密碼正確的話進行替換
    			$user->user_pass=Crypt::encrypt($input['password']);
    			$user->update();
    			return back()->with('errors','修改密碼成功'); 
    		}else{

    			return back()->with('errors','原密碼錯誤'); 
    		}
    	
    	}else{
    			// 顯示錯誤訊息
    		// print_r($Validator->errors()->all());
    		
    		//winhError可以把錯誤訊息傳遞回去並且賦值
    		return back()->withErrors($Validator); 
    	}
    }else{
    	return view('admin.pass');
    }

  }
}
