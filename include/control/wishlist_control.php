<?php
/*
**清单
*/
class wishlist_Control{

	function display($datas=array()){
		//echo "清单<pre>";
		//print_r($datas);
		$system_cache=Control::getAll();
		extract($system_cache);
		
		$pnum=count($datas)-1;
		$pagenum = Control::get('art_num');
		$pageid = isset($datas[$pnum-1])&&$datas[$pnum-1]=='page'?abs(intval($datas[$pnum])):1;
		$startnum = $pagenum*($pageid-1);
		
		$wid = '';
        if(!empty($datas[2])){
            if(is_numeric($datas[2])){
                $wid=intval($datas[2]);
            }
        }
		if($wid==''){show_404();}
		$cache=Conn::getCache();
		$sorts=$cache->readCache('sort');
		$collects=$cache->readCache('collects');
		$wish_ca=$cache->readCache('wishlist');
		if(!isset($wish_ca[$wid])){show_404();}
		$wishinfo=$wish_ca[$wid];
		$artstr=$wishinfo['artids'];
		$artids=$artstr!=''?explode(',',$artstr):array();
		$artids=array_reverse($artids,true);
		
		$site_title=$wishinfo['name'].'-'.$site_title;
		$site_description=$wishinfo['text']!=''?$wishinfo['text']:$site_description;
		$site_key=$wishinfo['name'].','.$site_key;
		
		$arts=array_slice($artids,$startnum,$pagenum,true);
		
		$artnumb=count($artids);
		$pages=ceil($artnumb/$pagenum);
		$urlpre=Url::wishlist($wid,$pageid);
		$txtsub='篇笔记';
		
		$pagestr=action_Model::pagelist($artnumb,$pages,$pageid,$urlpre,$txtsub,'');
		
		$hotArts=$cache->readCache('hotArts');
		
		include View::getView('header');
        include View::getView('wish');
	}
	
}


?>