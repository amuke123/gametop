<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="ban">
			<div id="banner">    
				<!-- 轮播图片 -->
				<div id="tab">
					<?php
					foreach($banners as $value){
						$pic = $value['pic']==""?IDEA_URL .'admin/views/images/img.jpg':$value['pic'];
						if($value['group']==0&&$value['show']==1){
					?>
					<a href="<?php echo $value['link'];?>" <?php echo $value['blank']==1?'target="_blank"':'';?>>
						<img class="tabImg" src="<?php echo $pic;?>" alt="<?php echo $value['name'];?>" title="<?php echo $value['name'];?>" width="100%"/>
					</a>
					<?php }
					}?>
				</div>
				<!-- 指示符 -->
				<div class="lunbo_btn">
					<?php
					$i=0;
					foreach($banners as $value){
						if($value['group']==0 && $value['show']==1){
					?>
						<span num="<?php echo $i;?>" class="tabBtn"></span>
					<?php $i++;}}?>
				</div>
				<!-- 左右切换按钮 -->
				<div class="arrow prve">
					<span class="slider_left"></span>
				</div>
				<div class="arrow next">
					<span class="slider_right"></span>
				</div>      
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div class="c1">
	<div class="content">
		<div class="c_top">
			<div class="center">
				<div class="left c_top_left">
					<div class="c_line c_line1">
						<li class="two">
							<a href="<?php echo Url::wishlist($wishtop['id']);?>"><img src="<?php echo $wishtop['pic']==''?getRandImg():str_replace('../',IDEA_URL,$wishtop['pic']);?>" /></a>
							<b><a href="<?php echo Url::getActionUrl('wishlist');?>">清单</a></b>
							<span><a href="<?php echo Url::wishlist($wishtop['id']);?>"><?php echo $wishtop['name'];?></a></span>
						</li>
						<li class="one">
							<b><a href="<?php echo Url::log($artone['id']);?>"><img src="<?php echo $artone['pic']!=''?str_replace('../',IDEA_URL,$artone['pic']):getImg($artone['id']);?>" /><p><span><?php echo $artone['title'];?></span></p></a></b>
							<b><a href="<?php echo Url::log($arttwo['id']);?>"><img src="<?php echo $arttwo['pic']!=''?str_replace('../',IDEA_URL,$arttwo['pic']):getImg($arttwo['id']);?>" /><p><span><?php echo $arttwo['title'];?></span></p></a></b>
						</li>
					</div>
					<div class="c_line c_line2">
						<?php foreach($wishlists as $listval){?>
						<li>
							<a href="<?php echo Url::wishlist($listval['id']);?>">
								<img src="<?php echo $listval['pic']==''?getRandImg():str_replace('../',IDEA_URL,$listval['pic']);?>" />
								<p><span><?php echo $listval['name'];?></span></p>
							</a>
						</li>
						<?php }?>
					</div>
				</div>
				<div class="right c_top_right">
					<div class="c_top_title">
						<p>设计师</p>
					</div>
					<div class="c_top_list">
						<?php foreach($sjslist as $sjsval){?>
						<li title="<?php echo $sjsval['nickname']==''?$sjsval['username']:$sjsval['nickname'];?>"><a href="<?php echo Url::author($sjsval['id']);?>" style="background-image:url(<?php echo $sjsval['photo']!=''?str_replace('../',IDEA_URL,$sjsval['photo']):IDEA_URL .ADMIN_TYPE ."/view/static/images/avatar.jpg";?>);"></a></li>
						<?php }?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<div class="c1">
	<div class="content">
		<div class="c_cont">
			<div class="center">
				<div class="c_cont_left left">
					<div class="c_cl_top" id="sortnav">
						<?php $i=0;foreach($sorts as $sval){?>
						<a <?php echo $i==0?'class="active"':'';?> href="javascript:sortbh(<?php echo $i;?>);"><?php echo $sval['sortname'];?></a>
						<?php $i++;}?>
					</div>
					<div class="c_cl_list" id="sortlist">
						<?php 
						foreach($artSortList as $artarr){
						?>
						<li>
							<?php
							if(!empty($artarr['art'])){
								$j=0;
								foreach($artarr['art'] as $artlist){
									if($j==0){
								?>
								<div class="left c_cl_li_left">
									<a href="<?php echo $artlist['arturl'];?>">
										<img src="<?php echo $artlist['src'];?>" >
										<span><?php echo $artlist['title'];?></span>
									</a>
								<?php }else if($j==1){?>
									<a href="<?php echo $artlist['arturl'];?>">
										<img src="<?php echo $artlist['src'];?>" >
										<span><?php echo $artlist['title'];?></span>
									</a>
								</div>
								<div class="right c_cl_li_right">
								<?php }else{?>
									<p><i><?php echo $j-1;?></i><a href="<?php echo $artlist['arturl'];?>"><?php echo $artlist['title'];?></a></p>
								<?php }?>
								<?php
								$j++;}?>
								</div>
							<?php }?>
						</li>
						<?php }?>
					</div>
				</div>
				<div class="c_cont_right right">
					<div class="c_cr_top">
						<p><b>神坛新秀</b></p>
					</div>
					<div class="c_cr_cont">
						<?php foreach($says as $sayval){?>
							<li><i></i><a href="<?php echo Url::log($sayval['a_id']);?>#comments"><?php echo $sayval['content'];?></a></li>
						<?php }?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<div class="c1">
	<div class="content">
		<div class="c_cont">
			<div class="center">
				<div class="c_ad"><p class="left"></p><p class="right"></p><div class="clear"></div></div>
				<div class="c_cont_left left">
					<div class="c_cl_top">
						<p>新鲜速递</p>
					</div>
					<?php $code=Checking::getAjCode(12);?>
					<input type="hidden" name='ajcode' id='ajcode' value="<?php echo $code;?>" />
					<div class="c_cl_li">
						<?php foreach($newArts as $value){?>
						<li>
							<h2><a href="<?php echo $value['arturl'];?>"><?php echo $value['title'];?></a></h2>
							<div class="c_li_cont">
								<div class="c_li_img">
									<p><a href="<?php echo $value['arturl'];?>"><img src="<?php echo $value['src'];?>" ></a></p>
								</div>
								<div class="c_li_des">
									<p><?php echo $value['excerpt'];?>...<a href="<?php echo $value['arturl'];?>">阅读全文</a></p>
								</div>
								<div class="clear"></div>
							</div>
							<div class="c_li_info">
								<div class="left"><a href="<?php echo $value['authorurl'];?>">by <?php echo $value['authorname'];?></a></div>
								<div class="right">
									<a href="<?php echo $value['sorturl'];?>"><?php echo $value['sortname'];?></a>
									<a href="<?php echo $value['arturl'];?>#comments"><?php echo $value['saynum'];?> 评论</a>
									<a href="<?php echo $value['arturl'];?>"><?php echo $value['collects'];?> 收藏</a>
									<a href="<?php echo $value['arturl'];?>"><?php echo $value['goodnum'];?> 攒</a>
									<a href="<?php echo $value['arturl'];?>"><?php echo $value['eyes'];?> 浏览</a>
								</div>
								<div class="clear"></div>
							</div>
						</li>
						<?php }?>
						<li id="li_more" title="0"><p><a href="javascript:readmore('<?php echo IDEA_URL;?>',5);">阅读更多</a></p></li>
					</div>
				</div>
				<div class="c_cont_hot right">
					<div class="c_cr_top">
						<p><b>一周热点</b></p>
					</div>
					<div class="c_cr_hot">
						<p><b><img src="<?php echo TEMPLATE_URL;?>images/2.jpg" /></b></p>
						<?php if(!empty($hotArts)){$ii=1;foreach($hotArts as $hotval){?>
						<li><i <?php echo $ii<4?'class="hot"':'';?>><?php echo $ii++;?></i><a href="<?php echo $hotval['arturl'];?>"><?php echo $hotval['title'];?></a></li>
						<?php }}?>
					</div>
					<div class="c_cr_ad">
						<p><b><img src="<?php echo TEMPLATE_URL;?>images/2.jpg" /></b></p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<?php
