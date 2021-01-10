// JavaScript Document

function good(aid,path){
	var ajcode=document.getElementById("ajcode").value;
	url=path+'include/action/action.php';
	data="ajcode="+ajcode
		+"&aid="+aid
		+"&type="+"good"
	sendHttpPost(url,data);
}
function bad(aid,path){
	var ajcode=document.getElementById("ajcode").value;
	url=path+'include/action/action.php';
	data="ajcode="+ajcode
		+"&aid="+aid
		+"&type="+"bad"
	sendHttpPost(url,data);
}
function sc(aid,path,uid){
	var ajcode=document.getElementById("ajcode").value;
	url=path+'include/action/action.php';
	data="ajcode="+ajcode
		+"&aid="+aid
		+"&uid="+uid
		+"&type="+"sc";
	sendHttpPost(url,data);
}

function getFocus(p_id,b_id,path,num=''){//关注
	var ajcode=document.getElementById("ajcode").value;
	url=path+'include/action/action.php';
	if(p_id==""){
		alert("请先登录！");window.location.href= path+"login";
	}else{
		data="ajcode="+ajcode
			+"&p_id="+p_id
			+"&b_id="+b_id
			+"&num="+num
			+"&type="+"addfocus";
		sendHttpPost(url,data);
	}
}

function outFocus(f_id,path,num=''){//取消关注
	var ajcode=document.getElementById("ajcode").value;
	url=path+'include/action/action.php';
	data="ajcode="+ajcode
		+"&f_id="+f_id
		+"&num="+num
		+"&type="+"delfocus";
	sendHttpPost(url,data);
}


/**function ispw(){//密码验证
	if(yzpw.passwords.value==""){
		alert("密码不能为空！");
		yzpw.passwords.focus();
		return false;
	}
	var url=yzpw.url.value;
	data="session="+yzpw.code.value
		+"&username="+yzpw.username.value
		+"&password="+yzpw.passwords.value
		+"&type="+"yzpw";
	sendHttpPost(url,data);
}**/

function readmore(path,num){
	var ajcode=document.getElementById("ajcode").value;
	url=path+'include/action/action.php';
	var moremk=document.getElementById('li_more');
	moremk.title;
	data="ajcode="+ajcode
		+"&page="+moremk.title
		+"&num="+num
		+"&readmore=new";
	sendHttpPost(url,data);
}