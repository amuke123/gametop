<?php
/**
***用户信息
**/
class user_Model{
	public static function getInfo($uid=UID){//获取指定用户信息，默认获取当前登录用户
		$mysql = Conn::getConnect();
		$data=array();
		$sql = "SELECT * FROM `". DB_PRE ."user` where `id`='". $uid ."'";
		$row = $mysql->getOnce($sql);
		$data=$row;
		$name=$data['nickname']==''?$data['username']:$data['nickname'];
		$likesort=explode(',',$row['likesort']);
		$collectnum=$row['collect']==""?0:count(explode(",",$row['collect']));
		$predata = $mysql->getOnce("SELECT COUNT(*) AS total FROM ". DB_PRE ."focus WHERE `isok`='1' AND `pre_uid`=".$uid);
		$prenum=$predata['total'];
		$prodata = $mysql->getOnce("SELECT COUNT(*) AS total FROM ". DB_PRE ."focus WHERE `isok`='1' AND `pro_uid`=".$uid);
		$pronum=$prodata['total'];
		$wishdata = $mysql->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "wishlist WHERE `show`='1' AND `uid`='".$uid."'");
		$wishnum = $wishdata['total'];//清单
		$artnum = art_Model::getUserArtNum($uid);
		$data['likesort']=$likesort;
		$data['collectnum']=$collectnum;
		$data['prenum']=$prenum;
		$data['pronum']=$pronum;
		$data['wishnum']=$wishnum;
		$data['artnum']=$artnum;
		$data['name']=$name;
		return $data;
	}

	public static function getUsersNum($examine,$state){//获取所有用户数
		$mysql = Conn::getConnect();
		$sql = "SELECT COUNT(*) AS total FROM `". DB_PRE ."user` WHERE `username` != '' ";
		if($examine=='0'){$sql .= " AND `ischeck`='0' ";}
		if($state=='0'){$sql .= " AND `ischeck`='1' AND `state` != '0'";}
		$row = $mysql->getOnce($sql);
		return $row['total'];
	}
	
	public static function getUsersIofo($startnum,$pagenum,$examine,$state){//获取指定用户的用户信息
		$mysql = Conn::getConnect();
		$sql = "SELECT `id` FROM `". DB_PRE ."user` WHERE `username`!='' ";
		if($examine=='0'){$sql .= " AND `ischeck`='0' ";}
		if($state=='0'){$sql .= " AND `ischeck`='1' AND `state` != '0' ";}
		$sql .= " LIMIT ".$startnum.",".$pagenum;
		$row = $mysql->getlist($sql);
		return $row;
	}
	
	public static function getUserList($num=9){//获取指定个数的正常用户信息
		$mysql = Conn::getConnect();
		$sql = "SELECT * FROM `". DB_PRE ."user` WHERE `username`!='' AND `ischeck`='1' AND `state`='0' ORDER BY `lastdate` DESC LIMIT 0,".$num;
		$row = $mysql->getlist($sql);
		return $row;
	}
	
	public static function getUsersAllNameAndEmail(){
		$mysql = Conn::getConnect();
		$sql = "SELECT `username`,`nickname`,`email` FROM `". DB_PRE ."user` ";
		$row = $mysql->getlist($sql);
		return $row;
	}
	
	public static function getUserName($uid){
		$reset=self::getInfo($uid);
		return $reset['name'];
	}
	
	public static function getUserPhoto($uid,$y=''){
		$reset=self::getInfo($uid);
		if($y==''){
			return $reset['photo']!=''?str_replace('../',IDEA_URL,$reset['photo']):IDEA_URL .ADMIN_TYPE .'/view/static/images/avatar.jpg';
		}else{
			return $reset['photo']!=''?str_replace('../',IDEA_URL,$reset['photo']):'';
		}
	}
	
	public static function delUserPhoto($uid=''){
		$mysql = Conn::getConnect();
		$sqlst="UPDATE `". DB_PRE ."user` SET `photo`='' WHERE `id`=".$uid;
		$mysql->query($sqlst);
	}
	
	public static function setLastdate($uid){
		$mysql = Conn::getConnect();
		$sqlst="UPDATE `". DB_PRE ."user` SET `lastdate`='".time()."' WHERE `id`=".$uid;
		$mysql->query($sqlst);
	}
	

	public static function getGz($author){//获取关注列表
		$db = Conn::getConnect();
		$sql="SELECT * FROM `". DB_PRE ."focus` where `isok`='1' AND `pre_uid` =".$author;
		$focus1=$db->getlist($sql);
		return $focus1;
	}

	public static function getFs($author){//获取粉丝列表
		$db = Conn::getConnect();
		$sql="SELECT * FROM `". DB_PRE ."focus` where `isok`='1' AND `pro_uid` =".$author;
		$focus2=$db->getlist($sql);
		return $focus2;
	}

	public static function isGz($foc,$id){//判断是否被您关注
		$key=0;
		if(count($foc)>0){
			foreach($foc as $val){
				if($val['pre_uid']==$id){
					$key=$val['id'];
				}
			}
		}
		return $key;
	}
	
}
?>