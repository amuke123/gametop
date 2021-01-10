<?php
include_once 'global.php';

$path = IDEA_ROOT .'/content/template/';

$temarr=getList($path);
$action=isset($_GET['action'])?$_GET['action']:'';


if(isset($_POST['uploadzip'])){
	$file = $_FILES['ziptpl'];
	if(!empty($file["name"])){
		if($file['type']=='application/zip'||$file['type']=='application/x-zip-compressed'||$file['type']=='application/x-zip'){
			$filename = $file['name'];
			$path = IDEA_ROOT .'/content/template/';
			$filepath = $path.$filename;
			$res = move_uploaded_file($file['tmp_name'],$filepath);
			$zip = new ZipArchive();
			if($zip->open($filepath) === true){
				$temlist2=getDir($path);
				$wjj=$zip->statIndex(0);
				$wjjname=trim($wjj['name'],'/');
				if(in_array($wjjname,$temlist2)){
					$zip->close();
					unlink($filepath);
					echo "<script>alert('安装失败，模板命名冲突或安装的模板已存在');location.href='". ADMIN_URL ."template.php';</script>";
				}else{
					$files1=array($wjj['name'].'idea.jpg');
					$files2=array();
					$filearr=array('404','article','footer','function','goods','header','index','list','person','setting','sort','tips','work');
					foreach($filearr as $vfas){
						$files1[] = $wjj['name'].$vfas.'.php';
					}
					for($i=0;$i<$zip->numFiles;$i++){
						$files2[] = $zip->statIndex($i)['name'];
					}
					$flag = 1;
					foreach($files1 as $va){
						if(in_array($va,$files2)){
							continue;
						}else{
							$flag = 0;break;
						}
					}
					if($flag){
						$zip->extractTo($path);
						$zip->close();
						unlink($filepath);
						echo "<script>alert('模板安装成功');location.href='". ADMIN_URL ."template.php';</script>";
					}else{
						$zip->close();
						unlink($filepath);
						echo "<script>alert('安装的模板错误或不完整');location.href='". ADMIN_URL ."template.php?action=install';</script>";
					}
				}
			}else{
				echo "<script>alert('安装模板失败');location.href='". ADMIN_URL ."template.php?action=install';</script>";
			}
		}else{
			echo "<script>alert('格式错误，请上传压缩格式为zip的模板安装包');location.href='". ADMIN_URL ."template.php?action=install';</script>";
		}
	}else{
		echo "<script>alert('请先选择模板');location.href='". ADMIN_URL ."template.php?action=install';</script>";
	}

}







function getList($path){
	$temlist=getDir($path);
	$templist=array();
	foreach($temlist as $val){
		$purl = $path.$val.'/header.php';
		$nonceTplData = @implode('', @file($purl));
		preg_match("/TemplateName:(.*)/i", $nonceTplData, $name);
		preg_match("/Description:(.*)/i", $nonceTplData, $tplDes);
		preg_match("/Author:(.*)/i", $nonceTplData, $author);
		preg_match("/AuthorUrl:(.*)/i", $nonceTplData, $tplUrl);
		preg_match("/Sidebar:(.*)/i", $nonceTplData, $sidebar);
		preg_match("/Version:(.*)/i", $nonceTplData, $tplVersion);
		preg_match("/ForIdeashu:(.*)/i", $nonceTplData, $tplForEmlog);

		$pinfo['name'] = !empty($name[1]) ? trim($name[1]) : $val;
		$pinfo['author'] = !empty($author[1]) ? trim($author[1]) : 'IDEASHU用户';
		$pinfo['sidebar'] = !empty($sidebar[1]) ? intval($sidebar[1]) : 1;
		
		$pinfo['des'] = !empty($tplDes[1]) ? trim($tplDes[1]) : '';
		$pinfo['authorUrl'] = !empty($tplUrl[1]) ? trim($tplUrl[1]) : IDEA_URL;
		$pinfo['version'] = !empty($tplVersion[1]) ? trim($tplVersion[1]) : '';
		$pinfo['forIdeashu'] = !empty($tplForEmlog[1]) ? '适用于IDEASHU:'.$tplForEmlog[1] : '';
		$pinfo['file'] = $val;
		$templist[]=$pinfo;
	}
	return $templist;
}



include View::getViewA('header');
require_once(View::getViewA('template'));
include View::getViewA('footer');
View::output();

?>