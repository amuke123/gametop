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
