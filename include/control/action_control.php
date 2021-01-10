<?php
/*
**系统操作
*/
class action_Control{
	function display($datas=array()){
		//print_r($datas);
		$cache=Conn::getCache();
		$sorts=$cache->readCache('sort');
		$collects=$cache->readCache('collects');
		$hotArts=$cache->readCache('hotArts');
		$system_cache=Control::getAll();
		extract($system_cache);
		$do=$datas[1];
		if($do=='login'||$do=='register'||$do=='reset'){
			loginOk();
			if(isset($_POST['tj'])){
				action_Model::actionFc($do,$site_title);
			}else{
				$action=$do;
				include View::getViewA('login');
			}
		}else if($do=='sort'||$do=='find'||$do=='tips'||$do=='top'||$do=='wishlist'){
			$action=$do;
			if($action=='find'){
				$site_title='发现-'.$site_title;
				$site_description="发现，".$site_description;
				$site_key='发现,'.$site_key;
				$artarr=art_Model::getRandLog(Control::get('rand_art_num'));
				$artlist=array();
				foreach($artarr as $val){
					$val['sortname']=$sorts[$val['s_id']]['sortname'];
					$val['collects']=$collects[$val['id']];
					$val['arturl']=Url::log($val['id']);
					$val['sorturl']=Url::sort($val['s_id']);
					$val['authorname']=user_Model::getUserName($val['author']);
					$val['authorurl']=Url::author($val['author']);
					$excerpt=$val['excerpt']==''?strip_tags(htmlspecialchars_decode($val['content'])):strip_tags($val['excerpt']);
					$val['excerpt']=mb_substr(trim($excerpt),0,100);
					$val['src']=$val['pic']!=''?str_replace('../',IDEA_URL,$val['pic']):getImg($val['id']);
					$artlist[$val['id']]=$val;
				}
			}
			if($action=='sort'){
				$site_title='分类-'.$site_title;
				$site_description="分类，".$site_description;
				$site_key='分类,'.$site_key;
			}
			if($action=='tips'){
				$site_title='关注-'.$site_title;
				$site_description="关注，".$site_description;
				$site_key='关注,'.$site_key;
				$pnum=count($datas)-1;
				$pagenum = Control::get('art_num');
				$pageid = isset($datas[$pnum-1])&&$datas[$pnum-1]=='page'?abs(intval($datas[$pnum])):1;
				$startnum = $pagenum*($pageid-1);
				
				$gzlist=user_Model::getGz(UID);//关注列表
				$gznum=count($gzlist);
				$proidarr=array();
				foreach($gzlist as $gzval){
					$proidarr[]=$gzval['pro_uid'];
				}
				$proidstr=implode(',',$proidarr);
				$rolestr=" and `author` in (".$proidstr.") ";
				$arts=art_Model::getNewLog($pagenum,$startnum,$rolestr,"");
				
				$counts=art_Model::getArtsNum(1,1,$rolestr,'');
				$artnumb=$counts[0]['total'];
				$pages=ceil($artnumb/$pagenum);
				$urlpre=Url::tips($pageid);
				$txtsub='篇笔记';
				
				$pagestr=action_Model::pagelist($artnumb,$pages,$pageid,$urlpre,$txtsub,'');

			}
			if($action=='top'){$tops=Control::getTops();
				$site_title='榜单-'.$site_title;
				$site_description="排行榜单，".$site_description;
				$site_key='排行榜单,榜单,排行榜,'.$site_key;
			}
			if($action=='wishlist'){
				$site_title='清单-'.$site_title;
				$site_description="清单，".$site_description;
				$site_key='清单,'.$site_key;
				$pnum=count($datas)-1;
				$pagenum = Control::get('art_num');
				$pageid = isset($datas[$pnum-1])&&$datas[$pnum-1]=='page'?abs(intval($datas[$pnum])):1;
				$startnum = $pagenum*($pageid-1);
				
				$wish_ca=$cache->readCache('wishlist');
				$wishlist=array_slice($wish_ca,$startnum,$pagenum,true);
				
				$sumnum=count($wish_ca);
				$pages=ceil($sumnum/$pagenum);
				$urlpre=Url::wishlist('',$pageid,'wishlist');
				$txtsub='清单';
				
				$pagestr=action_Model::pagelist($sumnum,$pages,$pageid,$urlpre,$txtsub,'');
			}
			include View::getView('header');
			include View::getView($do);
		}else{
			action_Model::actionFc($do,$site_title);
		}
		
	}

}


?>