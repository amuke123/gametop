// JavaScript Document

function commentReply(pid,c,txt){
	var response = document.getElementById('comment-post');
	document.getElementById('comment-pid').value = pid;
	var text2="@"+txt;
	document.getElementById('comment').setAttribute("placeholder",text2);
	c.parentNode.parentNode.parentNode.appendChild(response);
	document.getElementById('cancel-reply').style.display = 'block';
}

function cancelReply(){
	var commentPlace = document.getElementById('comment-place'),response = document.getElementById('comment-post');
	document.getElementById('comment-pid').value = 0;
	document.getElementById('comment').setAttribute("placeholder",'相信你的评论可以一针见血！');
	document.getElementById('cancel-reply').style.display = 'none';
	commentPlace.appendChild(response);
}

function sortbh(el=0){
	var sortnav=document.getElementById('sortnav').getElementsByTagName('a');
	var sortlist=document.getElementById('sortlist').getElementsByTagName('li');
	for(var i=0;i<sortnav.length;i++){
		if(i==el){
			sortnav[i].className="active";
			sortlist[i].style.display="block";
		}else{
			sortnav[i].className="";
			sortlist[i].style.display="none";
		}
	}
}

function changeC2(num=0){
	var navlist=document.getElementById('author_nav').getElementsByTagName('a');
	var contlist=document.getElementById('author_cont').getElementsByClassName('c_cl_li');
	for(i=0;i<navlist.length;i++){
		if(num==i){
			navlist[i].className="active";
			contlist[i].style.display="block";
		}else{
			navlist[i].className="";
			contlist[i].style.display="none";
		}
	}
}

function setShow(num='0'){
	var contlist=document.getElementById('cent_lw').getElementsByClassName('cent_li');
	for(i=0;i<contlist.length;i++){
		if(num==i){
			document.getElementById('nav_'+i).className="onlink";
			contlist[i].style.display="block";
		}else{
			document.getElementById('nav_'+i).className="";
			contlist[i].style.display="none";
		}
	}
}

function changeC4(num=0){
	var navlist=document.getElementById('author_nav').getElementsByTagName('a');
	var contlist=document.getElementById('author_cont').getElementsByClassName('c4_list');
	for(i=0;i<navlist.length;i++){
		if(num==i){
			navlist[i].className="action";
			contlist[i].style.display="block";
		}else{
			navlist[i].className="";
			contlist[i].style.display="none";
		}
	}
}

function prompt1(str){
	hint=document.getElementById('hint');
	hint.innerHTML=str;
	hint.style.display="block";
	setTimeout("prompt2(hint)",3000);
}
function prompt2(hint){
	hint.style.display="none";
}

function show(e){
	if(e.parentElement.getElementsByTagName("ul").length>0){
		var num = e.childElementCount-1;
		e.children[num].className = e.parentElement.className=='onlink'?'icon aicon-fold':'icon aicon-fold2';
	}
	e.parentElement.className = e.parentElement.className=='onlink'?'':'onlink';
}

function autoShow(post,list=''){
	var nav = document.getElementById('nav_' + post);
	nav.parentElement.className = 'onlink2';
	if(list!=''){
		var num = nav.childElementCount-1;
		nav.children[num].className = 'icon aicon-fold2';
		document.getElementById('nav_' + list).parentElement.className = 'onedit';
		nav.parentElement.className = 'onlink';
	}
}

function xs_box(e){
	var box=e.getElementsByClassName('box_hidden')[0];
	box.style.display="block";
}

function yc_box(e){
	e.style.display="none";
}

function box_line(key=0){
	var box_show = document.getElementById('box_show');
	var box_hidden = document.getElementById('box_hidden');
	var box_alink = document.getElementById('box_alink');
	if(key==0){
		box_show.style.background="none";
		box_hidden.style.display="none";
		box_alink.style.display="inline-block";
	}else{
		box_show.style.background="#e1e5e3";
		box_hidden.style.display="block";
		box_alink.style.display="none";
	}
}

