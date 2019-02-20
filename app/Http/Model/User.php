<?php 
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

		//更改數據表名稱
	protected $table='user';
	// 更改數據主鍵
	protected $primaryKey='user_id';
	//關閉存處或者更新時間的字段
	public $timestamps=false;
}


 ?>