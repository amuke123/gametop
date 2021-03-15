<?php
/*
**创作中心
*/
class work_Control{

	function display($datas=array()){
		//echo "创作中心<pre>";
		//print_r($datas);
		$system_cache=Control::getAll();
		extract($system_cache);
		$cache=Conn::getCache();
		$pnum=count($datas)-1;
		$pagenum = Control::get('art_num');
		$pageid = isset($datas[$pnum-1])&&$datas[$pnum-1]=='page'?abs(intval($datas[$pnum])):1;
		$startnum = $pagenum*($pageid-1);
		
		$ccdate=isset($datas[2])?$datas[2]:'';
		
		$roles=Control::getRoles();
		$uid=UID;
		
		if(!$uid){Checking::goLogin();exit();}
		$userinfo=user_Model::getInfo($uid);
		if(empty($userinfo)){show_404();}
		
		switch($ccdate){
			case 'write':
				$topname='记笔记';
				$keyson='write';
				break;
			case 'notes':
				$topname='笔记列表';
				$keyson='list';
				break;
			case 'wish':
				$topname='清单';
				$keyson='bookmark';
				break;
			case 'collect':
				$topname='收藏';
				$keyson='collect';
				break;
			case 'comment':
				$topname='评论';
				$keyson='chat';
				break;
			case 'data':
				$topname='数据';
				$keyson='data';
				break;
			case 'set':
				$topname='设置';
				$keyson='pass';
				break;
			default:
				$topname="创作中心";
				$keyson='home';
				break;
		}
		
		$site_title=$topname.'-'.$site_title;
		$site_description=$topname.'，'.$site_description;
		$site_key=$topname.','.$site_key;
		
		
		
		include View::getView('header');
        include View::getView('work');
	}
	
}


?>