function xg_pw(type="",ttrl){
	var xgpw = document.getElementById('xgpw');
	var box_text = document.getElementById('box_text');
	var box_title = document.getElementById('box_title');
	var title='';
	var txt='';
	if(type=='pw'){
		title='<strong>修改密码</strong>';
		txt+='<input type="hidden" name="tp" value="pw">';
		txt+='<li><span>ID号：</span>'+ttrl+'</li>';
		txt+='<li><span>原密码：</span><input type="password" name="pw_old" autocomplete="off" required="" placeholder="请输入原密码"></li>';
		txt+='<li><span>新密码：</span><input type="password" name="password1" autocomplete="off" required="" placeholder="请输入新密码"></li>';
		txt+='<li><span>确认密码：</span><input type="password" name="password2" autocomplete="off" required="" placeholder="请再次输入新密码"></li>';
		txt+='<li><span></span>';
		txt+=' <strong><input type="submit" class="xg" name="xgpw" value="确定"></strong>';
		txt+=' <strong><input type="button" onclick="javascript:qx_pw();" class="qx" value="取消"></strong>';
		txt+='</li>';
	}else if(type=='email'){
		title='<strong>修改/绑定邮箱</strong>';
		txt+='<input type="hidden" name="tp" value="email">';
		txt+='<li><span>密码：</span><input type="password" name="pw_old" autocomplete="off" required="" placeholder="请输入密码"></li>';
		txt+='<li><span>邮箱：</span><input type="text" name="sendid" class="form_full" id="email" required="" placeholder="邮箱"></li>';
		txt+='<li><span>验证码：</span><input type="text" name="code" class="form_half" required="" placeholder="验证码">';
		txt+='<input type="button" class="form_bt2" value="获取验证码" id="mailcode" onclick="sendMail(\''+ttrl+'\');" name="mailcode"></li>';
		txt+='<li><span></span>';
		txt+=' <strong><input type="submit" class="xg" name="xgll" value="确定"></strong>';
		txt+=' <strong><input type="button" onclick="javascript:qx_pw();" class="qx" value="取消"></strong>';
		txt+='</li>';
	}else if(type=='tel'){
		title='<strong>修改/绑定手机</strong>';
		txt+='<input type="hidden" name="tp" value="tel">';
		txt+='<li><span>密码：</span><input type="password" name="pw_old" autocomplete="off" required="" placeholder="请输入密码"></li>';
		txt+='<li><span>手机号：</span><input type="text" name="sendid" class="form_full" id="email" required="" placeholder="手机号"></li>';
		txt+='<li><span>验证码：</span><input type="text" name="code" class="form_half" required="" placeholder="验证码">';
		txt+='<input type="button" class="form_bt2" value="获取验证码" id="mailcode" onclick="sendTell(\''+ttrl+'\');" name="mailcode"></li>';
		txt+='<li><span></span>';
		txt+=' <strong><input type="submit" class="xg" name="xgll" value="确定"></strong>';
		txt+=' <strong><input type="button" onclick="javascript:qx_pw();" class="qx" value="取消"></strong>';
		txt+='</li>';
	}
	box_title.innerHTML=title;
	box_text.innerHTML=txt;
	xgpw.style.display="block";
}

function qx_pw(){
	var xgpw = document.getElementById('xgpw');
	xgpw.style.display="none";
}

function yzxgpw(){
	if(pwxg.pw_old.value==""){
		alert('请输入原密码');
		pwxg.pw_old.focus();
		return false;
	}
	if(pwxg.tp.value=="pw"){
		if(pwxg.password1.value==""){
			alert('请输入新密码');
			pwxg.password1.focus();
			return false;
		}
		if(pwxg.password2.value==""){
			alert('请输入确认密码');
			pwxg.password2.focus();
			return false;
		}
		if(pwxg.pw_old.value == pwxg.password1.value){
			alert('新密码不能和原密码相同');
			pwxg.password1.focus();
			return false;
		}
		if(pwxg.password2.value != pwxg.password1.value){
			alert('确认密码和新密码不一致');
			pwxg.password2.focus();
			return false;
		}
	}
}
