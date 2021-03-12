<?php
/*
**榜单页面
*/
class top_Control{

	function display($datas=array()){
		//echo "榜单页<pre>";
		//print_r($datas);
		$cache=Conn::getCache();
		$sorts=$cache->readCache('sort');
		$collects=$cache->readCache('collects');
		$pagenum = Control::get('art_num');
		$system_cache=Control::getAll();
		extract($system_cache);
		$ccdate=isset($datas[2])?$datas[2]:'';
		switch($ccdate){
			case 'fabulous':
				$topname='高赞榜';
				$arts=$cache->readCache('goods');
				break;
			case 'popularity':
				$topname='人气榜';
				$arts=$cache->readCache('eyes');
				break;
			case 'work':
				$topname='创作榜';
				$wooks=$cache->readCache('wooks');
				break;
			case 'collect':
				$topname='收藏榜';
				$arts=$cache->readCache('collect');
				break;
			case 'list':
				$topname='清单榜';
				$wish=$cache->readCache('wish');
				break;
			case 'comment':
				$topname='神评榜';
				$saytop=$cache->readCache('saytop');
				break;
			default:
				$topname='榜单';
				break;
		}
		
		$site_title=$topname.'-'.$site_title;
		$site_description=$topname.'，'.$site_description;
		$site_key=$topname.','.$site_key;
		
		$hotArts=$cache->readCache('hotArts');
		
		include View::getView('header');
        include View::getView('toplist');
	}
	
}


?>