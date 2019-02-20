<?php 
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
		//更改數據表名稱
	protected $table='config';
	// 更改數據主鍵
	protected $primaryKey='conf_id';
	//關閉存處或者更新時間的自段
	public $timestamps=false;
	//框架的防護機制，必須定義不能填充字段，這裡我用一個空的表示全部都可以填充
	protected $guarded=[];

	
}


 ?> 