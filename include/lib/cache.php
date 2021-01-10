<?php
class Cache{
	private $db;
	function __construct(){
        $this->db = Conn::getConnect();
    }
	
	function updateCache($cacheDB = null){//更新缓存
		if(is_string($cacheDB)) {
            if(method_exists($this, 'ch_'.$cacheDB)){
                call_user_func(array($this, 'ch_'.$cacheDB));
            }
            return;
        }
		if(is_array($cacheDB)){
            foreach($cacheDB as $name){
                if(method_exists($this,'ch_'.$name)){
                    call_user_func(array($this,'ch_'.$name));
                }
            }
            return;
        }
		if($cacheDB == null){
            $cacheDB = get_class_methods($this);
            foreach($cacheDB as $method){
                if(preg_match('/^ch_/',$method)){
                    call_user_func(array($this,$method));
                }
            }
        }
	}
	private function ch_options() {//系统配置缓存
        $options_cache = array();
        $sql = "SELECT * FROM " . DB_PRE . "options";
		$row = $this->db->getlist($sql);
		foreach($row as $val){
            if (in_array($val['key'], array('site_key', 'blogname', 'bloginfo', 'blogurl', 'icp'))) {
                $val['value'] = htmlspecialchars($val['value']);
            }
            $options_cache[$val['key']] = $val['value'];
        }
        $cacheData = serialize($options_cache);
        $this->cacheWrite($cacheData, 'options');
    }
	
