// JavaScript Document


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

function showurl(key){
	var ycxz = document.getElementById('ycxz');
	var geturl = document.getElementById('geturl');
	if(key==1){ycxz.style.display="inline-block";geturl.style.display="none";}
	if(key==2){ycxz.style.display="none";geturl.style.display="inline-block";}
}
function showTags(box){
	var m_tags = document.getElementById(box);
	m_tags.style.display = m_tags.style.display!="block"?'block':'none';
}
function addTags(el){
	var tags = document.getElementById('tags');
	tags.value = tags.value!=""? tags.value+','+el : el;
}

function show_add(box){
	var add = document.getElementById(box);
	add.style.display = add.style.display != 'block' ? 'block' : 'none' ;
}

function jumpMenu(targ,selObj,restore){ //v3.0
	eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	if (restore) selObj.selectedIndex=0;
}



function checked(e){
	e.className = e.className!='ok'?'ok':'';
	e.getElementsByTagName('input')[0].checked = e.className!='ok'?false:true;
}

function all_checked(boxid){
	var box = document.getElementById(boxid);
	var plist=box.getElementsByTagName('p');
	for(i=0,len=plist.length;i<len;i++){
		checked(plist[i]);
	}
}

function tags_ck(boxid){
	var box = document.getElementById(boxid);
	var plist=box.getElementsByTagName('p');
	for(i=0,len=plist.length;i<len;i++){
		plist[i].getElementsByTagName('input')[0].checked = plist[i].className!='ok'?false:true;
	}
}

function fb_art(formid){
	var fb=document.getElementById('fb');
	fb.value='';
	formid.submit();
}

function sub(formid,boxid){
	if(confirm('确定删除?')){
		tags_ck(boxid);
		formid.submit();
	}
}

function setImages(path,pathsite){
	var m_pic = document.getElementById('m_pic');
	var pic = document.getElementById('pic');
	m_pic.innerHTML='<img src="'+path+'" /><a href="'+path+'" title="点击查看原图" target="_blank">查看原图</a><a href="javascript:autoSave(\''+pathsite+'\',\'1\');" title="点击更改图片">更改图片</a>';
	pic.value=path;
	ycbox();
}

function ycbox(){
	var imgbox=document.getElementById('imagebox');
	imgbox.style.display='none';
}

function allSelect(el){
	var artcks = document.getElementsByName("artck[]");
	var allsele=document.getElementById(el);
	if(allsele.innerText=='全选'){
		for(i=0;i<artcks.length;i++){
			artcks[i]['checked']=true;
		}
		allsele.innerText='取消选择';
	}else{
		for(i=0;i<artcks.length;i++){
			artcks[i]['checked']=false;
		}
		allsele.innerText='全选';
	}
	
}

function dellist(url){
	if(confirm('确定删除?')){
		location.href=url;
	}
}

function displayTime() {
	//获取div元素
	var timeDiv=document.getElementById("time");
	//获取系统当前的年、月、日、小时、分钟、毫秒
	var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth() + 1;
	var day = date.getDate();
	var hour = date.getHours();
	var minutes = date.getMinutes();
	var second = date.getSeconds();
	var timestr = year + "年" + month + "月" + day + "日  " + check(hour)
			+ ":" + check(minutes) + ":" + check(second);
	//将系统时间设置到div元素中
	timeDiv.innerHTML = timestr;
}
function check(val){
	return val < 10 ? "0"+val : val ;
}
//每隔1秒调用一次displayTime函数
function start(){
	window.setInterval("displayTime()",100)//单位是毫秒
}

function navbh(el){
	var navlist = document.getElementById('addk').getElementsByTagName('li');
	for(i=0;i<4;i++){
		if(el==(i+1)){
			navlist[i].className='active2';
			document.getElementById('nav' + (i+1)).style.display = 'block';
		}else{
			navlist[i].className='';
			document.getElementById('nav' + (i+1)).style.display = 'none';
		}
	}
}

function anavshow(el){
	var addnav = document.getElementById('addnav');
	if(el=='0'){
		addnav.style.display="none";
	}else{
		addnav.style.display="block";
	}
}


function yzSayAdd(){
	if(sayadd.description.value==""){
		prompt1('回复不能为空');
		sayadd.description.focus();
		return false;
	}
}

function yzNavAdd(){
	if(navadddiy.name.value==""){
		prompt1('导航名称不能为空');
		navadddiy.name.focus();
		return false;
	}
	if(navadddiy.url.value==""){
		prompt1('链接不能为空');
		navadddiy.url.focus();
		return false;
	}
}
function yzNavAdd2(){
	var sck = document.getElementsByName("sck[]");
	var arr1=new Array();
	for(i=0;i<sck.length;i++){
		if(sck[i]['checked']==true){
			arr1.push(sck[i]['value']);
		}
	}
	if(arr1.length<1){
		prompt1('请选择添加到导航的分类');
		return false;
	}
}
function yzNavAdd3(){
	var bck = document.getElementsByName("bck[]");
	var arr1=new Array();
	for(i=0;i<bck.length;i++){
		if(bck[i]['checked']==true){
			arr1.push(bck[i]['value']);
		}
	}
	if(arr1.length<1){
		prompt1('请选择添加到导航的书册分类');
		return false;
	}
}
function yzNavAdd4(){
	var pck = document.getElementsByName("pck[]");
	var arr1=new Array();
	for(i=0;i<pck.length;i++){
		if(pck[i]['checked']==true){
			arr1.push(pck[i]['value']);
		}
	}
	if(arr1.length<1){
		prompt1('请选择添加到导航的单页');
		return false;
	}
}


function yzSortAdd(){
	if(sortadd.name.value==""){
		prompt1('分类名称不能为空');
		sortadd.name.focus();
		return false;
	}
	if(sortadd.alias.value==""){
		prompt1('别名不能为空');
		sortadd.alias.focus();
		return false;
	}
}

function yzBannAdd2(){
	if(bannadd.pic2.value==""){
		if(bannadd.pic.value==""){
			prompt1('请选择图片');
			bannadd.pic.focus();
			return false;
		}
	}
}
function yzBannAdd(){
	if(bannadd.pic.value==""){
		prompt1('请选择图片');
		bannadd.pic.focus();
		return false;
	}
}

function yzLinkAdd(){
	if(linkadd.sitename.value==""){
		prompt1('名称不能为空');
		linkadd.sitename.focus();
		return false;
	}
	if(linkadd.siteurl.value==""){
		prompt1('链接不能为空');
		linkadd.siteurl.focus();
		return false;
	}
}

function yzUserAdd(){
	if(useradd.username.value==""){
		prompt1('请输入登录名');
		useradd.username.focus();
		return false;
	}
	if(useradd.password1.value!=""){
		if(useradd.password1.value!=useradd.password2.value){
			prompt1('确认密码与密码不一致');
			useradd.password2.focus();
			return false;
		}
	}
}

function changeSet(num){//设置选项卡切换
	var idn="cont"+num;
	var evul=document.getElementById('navlist');
	var evli=evul.getElementsByTagName("li");
	evli[0].className="";
	evli[1].className="";
	evli[2].className="";
	//evli[3].className="";
	evli[num-1].className="active";
	document.getElementById('cont1').style.display="none";
	document.getElementById('cont2').style.display="none";
	document.getElementById('cont3').style.display="none";
	//document.getElementById('cont4').style.display="none";
	document.getElementById(idn).style.display="block";
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