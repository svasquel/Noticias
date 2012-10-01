
<!DOCTYPE html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link rel='stylesheet' type='text/css' href='../../base.css'/>
<title>Noticias - <? include 'title.html' ;?> </title>
</head>
<body>

<div class='box'>
	<h2><? include 'title.html' ;?></h2>
	<hr>

	<div>
		<span class='author'><? include 'author.html' ;?></span>
		<span class='date'><? include 'date.html' ;?></span>
	</div>

	<div <? include 'image_class.html' ;?>>
		<span class='img_span' style='background:url(../../pics/8650902090.jpg) no-repeat 0 top; background-size:cover'></span>
	</div>

	<p><? include 'content.html' ;?></p>

	<ul>
	<? 
	$file= glob('../../docs/8650902090_*');
	for ($i = 0; $i < count($file); $i++) {
		if(end(explode('.', $file[$i]))!=='txt'){
			$exp = explode('.',$file[$i]);
			$title_name = '../..'.$exp[count($exp)-2].'.txt';
			$title_file= fopen($title_name,'r');
			$title= fread($title_file,filesize($title_name));
			echo '<li class=\'docs\'><a href="'.$file[$i].'" target="_blank">'.$title.'</a></li>';
		}
	}
	?>
	</ul>

</div>

</body>
</html>
