<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
  //圖片上傳
  public function upload(){
  	$file=Input::file('Filedata');//獲取圖片訊息
  	  if($file -> isValid()){//判斷上傳文件是否有效
  	  		// $realPath=$file->getRealPath();//緩存在tmp文件夾下的絕對路徑
            $entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;//重組文件名
            $path = $file -> move(base_path().'/uploads',$newName);//指定文件夾，並賦予它新檔案名
            $filepath = 'uploads/'.$newName;
            return $filepath;//回傳文件路徑
 		 }
	}
}