include View::getView('footer');
?>
<script>
	
//轮播图
var curIndex=0;//初始化
var key=0;//控制切换变量
var keypower=400;//时间控制，keypower * 10 后单位是 毫秒
var alpha=0;
var img_number = document.getElementsByClassName('tabImg').length;
var _timer = setInterval(runFn,10);//4秒，10为更新频率，与判断语句中的400共同控制更新时间4秒
function runFn(){ //运行定时器
	if(key > keypower ){//keypower=400,keypower*10=4000 毫秒 = 4 秒，与上面的更新频率结合控制时间
		curIndex = ++curIndex == img_number ? 0 : curIndex;//算法 4为banner图片数量
	}
	slideTo(curIndex);
 }
 
 //圆点点击切换轮播图
 window.onload = function  () {    //为按钮初始化onclick事件
	var tbs = document.getElementsByClassName("tabBtn");
	for(var i=0;i<tbs.length;i++){
		tbs[i].onclick = function  () {
			clearInterval(_timer);//细节处理，关闭定时，防止点切图和定时器函数冲突
			key=0;
			slideTo(this.attributes['num'].value);
			curIndex = this.attributes['num'].value
			_timer = setInterval(runFn,10);//点击事件处理完成，继续开启定时轮播
		}
	}
}

var prve = document.getElementsByClassName("prve");
prve[0].onclick = function () {//上一张
	clearInterval(_timer);//细节处理，关闭定时，防止点切图和定时器函数冲突
	curIndex--;
	key=0;
	if(curIndex == -1){
		curIndex = img_number-1;
	}
	slideTo(curIndex);
	_timer = setInterval(runFn,10);//点击事件处理完成，继续开启定时轮播
}

