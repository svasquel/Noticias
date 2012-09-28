
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../base.css"/>
<script type="text/javascript" src="../functions.js"></script>
<title>Pàgina de notícies</title>
</head>
<body>
    <form class="box" id="news" action="../function.php" method="post" enctype="multipart/form-data">
	<input style="display:none" name="file" id="file" value="8651124772">
        <label>El teu nom</label> <input name="author" id="author" value="<? include ('../news/8651124772/author.html')?>">
        <fieldset>
        	<label>Posa un títol</label><input name="title" id="title" value="<? include ('../news/8651124772/title.html')?>">
        	<label>Escriu el cos</label><textarea name="content" id="content"><? include ('../news/8651124772/content.html')?></textarea>
        </fieldset>
        
        <label>Enllaç o vídeo</label> <textarea name="link" id="link"></textarea>
      
	  	<?
		if(file_exists('../pics/8651124772.jpg')){
			echo '<p>Ja existeix una imatge per aquesta notícia, si la vols canviar, pots carregar-la a continuació, però aquesta es borrarà.<p> <img class="img-form" src="../pics/8651124772.jpg" />';
		}
		?>
        <label>Imatge</label><input name="image" id="image" type="file">
   <p>Arxius ja existents</p>
   <?
   $file= glob("../docs/8651124772_*");
	for ($i = 0; $i < count($file); $i++) {
		if(end(explode(".", $file[$i]))!=="txt"){
			$exp = explode(".",$file[$i]);
			$title_name = "..".$exp[count($exp)-2].".txt";
			$title_file= fopen($title_name,"r");
			$title= fread($title_file,filesize($title_name));
			$title = utf8_encode($title);
			echo "<li><a href='".$file[$i]."' target='_blank'>".$title."</a><input name='eliminar[]' type='checkbox' value='".end(explode("docs/",$file[$i]))."'</li>";
		}
	}
	if(count($file)==0){echo "<li class='negative'>No hi ha cap arxiu penjat a la web</li>";}
   ?>
   
   <label>Arxius per pujar amb nom (petit comentari):</label>
   <div id="adjuntos">
   	<div class="archivo">
       <input type="file" name="archivos[]" />
       <input name="archivo_title[]" class="input_file"/>
   	</div>
   </div>
   <a href="#" onClick="addCampo()">Pujar un altre arxiu</a>

    <button type="submit" name="enviar">Enviar</button>
    </form>
</body>
</html>
