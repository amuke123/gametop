<?php
class Url{
	
	
	static function getActionUrl($action){//登录等系统地址
		if(Control::get('url_type')=='1'){
			return IDEA_URL .'?action='.$action;
		}else{
			return IDEA_URL .$action.".html";
		}
	}
	
    static function log($artId){//获取文章链接
        $urlMode = Control::get('url_type');
        $logUrl = '';
        $CACHE = Conn::getCache();
        if(Control::get('aliasok') == '1'){//开启文章别名
            $alias_cache = $CACHE->readCache('artalias');
            if (!empty($alias_cache[$artId])) {
                $sort_cache = $CACHE->readCache('artsort');
                $sort = '';
                //分类模式下的url
                if(3 == $urlMode && isset($sort_cache[$artId])) {
                    $sort = !empty($sort_cache[$artId]['alias'])?$sort_cache[$artId]['alias']:$sort_cache[$artId]['name'];
                    $sort .= '/';
                }
                $logUrl = IDEA_URL .$sort.urlencode($alias_cache[$artId]);
                //开启别名html后缀
                if(Control::get('htmlok') == '1') {
                    $logUrl .= '.html';
                }
                return $logUrl;
            }
        }

        switch($urlMode){
            case '1'://默认：动态
                $logUrl = IDEA_URL .'?post='.$artId;
                break;
            case '2'://目录
                $logUrl = IDEA_URL .'post-'.$artId.'.html';
                break;
            case '3'://分类
                $log_sort = $CACHE->readCache('artsort');
                if(!empty($log_sort[$artId]['alias'])){
                    $logUrl = IDEA_URL . $log_sort[$artId]['alias'].'/'.$artId;
                }elseif(!empty($log_sort[$artId]['name'])){
                    $logUrl = IDEA_URL . $log_sort[$artId]['name'].'/'.$artId;
                }else{
                    $logUrl = IDEA_URL .$artId;
                }
                $logUrl .= '.html';
                break;
        }
        return $logUrl;
    }
	
	
    static function sort($sortId, $page = null){//获取分类链接
        $CACHE = Conn::getCache();
        $sort_cache = $CACHE->readCache('sort');
        $sort_index = !empty($sort_cache[$sortId]['alias']) ? $sort_cache[$sortId]['alias'] : $sortId;
        $sortUrl = '';
        switch (Control::get('url_type')) {
            case '1':
                $sortUrl = IDEA_URL .'?sort='.$sortId;
                if($page){$sortUrl.='&page=';}
                break;
            default:
                $sortUrl = IDEA_URL .'sort/'.$sort_index;
                if($page){$sortUrl .='/page/';}
                break;
        }
        return $sortUrl;
    }
	
	static function tips($page=null){//获取关注页链接
		$tipsUrl = '';
		switch(Control::get('url_type')){
			case '1':
				$tipsUrl = IDEA_URL .'?action=tips';
				if($page){$tipsUrl .= '&page=';}
				break;
			default:
				$tipsUrl = IDEA_URL .'tips';
				if($page){$tipsUrl .= '/page/';}
				break;
		}
		return $tipsUrl;
	}
	
	static function wishlist($wishid,$page=null,$action=''){//获取清单链接
		$wishlistUrl = '';
		switch(Control::get('url_type')){
			case '1':
				$wishlistUrl = $action==''?IDEA_URL .'?wishlist='.$wishid : IDEA_URL .'?action=wishlist';
				if($page){$wishlistUrl .= '&page=';}
				break;
			default:
				$wishlistUrl = $action==''? IDEA_URL .'wishlist/'.$wishid : IDEA_URL .'wishlist';
				if($page){$wishlistUrl .= '/page/';}
				break;
		}
		return $wishlistUrl;
	}
	
	static function author($authorId,$page=null){//获取作者链接
		$cache = Conn::getCache();
		$userdiy=$cache->readCache('userdiy');
		$authorUrl = '';
		$adiy=isset($userdiy[$authorId])?$userdiy[$authorId]:$authorId;
		switch(Control::get('url_type')){
			case '1':
				$authorUrl = IDEA_URL .'?author='.$adiy;
				if($page){$authorUrl .= '&page=';}
				break;
			default:
				$authorUrl = IDEA_URL .'author/'.$adiy;
				if($page){$authorUrl .= '/page/';}
				break;
		}
		return $authorUrl;
	}
	
	static function person(){//获取个人中心链接
		$personUrl = '';
		$personUrl = IDEA_URL .'person/';
		return $personUrl;
	}
	
	static function work(){//获取创作中心链接
		$workUrl = '';
		$workUrl = IDEA_URL .'work/';
		return $workUrl;
	}
	
	static function setting(){//获取设置中心链接
		$settingUrl = '';
		$settingUrl = IDEA_URL .'setting/';
		return $settingUrl;
	}
	
    static function nav($type,$typeId,$url){//获取导航链接
		$CACHE = Conn::getCache();
        $sorts = $CACHE->readCache('sort');
        switch ($type) {
            case nav_Model::navtype_home:
				$url = IDEA_URL;
                break;
            case nav_Model::navtype_sys:
				$url = IDEA_URL .$url.".html";
                break;
            case nav_Model::navtype_admin:
                $url = IDEA_URL . $url;
                break;
            case nav_Model::navtype_sort:
                $url = Url::sort($typeId);
                break;
            case nav_Model::navtype_page:
                $url = Url::log($typeId);
                break;
			case nav_Model::navtype_sever:
				$url = IDEA_URL ."sever/".$url;
                break;
			case nav_Model::navtype_game:
				$url = IDEA_URL ."game/".$url;
                break;
			case nav_Model::navtype_custom:
            default:
                $url = (strpos($url,'http')===0?'':IDEA_URL).$url;
                break;
        }
        return $url;
    }

    static function logPage(){//获取首页文章分页链接
        $logPageUrl = '';
        switch(Control::get('url_type')){
            case '1':
                $logPageUrl = IDEA_URL .'?pages=';
                break;
            default:
                $logPageUrl = IDEA_URL .'page/';
                break;
        }
        return $logPageUrl;
    }
	
	static function tag($tag,$page=null){//获取标签链接
        $tagUrl = '';
        switch (Control::get('url_type')){
            case '1':
                $tagUrl = IDEA_URL . '?tag=' . $tag;
                if($page){$tagUrl .= '&page=';}
                break;
            default:
                $tagUrl = IDEA_URL . 'tag/' . $tag;
                if($page){$tagUrl = IDEA_URL .'tag/'. $tag .'/page/';}
                break;
        }
        return $tagUrl;
    }
	
	static function saypre($artId){//获取评论链接前缀
        $sayUrl=Url::log($artId);
		if(Control::get('url_type')==1&&strpos($sayUrl,'=')!==false){
			$sayUrl .= '&say-page=';
		}else{
			$sayUrl .= '/say-page-';
		}
        return $sayUrl;
    }
	
    static function say($artId,$pageId,$cid){//获取评论链接 //$artId 笔记id，$pageId 页码，$cid 锚点
        $sayUrl = Url::log($artId);
        if($pageId > 1){
            if(Control::get('url_type') == 1 && strpos($sayUrl,'=')!==false){
                $sayUrl .= '&say-page=';
            } else {
                $sayUrl .= '/say-page-';
            }
            $sayUrl .= $pageId;
        }
        $sayUrl .= '#'.$cid;
        return $sayUrl;
    }


}
?>