var next = document.getElementsByClassName("next");
next[0].onclick = function () {//下一张
	clearInterval(_timer);//细节处理，关闭定时，防止点切图和定时器函数冲突
	curIndex++;
	key=0;
	if(curIndex == img_number){
		curIndex =0;
	}
	slideTo(curIndex);
	_timer = setInterval(runFn,10);//点击事件处理完成，继续开启定时轮播
}

//切换banner图片 和 按钮样式
function slideTo(index){
	var index = parseInt(index);//转int类型
	var images = document.getElementsByClassName('tabImg');
	if(key>( keypower -50)){hidepic(images,curIndex);}
	for(var i=0;i<images.length;i++){//遍历每个图片
		if( i == index ){
			images[i].style.display = 'inline';//显示            
		}else{
			images[i].style.display = 'none';//隐藏
		}
	}
	var tabBtn = document.getElementsByClassName('tabBtn');
	for(var j=0;j<tabBtn.length;j++){//遍历每个按钮
		if( j == index ){
			tabBtn[j].classList.add("hover");    //添加轮播按钮hover样式
			curIndex=j;
		}else{
			tabBtn[j].classList.remove("hover");//去除轮播按钮hover样式
		}
	}
	if(key<50){showpic(images,index);}
	if(key> keypower ){key=0;}else{key++;}//400*10=4000 毫秒 = 4 秒，与上面的更新频率结合控制时间
}
function showpic(imgarr,index2){//下一张图片透明度逐渐显示
	imgarr[index2].style.opacity= alpha / 100;
	imgarr[index2].style.filter = 'alpha(opacity='+alpha+')';
	if(alpha < 100){alpha = alpha + 2;}
	//console.log(alpha);
}
function hidepic(imgarr,index2){//上一张图片透明度逐渐隐藏
	imgarr[index2].style.opacity= alpha / 100;
	imgarr[index2].style.filter = 'alpha(opacity='+alpha+')';
	if(alpha > 0){alpha = alpha - 2;}
	//console.log(alpha);
}
	
</script>