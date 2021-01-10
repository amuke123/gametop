<?php
/**
***标签
**/
class wishlist_Model{
	
	static function getTopWhih($num=1){
		$db=Conn::getConnect();
		$sql1="SELECT * FROM `". DB_PRE ."wishlist` WHERE `show`='1' and `date`>".(time()-7*24*3600)." ORDER BY `follownum` DESC,`likenum` DESC limit 0,".$num;
		$reset=$db->getOnce($sql1);
		$artidsnum=count(explode(',',$reset['artids']));
		if(empty($reset)||$artidsnum<2){
			$sql="SELECT * FROM `". DB_PRE ."wishlist` WHERE `show`='1' ORDER BY `follownum` DESC,`likenum` DESC limit 0,".$num;
			$reset=$db->getOnce($sql);
		}
		return $reset;
	}
	
	static function getWhihlist($num=3,$noid=''){
		$db=Conn::getConnect();
		$sql1="SELECT * FROM `". DB_PRE ."wishlist` WHERE `show`='1' ";
		if($noid!=''){$sql1.=" AND `id`<>'".$noid."' ";}
		$sql1.=" ORDER BY `follownum` DESC,`likenum` DESC limit 0,".$num;
		$reset=$db->getlist($sql1);
		return $reset;
	}
	
	
}
?>