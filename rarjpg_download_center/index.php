<?
	ini_set('error_reporting', E_NONE);
	
	//Путь к папке со скриптом относительно корня сайта
	$workdir = "/~sasha";
	
	//Меняет качество выходной картинки в галерее
	$outijg = 100; 
	
	//Сайты, посетителям которых можно личерить
	$sites = array("breathofdeath.net",
				                       );
									   
	//Файлы-исключения (без расширения) которые можно скачивать без реферера
	$excludes = array("",
			                           );
	
	//Количество картинок на страницу
	$perpage = 15;
	
	//Метод сортировки (0 - по дате изменения; 1 - по имени файла)
	$sortmeth = 0;
	
	//Сортировка  (0 - по возрастанию; 1 - по убыванию)
	$sortway = 0;
	
	//Далее ничего менять не нужно
	
	if(strpos($_SERVER['REQUEST_URI'], "/krakens"))
			header("HTTP/1.1 404 Not Found");
	if(!strcmp($_SERVER['REQUEST_URI'], $workdir."/images") && !strpos($_SERVER['REQUEST_URI'], "/images/") && !$_GET['image']) {
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$_SERVER['HTTP_REFERER'].$workdir."/images/");
	}
	if(strpos($_SERVER['REQUEST_URI'], "/images/") && !$_GET['image'])
			header("HTTP/1.1 403 Forbidden");
	
	$referers = 0;
	$exclude = 0;
	
	for($get = 0; $get < count($sites) + 1; $get++)
		if(strpos($_SERVER['HTTP_REFERER'], $sites[$get]))
			$referers = 1;
	
	if($get = $_GET['fullview']) {
		for($dir = 0; $dir < count($excludes) + 1; $dir++)
			if(!strcmp($get, $excludes[$dir]))
				$exclude = 1;
	
		if(file_exists('./krakens/'.$get.'.jpg') && ($referers || $exclude)) {
			header("Last-Modified: ".gmdate('D, d M Y H:i:s', filemtime('./krakens/'.$get.'.jpg')).' GMT');
			header('Accept-Ranges: bytes');
			header('Content-Type: application/x-rar-compressed');
			header('Content-Disposition: attachment; filename="'.$get.'.rar"');
			header('Content-Length: '.filesize('./krakens/'.$get.'.jpg'));
			readfile('./krakens/'.$get.'.jpg');
		}
	}
	
	if($get = $_GET['image']) {
		if(file_exists('./krakens/'.$get) && !strpos($_SERVER['REQUEST_URI'], "image=") && strpos($get, '.jpg')) {
			header("Last-Modified: ".gmdate('D, d M Y H:i:s', filemtime('./krakens/'.$get)).' GMT');
			header('Accept-Ranges: bytes');
			header('Content-Type: image/jpeg');
			imagejpeg(@imagecreatefromjpeg('./krakens/'.$get), NULL, $outijg);
		}
		else if(!strpos($_SERVER['REQUEST_URI'], "image="))
			header("HTTP/1.1 404 Not Found");
	}
	
	$dir = opendir('./krakens/');
	$k = 0;
	
	while(false !== ($name = readdir($dir))) {
		if($name[0] == '.')
			continue;
		if(strpos($name, '.jpg')) {
				if(!$sortmeth) {
					$images_array[$k]['modified'] = filemtime("./krakens/".$name);
				}
				
				$images_array[$k++]['name'] = $name;
		}
	}
	closedir($dir);
	
	unset($dir);
	
	if(!$sortmeth) {
		foreach($images_array as $dir)
			$sorted_images_array[] = $dir['modified'];
	
		array_multisort($sorted_images_array, (!$sortway) ? SORT_ASC : SORT_DESC, $images_array);
	
		unset($sorted_images_array);
	}
	else if($sortmeth)
		(!$sortway) ? sort($images_array) : rsort($images_array);
	
	unset($dir);
	$dir = 0;
	$title = 0;
	
	$dir = ceil($k / $perpage);
	$k = 6;
	$got = $_GET['page'];
	
	
	if($got && ($got > 1 && $got < $dir + 1)) {
		$k = 7;
		$title = 1;
	}
	
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!--- ололо, раржпег -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="description" content="Sasha's anime gallery" />
<meta name="generator" content="Alexander's Image Gallery v 1.0" />
<meta name="robots" content="all" />
<link rel="shortcut icon" href="<? echo $workdir; ?>/favicon.ico" />
<title>Sasha's anime gallery<? if($title) echo ' - Page '.$got; ?></title>	
<style type="text/css">
#outline{position:relative;height:100%;width:800px;margin:18px auto 0;border:solid 1px #000;}
#text{left:10px;right:10px;top:250px;position:absolute;visibility:visible;margin-top:0px;}
#title{width:800px;top:100px;position:absolute;visibility:visible;}
p{color:#666;font-family:"Lucida Grande",Arial,sans-serif;font-weight:normal;margin-top:0;}
h3{color:#666;font-size:60px;font-family:"Lucida Grande",Arial,sans-serif;font-weight:bold;text-align:center;letter-spacing:-1px;width:auto;margin-top:57px;}
body{margin-top:0px;margin-bottom:19px;background-color:#777;}
.box{background-color:#000;font-weight:normal;font-size:15px;}
.b1{background-color:#fff;width:20px;height:20px;}
.b2{background-color:#000;color:#fff;width:20px;height:20px;}
.l{color:#000;}
</style>
</head>	
<body>		
<div id="outline">
<table width="800" style="height:304px;background-image:url('<? echo $workdir; ?>/gradient.jpg');"><tr><td></td></tr></table>
<table width="800" style="height:100%;text-align:center;background-color:#fff">
<tr style="line-height:0px;"><td>
<?
	function images_print($a, $b, $c, $d)
	{
		for($k = $a, $dir = 0; $k < $b; $k++) {
			$size = getimagesize("./krakens/".$c[$k]['name']);
			echo '<img src="'.$d.'/images/'.$c[$k]['name'].'" alt="" '.$size[3].' />';
			$dir++;
		
			if($dir == 3) {
				echo '<br />'."\n";
				$dir = 0;
			}
		}
		
		echo '</td></tr><tr><td align="center">';
	}
	
	if($k == 6) {		
		$temp = count($images_array);
	
		if($temp < $perpage + 1)
			images_print(0, $temp, $images_array, $workdir);
		
		if($temp > $perpage) {
			images_print(0, $perpage, $images_array, $workdir);
			
			echo "\n".'<table class="box" cellspacing="1" cellpadding="0" border="0"><tr><td class="b2" align="center">1</td>';
			
			for($temp = 1; $temp < $dir; $temp++)
				echo "\n".'<td class="b1" align="center"><a class="l" href="'.$workdir.'/?page='.($temp + 1).'">'.($temp + 1).'</a></td>';
			
			echo "</tr></table><br />\n";
		}
	}
	
	if($k == 7) {
		$offset = 0;
		
		for($temp = 0; $temp < $got - 1; $temp++)
			$offset += $perpage;
		
		if($got == $dir)
			images_print($offset, count($images_array), $images_array, $workdir);
		else
			images_print($offset, $offset + $perpage, $images_array, $workdir);
		
		echo "\n".'<table class="box" cellspacing="1" cellpadding="0" border="0"><tr><td class="b1" align="center"><a class="l" href="'.$workdir.'">1</a></td>';
		
		for($temp = 2; $temp < $got; $temp++)
			echo "\n".'<td class="b1" align="center"><a class="l" href="'.$workdir.'/?page='.$temp.'">'.$temp.'</a></td>';
		
		echo "\n".'<td class="b2" align="center">'.$got.'</td>';
		
		for($temp = $got + 1; $temp < $dir + 1; $temp++)
			echo "\n".'<td class="b1" align="center"><a class="l" href="'.$workdir.'/?page='.$temp.'">'.$temp.'</a></td>';
			
		echo "</tr></table><br />";
	}
		
	unset($images_array);
	unset($size);
?>
<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml11-blue" alt="Valid XHTML 1.1" height="31" width="88" style="border:0;"/></a> <a href="http://www.validome.org/referer"><img style="border:none" src="http://www.validome.org/images/set2/valid_xhtml_1_1.gif" alt="Valid XHTML 1.1" width="88" height="31" /></a> <a href="http://jigsaw.w3.org/css-validator/validator?uri=<? echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>"><img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" /></a>
<p style="margin:0px">&copy; <? 
				if(date('Y') <= 2008)
					echo '2008';
				else
					echo '2008&#8212;'.date('Y');
		  ?> Sasha Blumkin</p>
</td></tr>
</table>
<div id="title">				
<h3>Sasha's anime gallery</h3>			
</div>		
<div id="text">				
<p style="font-size:16px;">Hello. Welcome to my page. This is small collection of my favorite anime heroines and mascots. I hope you'll enjoy!</p>
</div>			
</div>		
</body>
</html>