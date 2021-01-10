function sendHttpPost(_url,_data=""){//post方法发送数据
	xmlHttp=createXmlHttp();
	if(!xmlHttp){
		alert("创建xmlhttprequest对象失败");
	}else{
		url=_url;
		xmlHttp.onreadystatechange = callback;
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");//post方法声明
		xmlHttp.send(_data);
	}
}

function sendHttpGet(_url,_data=""){//get方法发送数据
	xmlHttp=createXmlHttp();
	if(!xmlHttp){
		alert("创建xmlhttprequest对象失败");
	}else{
		url=_url;
		url=url+"?"+_data;
		xmlHttp.onreadystatechange = callback2;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
}

function sendHttpUp2(_url,_data){//上传
	xmlHttp=createXmlHttp();
	if(!xmlHttp){
		alert("创建xmlhttprequest对象失败");
	}else{
		url=_url;
		xmlHttp.onreadystatechange = callback3;
		xmlHttp.open("POST",url,true);
		xmlHttp.send(_data);
	}
}


function createXmlHttp(){
	if(window.XMLHttpRequest){
		xmlHttp2 = new XMLHttpRequest(); 
		if(xmlHttp2.overrideMimeType){
			xmlHttp2.overrideMimeType("text/xml");
		}
	}else if(window.ActiveXobject){
		var activeName =["MSXML2.XMLHTTP","Microsoft.XMLHTTP"];
		for(var i=0; i<activeName.length; i++){
			try{
				xmlHttp2 = new ActiveXobject(activeName[i]);
				break;
			}
			catch(e){}
		}     
	}else{
		xmlHttp2=false;
	}
	return xmlHttp2;
}


function callback(){
	if(xmlHttp.readyState == 4){
		if(xmlHttp.status == 200){//获取服务器返回的数据//获取纯文本数据
			var result=xmlHttp.responseText;
			console.log(result);
			var json = eval("(" + result + ")");
			switch (json.action){
				case 'readmore':
					var moremk=document.getElementById('li_more');
					moremk.insertAdjacentHTML('beforeBegin',json.text);
					moremk.title=(Number(moremk.title)+1)
					break;
				case 'good':
				case 'bad':
				case 'sc':
				case 'addfocus':
				case 'delfocus':
					ts(json.text);
					break;
				default:break;
			}
		}
	}
}
function callback3(){
	if(xmlHttp.readyState == 4){
		if(xmlHttp.status == 200){//获取服务器返回的数据//获取纯文本数据
			var result=xmlHttp.responseText;
			var json = eval("(" + result + ")");
			switch (json.action){
				case 'upaid':
					xsbox(json.txt);
					break;
				default:break;
			}
		}
	}
}

function ts(str){
	hint=document.getElementById('hint');
	hint.innerHTML=str;
	hint.style.display="block";
	setTimeout("ts2(hint)",600);
}
function ts2(hint){
	location.reload();
}

function ts3(str){
	hint=document.getElementById('hint');
	hint.innerHTML=str;
	hint.style.display="block";
	setTimeout("ts4(hint)",1000);
}
function ts4(hint){
	hint.style.display="none";
}

function gb(id){
	aid=document.getElementById('aid');
	aid.value=id;
}