<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="base.css"/>
<script type="text/javascript" src="functions.js"></script>
<title>Pàgina de notícies</title>
</head>
<body>
<div class="box">
<h2>Llistat de notícies</h2>
<ul>
<?
$news_folder= 'news/';
$news_change_folder= 'news-change/';

$news=glob($news_folder.'*');
	for ($i = 0; $i < count($news); $i++) {
	$title_file= fopen($news[$i].'/title.html','r');
	$title= fread($title_file,filesize($news[$i].'/title.html'));
	$file=end(explode($news_folder,$news[$i]));
	echo '<li><a href="'.$news[$i].'">'.$title.'</a><a class="button edit" href="'.$news_change_folder.$file.'.php">Editar</a></li>';
	}
?>

<div class="parent"><a class="button color blue" href="form.php">Crear una nova notícia</a></div>
</ul>
</div>
</body>
</html>