	private function ch_sta(){//站点统计缓存
		$sta_cache = array();
		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "article WHERE `type`='a' AND `show`='1' AND `checkok`='1' ");
		$artnum = $data['total'];//显示且已审核的笔记

		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "article WHERE `type`='a' AND `show`='0'");
		$hidenum = $data['total'];//隐藏的笔记

		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "article WHERE `type`='a' AND `show`='1' AND `checkok`='0' ");
		$checknum = $data['total'];	//显示但未审核的笔记

		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "say WHERE `show`='1' AND `ischeck`='1' ");
		$saynum = $data['total'];//显示且已审核的评论

		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "say WHERE `show`='0' ");
		$hidesay = $data['total'];//隐藏的评论
		
		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "say WHERE `show`='1' AND `ischeck`='0' ");
		$checksay = $data['total'];//显示但未审核的评论

		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "say WHERE `show`='1' AND `ischeck`='1' AND `mark`='2' ");
		$godsay = $data['total'];//神评论
		
		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "say WHERE `show`='1' AND `ischeck`='1' AND `mark`='1' ");
		$topsay = $data['total'];//加精评论
		
		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "user ");
		$usernum = $data['total'];//注册用户
		
		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "tags ");
		$tagsnum = $data['total'];//标签
		
		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "link WHERE `show`='1' ");
		$linknum = $data['total'];//友链
		
		$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "wishlist WHERE `show`='1' ");
		$wishnum = $data['total'];//清单

		$sta_cache = array(
			'artnum' => $artnum,
			'hidenum' => $hidenum,
			'checknum' => $checknum,
			'saynum' => $saynum,
			'saynum_all' => $saynum + $hidesay + $checksay,
			'hidesay' => $hidesay,
			'checksay' => $checksay,
			'godsay' => $godsay,
			'topsay' => $topsay,
			'usernum' => $usernum,
			'tagsnum' => $tagsnum,
			'linknum' => $linknum,
			'wishlistnum' => $wishnum,
		);
		
		//print_r($sta_cache);

		$reset = $this->db->getlist("SELECT `id` FROM " . DB_PRE . "user ");
		foreach($reset as $row){
			$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "article WHERE author='".$row['id']."' AND `type`='a' AND `show`='1'");
			$artnumA = $data['total'];//显示的笔记

			$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "article WHERE author='".$row['id']."' AND `type`='a' AND `show`='0'");
			$hidenumA = $data['total'];//隐藏的笔记

			$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "say AS s," . DB_PRE . "article AS a WHERE s.`a_id` = a.`id` AND a.`author`='".$row['id']."' ");
			$saynumA = $data['total'];//显示的评论

			$data = $this->db->getOnce("SELECT COUNT(*) AS total FROM " . DB_PRE . "say AS s," . DB_PRE . "article AS a WHERE s.`a_id` = a.`id` AND a.`author`='".$row['id']."' AND s.`show`='0' ");
			$hidesayA = $data['total'];//隐藏的评论

			$sta_cache[$row['id']] = array(
				'artnum' => $artnumA,
				'hidenum' => $hidenumA,
				'saynum' => $saynumA,
				'hidesay' => $hidesayA,
			);
		}

		$cacheData = serialize($sta_cache);
		$this->cacheWrite($cacheData, 'sta');
	}
	
	private function ch_banner(){//轮换图缓存
        $banner_cache = array();
        $row = $this->db->getlist("SELECT * FROM `". DB_PRE ."banner` ORDER BY `group` ASC,`show` DESC,`index` ASC");
        foreach($row as $show_banner){
            $banner_cache[$show_banner['id']] = array(
                'name' => htmlspecialchars($show_banner['name']),
                'link' => htmlspecialchars($show_banner['link']),
				'group' => htmlspecialchars($show_banner['group']),
				'pic' => htmlspecialchars($show_banner['pic']),
                'blank' => htmlspecialchars($show_banner['blank']),
                'index' => htmlspecialchars($show_banner['index']),
                'show' => htmlspecialchars($show_banner['show']),
                'id' => htmlspecialchars($show_banner['id'])
			);
        }
        $cacheData = serialize($banner_cache);
        $this->cacheWrite($cacheData, 'banner');
    }
	
	private function ch_weekuser(){//一周发布文章的用户
		$weekuser_cache = array();
        $row = $this->db->getlist("SELECT `id`,`author` FROM `". DB_PRE ."article` WHERE `date`>'".(time()-7*24*3600)."' AND `show`='1' AND `checkok`='1' AND type='a' ");
		foreach($row as $show_weekuser){
			$weekuser_cache[$show_weekuser['author']]=isset($weekuser_cache[$show_weekuser['author']])?$weekuser_cache[$show_weekuser['author']]+1:1;
		}
		$cacheData = serialize($weekuser_cache);
        $this->cacheWrite($cacheData, 'weekuser');
	}
	private function ch_alluser(){//全部发布文章的用户
		$weekuser_cache = array();
        $row = $this->db->getlist("SELECT `id`,`author` FROM `". DB_PRE ."article` WHERE `show`='1' AND `checkok`='1' AND type='a' ");
		foreach($row as $show_weekuser){
			$weekuser_cache[$show_weekuser['author']]=isset($weekuser_cache[$show_weekuser['author']])?$weekuser_cache[$show_weekuser['author']]+1:1;
		}
		$cacheData = serialize($weekuser_cache);
        $this->cacheWrite($cacheData,'alluser');
	}
	
	
	private function ch_wishlist(){//清单缓存
        $wishlist_cache = array();
        $row = $this->db->getlist("SELECT * FROM `". DB_PRE ."wishlist` ORDER BY `lastdate` DESC");
        foreach($row as $show_wishlist){
            $wishlist_cache[$show_wishlist['id']] = array(
                'uid' => htmlspecialchars($show_wishlist['uid']),
                'name' => htmlspecialchars($show_wishlist['name']),
				'date' => htmlspecialchars($show_wishlist['date']),
				'lastdate' => htmlspecialchars($show_wishlist['lastdate']),
                'artids' => htmlspecialchars($show_wishlist['artids']),
                'text' => htmlspecialchars($show_wishlist['text']),
                'pic' => htmlspecialchars($show_wishlist['pic']),
                'follownum' => htmlspecialchars($show_wishlist['follownum']),
                'likenum' => htmlspecialchars($show_wishlist['likenum']),
                'show' => htmlspecialchars($show_wishlist['show']),
                'id' => htmlspecialchars($show_wishlist['id'])
			);
        }
        $cacheData = serialize($wishlist_cache);
        $this->cacheWrite($cacheData, 'wishlist');
    }
	
	private function ch_sort(){//分类缓存
        $sort_cache = array();
        $query = $this->db->getlist("SELECT * FROM `". DB_PRE ."sort` ORDER BY `top_id` ASC,`index` ASC");
        foreach($query as $row){
            $data = $this->db->getOnce("SELECT COUNT(*) AS total FROM `". DB_PRE ."article` WHERE `s_id`=". $row['id'] ." AND `show`='1' AND `checkok`='1' AND type='a'");
            $logNum = $data['total'];
            $sortData = array(
                'artnum' => $logNum,
                'sortname' => htmlspecialchars($row['name']),
                'description' => htmlspecialchars($row['description']),
				'key' => htmlspecialchars($row['key']),
                'alias' =>$row['alias'],
                'id' => intval($row['id']),
                'group' => intval($row['group']),
                'index' => intval($row['index']),
                'top_id' => intval($row['top_id']),
                'template' => htmlspecialchars($row['template']),
				'pic' => htmlspecialchars($row['pic']),
            );
			if($row['top_id']==0){
				$sortData['children'] = array();
			}else if(isset($sort_cache[$row['top_id']])){
				$sort_cache[$row['top_id']]['children'][]=$row['id'];
			}
            $sort_cache[$row['id']] = $sortData;
        }
        $cacheData = serialize($sort_cache);
        $this->cacheWrite($cacheData, 'sort');
    }
	
	private function ch_userdiy(){//用户个性域名缓存
		$sql = "SELECT `id`,`diyurl` FROM `". DB_PRE ."user` where `diyurl`!=''";
        $row = $this->db->getlist($sql);
        $useralias_cache = array();
        foreach($row as $val){
            $useralias_cache[$val['id']]=$val['diyurl'];
        }
        $cacheData = serialize($useralias_cache);
        $this->cacheWrite($cacheData, 'userdiy');
	}
	
	private function ch_artalias(){//笔记别名缓存
		$sql = "SELECT `id`,`alias` FROM `". DB_PRE ."article` where `alias`!=''";
        $row = $this->db->getlist($sql);
        $artalias_cache = array();
        foreach($row as $val){
            $artalias_cache[$val['id']]=$val['alias'];
        }
        $cacheData = serialize($artalias_cache);
        $this->cacheWrite($cacheData, 'artalias');
	}
	
	private function ch_collects(){//笔记被收藏数缓存
		$sql = "SELECT `id` FROM `". DB_PRE ."article` WHERE `checkok`='1' AND `show`='1' ";
        $row = $this->db->getlist($sql);
        $collects_cache = array();
        foreach($row as $val){
            $collects_cache[$val['id']]=art_Model::getCollects($val['id']);
        }
        $cacheData = serialize($collects_cache);
        $this->cacheWrite($cacheData, 'collects');
	}
	
	private function ch_collectsweek(){//一周内的笔记被收藏数缓存
		$sql = "SELECT `id` FROM `". DB_PRE ."article` WHERE `checkok`='1' AND `show`='1' AND `date`>".(time()-7*24*3600)." ";
        $row = $this->db->getlist($sql);
        $collectsweekcache = array();
        foreach($row as $val){
            $collectsweekcache[$val['id']]=art_Model::getCollects($val['id']);
        }
        $cacheData = serialize($collectsweekcache);
        $this->cacheWrite($cacheData, 'collectsweek');
	}
	
	private function ch_artSortList(){//首页分类文章缓存
		$sortlist=$this->readCache('sort');
		$artSortList=array();
		foreach($sortlist as $sortkey=>$sortvalue){
			$rolestr = " AND `s_id`='".$sortkey."' ";
			$arts=art_Model::getArtList(1,1,$rolestr,'',0,7);
			$arts_cache = array();
			foreach($arts as $val){
				$val['arturl']=Url::log($val['id']);
				$val['src']=$val['pic']!=''?str_replace('../',IDEA_URL,$val['pic']):getImg($val['id']);
				$arts_cache[$val['id']]=$val;
			}
			$artSortList[$sortkey]['art']=$arts_cache;
		}
        $cacheData = serialize($artSortList);
        $this->cacheWrite($cacheData, 'artSortList');
	}
	
	private function ch_newArts(){//首页最新文章缓存
		$sorts = $this->readCache('sort');
		$collects = $this->readCache('collects');
		$newArts=art_Model::getNewLog(Control::get('new_art_num'),0,'','');
		$newArts_cache = array();
		foreach($newArts as $val){
			$val['sortname']=$sorts[$val['s_id']]['sortname'];
			$val['collects']=$collects[$val['id']];
			$val['arturl']=Url::log($val['id']);
			$val['sorturl']=Url::sort($val['s_id']);
			$val['authorname']=user_Model::getUserName($val['author']);
			$val['authorurl']=Url::author($val['author']);
			$excerpt=$val['excerpt']==''?strip_tags(htmlspecialchars_decode($val['content'])):strip_tags($val['excerpt']);
			$val['excerpt']=mb_substr(trim($excerpt),0,180);
			$val['src']=$val['pic']!=''?str_replace('../',IDEA_URL,$val['pic']):getImg($val['id']);
            $newArts_cache[$val['id']]=$val;
        }
        $cacheData = serialize($newArts_cache);
        $this->cacheWrite($cacheData, 'newArts');
	}
	
	private function ch_hotArts(){//首页热门文章缓存
		$sqlpro=' AND `date`>'.(time()-7*24*3600).' ';
		$order=' `saynum` DESC,`goodnum` DESC,`eyes` DESC,';
		$hotArts=art_Model::getNewLog(Control::get('hot_art_num'),0,$sqlpro,$order);
		$hotArts_cache = array();
		foreach($hotArts as $val){
			$val['arturl']=Url::log($val['id']);
			$hotArts_cache[$val['id']]=$val;
		}
        $cacheData = serialize($hotArts_cache);
        $this->cacheWrite($cacheData, 'hotArts');
	}
	
	private function ch_tags(){//标签缓存
        $tag_cache = array();
        $hideAids = array();
		$hidesql="SELECT `id` FROM `". DB_PRE ."article` where (`show`='0' or `checkok`='0') and type='a'";
        $hiderow = $this->db->getlist($hidesql);
        foreach($hiderow as $hideval){
            $hideAids[] = $hideval['id'];
        }
		$tagsql="SELECT `id`,`name`,`a_id` FROM `". DB_PRE ."tags`";
        $tagrow = $this->db->getlist($tagsql);
		foreach($tagrow as $show_tag){
            foreach ($hideAids as $hval) {
                $show_tag['a_id'] = str_replace(','.$hval.',', ',' , $show_tag['a_id']);
				$show_tag['a_id'] = str_replace($hval.',', '' , $show_tag['a_id']);
				$show_tag['a_id'] = str_replace(','.$hval, '' , $show_tag['a_id']);
				$show_tag['a_id'] = str_replace($hval, '' ,$show_tag['a_id']);
            }
            if($show_tag['a_id'] == ''){continue;}
            $artnum = substr_count($show_tag['a_id'],',') + 1;
            $tag_cache[$show_tag['id']] = array(
				'tagurl' => urlencode($show_tag['name']),
				'tagname' => htmlspecialchars($show_tag['name']),
				'color' => "rgb(".mt_rand(100,200).",".mt_rand(100,200).",".mt_rand(100,200).")",
				'artnum' => $artnum,
				'id' => $show_tag['id'],
				'a_id' => $show_tag['a_id'],
            );
        }
        $cacheData = serialize($tag_cache);
        $this->cacheWrite($cacheData, 'tags');
    }
	
	private function ch_artsort(){//文章分类缓存
        $sql = "SELECT `id`,`s_id` FROM `". DB_PRE ."article` where `type`='a'";
        $row = $this->db->getlist($sql);
        $artsort_cache = array();
        foreach($row as $val){
            if($val['s_id'] > 0){
				$sql1="SELECT `id`,`name`,`alias` FROM `". DB_PRE ."sort` where `id`=". $val['s_id'];
                $srow = $this->db->getOnce($sql1);
                $artsort_cache[$val['id']] = array(
                    'name' => htmlspecialchars($srow['name']),
                    'id' => htmlspecialchars($srow['id']),
                    'alias' => htmlspecialchars($srow['alias']),
                );
            }
        }
        $cacheData = serialize($artsort_cache);
        $this->cacheWrite($cacheData, 'artsort');
    }
	
	private function ch_nav(){//导航缓存
        $nav_cache = array();
        $navlist = $this->db->getlist("SELECT * FROM `". DB_PRE ."nav` ORDER BY `group` ASC,`top_id` ASC,`index` ASC,`id` DESC");
        $sorts = $this->readCache('sort');
        foreach($navlist as $row){
            $children = array();
            //$url = Url::nav($row['type'], $row['type_id'], $row['url']);
            if ($row['type'] == nav_Model::navtype_sort && !empty($sorts[$row['type_id']]['children'])){
                foreach($sorts[$row['type_id']]['children'] as $sortid){
                    $children[] = $sorts[$sortid];
                }
            }
            $navData = array(
				'id' => intval($row['id']),
				'name' => htmlspecialchars(trim($row['name'])),
				'url' => htmlspecialchars(trim($row['url'])),
				'pic' => htmlspecialchars(trim($row['pic'])),
				'blank' => intval($row['blank']),
				'changeok' => intval($row['changeok']),
				'type' => intval($row['type']),
				'typeId' => intval($row['type_id']),
				'index' => intval($row['index']),
				'show' => intval($row['show']),
				'top_id' => intval($row['top_id']),
				'group' => intval($row['group']),
				'children' => $children,
            );
            if($row['type'] == nav_Model::navtype_custom) {
                if($navData['top_id'] == 0) {
                    $navData['childnav'] = array();
                }else if(isset($nav_cache[$row['top_id']])){
                    $nav_cache[$row['top_id']]['childnav'][] = $row['id'];
                }
            }
            $nav_cache[$row['id']] = $navData;
        }
        $cacheData = serialize($nav_cache);
        $this->cacheWrite($cacheData, 'nav');
    }
	
	private function ch_link(){//友情链接缓存
        $link_cache = array();
        $row = $this->db->getlist("SELECT * FROM `". DB_PRE ."link` ORDER BY `group` ASC,`index` ASC");
        foreach($row as $show_link){
            $link_cache[$show_link['id']] = array(
                'name' => htmlspecialchars($show_link['sitename']),
                'id' => htmlspecialchars($show_link['id']),
                'url' => htmlspecialchars($show_link['siteurl']),
				'group' => htmlspecialchars($show_link['group']),
				'pic' => htmlspecialchars($show_link['pic']),
				'index' => htmlspecialchars($show_link['index']),
				'show' => htmlspecialchars($show_link['show']),
                'des' => htmlspecialchars($show_link['description'])
			);
        }
        $cacheData = serialize($link_cache);
        $this->cacheWrite($cacheData, 'link');
    }
	
	private function ch_wooks(){//用户创作缓存
		$pagenum = Control::get('art_num');
	    $weekuser=$this->readCache('weekuser');
	    $alluser=$this->readCache('alluser');
		$weekuser2=array_slice($weekuser,0,$pagenum,true);
		$alluser2=array_slice($alluser,0,$pagenum,true);
		$wooks_cache = array();
		$wooks_cache['week']=$weekuser2;
		$wooks_cache['all']=$alluser2;
		$cacheData = serialize($wooks_cache);
        $this->cacheWrite($cacheData, 'wooks');
    }
	
	private function ch_goods(){//高赞笔记缓存
		$sorts=$this->readCache('sort');
		$collects=$this->readCache('collects');
		$pagenum = Control::get('art_num');
		$rolestr=' AND `date`>'.(time()-7*24*3600).' ';
		$rolestr2='';
		$order=' `goodnum` DESC,';
		$arts=art_Model::getNewLog($pagenum,'0',$rolestr,$order);
		$arts2=art_Model::getNewLog($pagenum,'0',$rolestr2,$order);
        $goods_cache = array();
		foreach($arts as $val){
			$val['sortname']=$sorts[$val['s_id']]['sortname'];
			$val['collects']=$collects[$val['id']];
			$val['arturl']=Url::log($val['id']);
			$val['sorturl']=Url::sort($val['s_id']);
			$val['authorname']=user_Model::getUserName($val['author']);
			$val['authorurl']=Url::author($val['author']);
			$excerpt=$val['excerpt']==''?strip_tags(htmlspecialchars_decode($val['content'])):strip_tags($val['excerpt']);
			$val['excerpt']=mb_substr(trim($excerpt),0,180);
			$val['src']=$val['pic']!=''?str_replace('../',IDEA_URL,$val['pic']):getImg($val['id']);
            $goods_cache['week'][$val['id']]=$val;
        }
		foreach($arts2 as $val){
			$val['sortname']=$sorts[$val['s_id']]['sortname'];
			$val['collects']=$collects[$val['id']];
			$val['arturl']=Url::log($val['id']);
			$val['sorturl']=Url::sort($val['s_id']);
			$val['authorname']=user_Model::getUserName($val['author']);
			$val['authorurl']=Url::author($val['author']);
			$excerpt=$val['excerpt']==''?strip_tags(htmlspecialchars_decode($val['content'])):strip_tags($val['excerpt']);
			$val['excerpt']=mb_substr(trim($excerpt),0,180);
			$val['src']=$val['pic']!=''?str_replace('../',IDEA_URL,$val['pic']):getImg($val['id']);
            $goods_cache['all'][$val['id']]=$val;
        }
        $cacheData = serialize($goods_cache);
        $this->cacheWrite($cacheData, 'goods');
    }
	
	private function ch_eyes(){//人气笔记缓存
		$sorts=$this->readCache('sort');
		$collects=$this->readCache('collects');
		$pagenum = Control::get('art_num');
		$rolestr=' AND `date`>'.(time()-7*24*3600).' ';
		$rolestr2='';
		$order=' `eyes` DESC,';
		$arts=art_Model::getNewLog($pagenum,'0',$rolestr,$order);
		$arts2=art_Model::getNewLog($pagenum,'0',$rolestr2,$order);
        $eyes_cache = array();
		foreach($arts as $val){
			$val['sortname']=$sorts[$val['s_id']]['sortname'];
			$val['collects']=$collects[$val['id']];
			$val['arturl']=Url::log($val['id']);
			$val['sorturl']=Url::sort($val['s_id']);
			$val['authorname']=user_Model::getUserName($val['author']);
			$val['authorurl']=Url::author($val['author']);
			$excerpt=$val['excerpt']==''?strip_tags(htmlspecialchars_decode($val['content'])):strip_tags($val['excerpt']);
			$val['excerpt']=mb_substr(trim($excerpt),0,180);
			$val['src']=$val['pic']!=''?str_replace('../',IDEA_URL,$val['pic']):getImg($val['id']);
            $eyes_cache['week'][$val['id']]=$val;
        }
		foreach($arts2 as $val){
			$val['sortname']=$sorts[$val['s_id']]['sortname'];
			$val['collects']=$collects[$val['id']];
			$val['arturl']=Url::log($val['id']);
			$val['sorturl']=Url::sort($val['s_id']);
			$val['authorname']=user_Model::getUserName($val['author']);
			$val['authorurl']=Url::author($val['author']);
			$excerpt=$val['excerpt']==''?strip_tags(htmlspecialchars_decode($val['content'])):strip_tags($val['excerpt']);
			$val['excerpt']=mb_substr(trim($excerpt),0,180);
			$val['src']=$val['pic']!=''?str_replace('../',IDEA_URL,$val['pic']):getImg($val['id']);
            $eyes_cache['all'][$val['id']]=$val;
        }
        $cacheData = serialize($eyes_cache);
        $this->cacheWrite($cacheData, 'eyes');
    }
	
	private function ch_collect(){//收藏笔记缓存
		$pagenum = Control::get('art_num');
		$sorts=$this->readCache('sort');
		$collects=$this->readCache('collects');
		$collectsweek=$this->readCache('collectsweek');
		arsort($collects);
		arsort($collectsweek);
		$collects2=array_slice($collects,0,$pagenum,true);
		$collectsweek2=array_slice($collectsweek,0,$pagenum,true);
		$collects2str='';
		$collectsweek2str='';
		foreach($collects2 as $key1 => $v1){
			$collects2str.=$key1.',';
		}
		foreach($collectsweek2 as $key2 => $v2){
			$collectsweek2str.=$key2.',';
		}
		$collects2str=trim($collects2str,',');
		$collectsweek2str=trim($collectsweek2str,',');
		$rolestr=' AND `id` in ('.$collectsweek2str.') ';
		$rolestr2=' AND `id` in ('.$collects2str.') ';
		$arts=art_Model::getNewLog($pagenum,'0',$rolestr,'');
		$arts2=art_Model::getNewLog($pagenum,'0',$rolestr2,'');
		$collect_cache = array();
		foreach($arts as $val){
			$val['sortname']=$sorts[$val['s_id']]['sortname'];
			$val['collects']=$collects[$val['id']];
			$val['arturl']=Url::log($val['id']);
			$val['sorturl']=Url::sort($val['s_id']);
			$val['authorname']=user_Model::getUserName($val['author']);
			$val['authorurl']=Url::author($val['author']);
			$excerpt=$val['excerpt']==''?strip_tags(htmlspecialchars_decode($val['content'])):strip_tags($val['excerpt']);
			$val['excerpt']=mb_substr(trim($excerpt),0,180);
			$val['src']=$val['pic']!=''?str_replace('../',IDEA_URL,$val['pic']):getImg($val['id']);
            $collect_cache['week'][$val['id']]=$val;
        }
		foreach($arts2 as $val){
			$val['sortname']=$sorts[$val['s_id']]['sortname'];
			$val['collects']=$collects[$val['id']];
			$val['arturl']=Url::log($val['id']);
			$val['sorturl']=Url::sort($val['s_id']);
			$val['authorname']=user_Model::getUserName($val['author']);
			$val['authorurl']=Url::author($val['author']);
			$excerpt=$val['excerpt']==''?strip_tags(htmlspecialchars_decode($val['content'])):strip_tags($val['excerpt']);
			$val['excerpt']=mb_substr(trim($excerpt),0,180);
			$val['src']=$val['pic']!=''?str_replace('../',IDEA_URL,$val['pic']):getImg($val['id']);
            $collect_cache['all'][$val['id']]=$val;
        }
        $cacheData = serialize($collect_cache);
        $this->cacheWrite($cacheData, 'collect');
    }
	private function ch_wish(){//清单榜缓存
		$pagenum = Control::get('art_num');
        $wish_cache = array();
        $rowall = $this->db->getlist("SELECT * FROM `". DB_PRE ."wishlist` WHERE `show`='1' ORDER BY `follownum` DESC,`likenum` DESC limit 0,".$pagenum);
		$rowweek = $this->db->getlist("SELECT * FROM `". DB_PRE ."wishlist` WHERE `show`='1' AND `date`>'".(time()-7*24*3600)."' ORDER BY `follownum` DESC,`likenum` DESC limit 0,".$pagenum);
        
		$wish_cache['week']=$rowweek;
		$wish_cache['all']=$rowall;
		
        $cacheData = serialize($wish_cache);
        $this->cacheWrite($cacheData, 'wish');
    }
	
	private function ch_saytop(){//神评榜缓存
		$pagenum = Control::get('art_num');
        $saytop_cache = array();
        $rowall = $this->db->getlist("SELECT * FROM `". DB_PRE ."say` WHERE `show`='1' AND `del`='1' AND `ischeck`='1' AND `mark`='2' ORDER BY `good` DESC limit 0,".$pagenum);
		$rowweek = $this->db->getlist("SELECT * FROM `". DB_PRE ."say` WHERE `show`='1' AND `del`='1' AND `ischeck`='1' AND `mark`='2' AND `date`>'".(time()-7*24*3600)."' ORDER BY `good` DESC limit 0,".$pagenum);
        
		$saytop_cache['week']=$rowweek;
		$saytop_cache['all']=$rowall;
		
        $cacheData = serialize($saytop_cache);
        $this->cacheWrite($cacheData, 'saytop');
    }
	
    function cacheWrite($cacheData, $cacheName){//写入缓存
        $cachefile = IDEA_ROOT .'/content/cache/mc_'.$cacheName.'.php';
        $cacheData = "<?php exit;//" . $cacheData;
        @ $fp = fopen($cachefile,'wb') OR emMsg('读取缓存失败。请修改目录 (content/cache) 读写权限');
        @ $fw = fwrite($fp,$cacheData) OR emMsg('写入缓存失败，缓存目录 (content/cache) 不可写');
        fclose($fp);
    }

    function readCache($cacheName){//读取缓存
		$cachefile = IDEA_ROOT .'/content/cache/mc_'.$cacheName.'.php';
		// 如果缓存文件不存在则自动生成缓存文件
		if(!is_file($cachefile) || filesize($cachefile) <= 0){
			$this->updateCache($cacheName);
		}
		if((time()-7*24*3600)>filemtime($cachefile)){
			$this->updateCache($cacheName);
		}
		if($fp = fopen($cachefile,'r')){
			$data = fread($fp, filesize($cachefile));
			fclose($fp);
			clearstatcache();
			$cacheDate = unserialize(str_replace("<?php exit;//", '', $data));
			return $cacheDate;
		}
    }

}

?>