<?php 
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
		//更改數據表名稱
	protected $table='category';
	// 更改數據主鍵
	protected $primaryKey='cate_id';
	//關閉存處或者更新時間的自段
	public $timestamps=false;
	//框架的防護機制，必須定義不能填充字段，這裡我用一個空的表示全部都可以填充
	protected $guarded=[];

	public  function tree(){
		$categorys=$this->orderBy('cate_order','asc')->get();
		return $this->getTree($categorys,'cate_name','cate_id','cate_pid');
	}
	// 以靜態方式呈現
	// public Static function tree(){
	// 	$categorys=Category::all();
	// 	return (new Category)->getTree($categorys,'cate_name','cate_id','cate_pid');
	// }
	/**
	 * 文章的分類方法
	 * $data:需要分類的數據
	 * $name:數據庫裡的name字段
	 * $id:數據庫裡的id字段
	 * $pid:數據庫裡的上級分類字段
	 * $_pid:查詢該id的下級分類
	 */
	
	public function getTree($data,$name=name,$id=id,$pid=pid,$_pid=0){
		Static $arr=array();
		foreach ($data as $k => $v) {
			if($v->$pid==$_pid){
				$data[$k]['_'.$name]=$data[$k][$name];
				$arr[]=$v;
				foreach ($data as $k1 => $v1) {
					if($v1->$pid==$v->$id){
						$arr[]=$v1;
						$data[$k1]['_'.$name]='-->'.$data[$k1][$name];
						

						
					}
				}
			}
		}
		 return $arr;
	}
}


 ?>