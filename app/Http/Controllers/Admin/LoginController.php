<?php
namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

//家仔第三方插鍵驗證碼
require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login()
    {
        if($input=Input::all()){
                $code=new \Code;
               $_code= $code->get();
            if(strtoupper($input['code'])!=$_code){
                // back視返回上一頁這個提示訊息存到session裡面
             return  back()->with('msg','驗證碼錯誤');
             

            }
                //first只取一條數據
               $user=User::first();
               if($user->user_name!=$input['user_name']||Crypt::decrypt($user->user_pass)!=$input['user_pass']){
                return  back()->with('msg','用戶名或者密碼錯誤');
               }
               //登入成功寫到session裡
                session(['user'=>$user]);
               return redirect('admin');
                // print_r(session('user'));
                // echo "ok";
        }else{
         
            
           return view('admin.login'); 
        }
    	

    }

      //退出方法
     public function quit()
    {

      session(['user'=>null]);
      return redirect('admin/login');
    }

	// 引入驗證碼
     public function code()
    {


    	$code=new \Code;
    	$code->make();
    	
    }

    //測試密碼解密加密
    public function crypt()
    {

      $str='123456';
      $_str='eyJpdiI6ImZzODZBSXhrOFwvcFlodWMrR281K21RPT0iLCJ2YWx1ZSI6IjBPU3FUTzFReFB6V3pjQll3YVloMHc9PSIsIm1hYyI6IjFmYjAwMjUxNjFiM2RkMTE2YTQ3M2U2ODVkMmI4YzczNGY0YjczYmZmMTMxODg4MzgxNDBhMzE5ZjVjNjllZWIifQ==
==';
      //利用框架來進行加密
     echo Crypt::encrypt($str),'<br>';
     //利用框架來進行解密
     echo Crypt::decrypt($_str);
     

        
    }

}
