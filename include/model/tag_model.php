<?php
/**
***标签
**/
class tag_Model{
	
	static function upArtTags($tagstr,$artid){//文章删除后更新标签
		$db=Conn::getConnect();
		$cache=Conn::getCache();
		$tagarr=explode(',',$tagstr);
		updateCacheAll('tags');
		$tags=$cache->readCache('tags');
		foreach($tagarr as $v){
			if(!empty($tags[$v])){
				$artidsarr=explode(',',$tags[$v]['a_id']);
				$newids='';
				foreach($artidsarr as $vid){
					if($vid!=$artid){
						$newids.=','.$vid;
					}
				}
				$newids=trim($newids,',');
				$sqlup2="UPDATE `". DB_PRE ."tags` SET `a_id`='".$newids."' WHERE `id`=".$v;
				$db->query($sqlup2);
			}
		}
		updateCacheAll(array('sta','tags'));
	}
	static function delTags($taglist){
		$db=Conn::getConnect();
		$cache = Conn::getCache();
		$tags=$cache->readCache('tags');
		if(!empty($taglist)){
			foreach($taglist as $key => $value){
				if(!empty($tags[$key])){
					$artidsarr=explode(',',$tags[$key]['a_id']);
					foreach($artidsarr as $val){
						$sql="SELECT `tags` FROM `". DB_PRE ."article` WHERE `id`=".$val;
						$arttags=$db->getOnce($sql);
						$arttagsarr=explode(',',$arttags['tags']);
						$newids='';
						foreach($arttagsarr as $v){
							if($v!=$key){$newids.=','.$v;}
						}
						$newids=trim($newids,',');
						$sqlup="UPDATE `". DB_PRE ."article` SET `tags`='".$newids."' WHERE `id`=".$val;
						$db->query($sqlup);
					}
					$sqldel="DELETE FROM `". DB_PRE ."tags` WHERE `id` = '".$key."';";
					$db->query($sqldel);
				}
			}
			updateCacheAll(array('sta','tags','newArts'));
			return true;
		}
	}
	
	static function getArtTagList($tagids=''){//获取笔记标签列表
		$cache=Conn::getCache();
		$tags_cache=$cache->readCache('tags');
		$data=array();
		
		if($tagids!=''){
			$tagids=str_replace('，',',',$tagids);
			$ids=explode(',',$tagids);
			foreach($ids as $val){
				$data[$val]['tagname']=$tags_cache[$val]['tagname'];
				$data[$val]['tagurl']=$tags_cache[$val]['tagurl'];
			}
		}
		return $data;
	}
	
	static function getTagsId($tagstr,$artid){//更新文章标签
		$db=Conn::getConnect();
		$cache=Conn::getCache();
		$tagstr=str_replace('，',',',$tagstr);
		$tagarr=explode(',',$tagstr);
		updateCacheAll('tags');
		$tags=$cache->readCache('tags');
		$tagnames=array();
		$ids='';
		foreach($tags as $value){$tagnames['tagn'][]=$value['tagname'];$tagnames['tagids'][$value['tagname']]=$value['id'];}
		$sqloldcx="SELECT `". DB_PRE ."tags` FROM `". DB_PRE ."article` WHERE `id`=".$artid;
		$rowold=$db->getOnce($sqloldcx);
		$oldtagsidarr=explode(',',$rowold['tags']);
		foreach($tagarr as $val){
			if(!in_array($val,$tagnames['tagn'])){
				if($val!=''){
					$sql="INSERT INTO `". DB_PRE ."tags` (`id`, `name`, `a_id`) VALUES (NULL, '".$val."', '".$artid."');";
					if($db->query($sql)){
						$sqlcx="SELECT `id` FROM `". DB_PRE ."tags` ORDER BY `id` DESC LIMIT 0,1";
						$row=$db->getOnce($sqlcx);
						//$row=$db->last_insert_id();
						$ids.=','.$row['id'];
					}
				}
			}else{
				$artidstr=$tags[$tagnames['tagids'][$val]]['a_id'];
				$artidarr=explode(',',$artidstr);
				if(!in_array($artid,$artidarr)){
					$artidstr=$tags[$tagnames['tagids'][$val]]['a_id'].','.$artid;
					$artidstr=trim($artidstr,',');
					$sqlup2="UPDATE `". DB_PRE ."tags` SET `a_id`='".$artidstr."' WHERE `id`=".$tagnames['tagids'][$val];
					$db->query($sqlup2);
				}
				$ids.=','.$tagnames['tagids'][$val];
			}
		}
		$ids=trim($ids,',');
		$sqlup="UPDATE `". DB_PRE ."article` SET `tags`='".$ids."' WHERE `id`=".$artid;
		$db->query($sqlup);
		$newidsarr=explode(',',$ids);
		foreach($oldtagsidarr as $v){
			if(!in_array($v,$newidsarr)){
				if(!empty($tags[$v])){
					$artidsarr=explode(',',$tags[$v]['a_id']);
					$newids='';
					foreach($artidsarr as $vid){
						if($vid!=$artid){
							$newids.=','.$vid;
						}
					}
					$newids=trim($newids,',');
					$sqlup3="UPDATE `". DB_PRE ."tags` SET `a_id`='".$newids."' WHERE `id`=".$v;
					$db->query($sqlup3);
				}
			}
		}
	}
	
}
?>