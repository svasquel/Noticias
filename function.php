<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Noticias</title>
<link rel="stylesheet" type="text/css" href="base.css"/>

</head>
<body>
		<div class="box alerts">
		<h2>Accions realitzades amb èxit</h2>
<?
//FILE NAME
if(isset($_POST['file'])){
	$file=$_POST['file'];
}
else{
	$file=date("U");
	$file= 9999999999-$file;
}

//GENERAL VARS//
$image = "pics/".$file.".jpg"; //GENERAL IMAGE NAME
$docs = "docs/"; //DOCUMENTS FOLDER
$news = "news/"; //DOCUMENTS FOLDER
$change_folder = "news-change/"; //CHANGE FOLDER



//VARIABLES ESPECÍFICAS//
if (isset($_POST['title'])){
$author = stripslashes($_POST['author']);
$title = stripslashes($_POST['title']);
$content = stripslashes($_POST['content']);

//IF IN THE FORM THERE IS AN INPUT "LINK" WE CAN USE THIS//
$link = stripslashes($_POST['link']);
	if ($link !==""){
		if(strpos($link,'youtube')!==FALSE){
		$link_content='
		<div class="box" style="width:470px; height:300px; padding:10px">
			'.$link.'
		</div>';
		}
		else{$link_content = '<p><a href="'.$link.'" target="_blank">Veure enllaç</a></p>';}
	}
	else{$link_content = "";}

//DEFINE THE HYPERLINK//
$href = $file."/index.php";

//DATE FORMAT IN CATALAN AND SPANISH//
$date_num = date("d/m/y");
$dateS = date ("Ymd");
$tieneCeroDiaMes = substr($dateS,6,1); 

if ($tieneCeroDiaMes == 0) { $diaMes = substr($dateS,7,1); } 
else { $diaMes = substr($dateS,6,2); }
$Mes_es = substr($dateS,4,2); 
$Mes_es = str_replace("01","Enero",$Mes_es); 
$Mes_es = str_replace("02","Febrero",$Mes_es); 
$Mes_es = str_replace("03","Marzo",$Mes_es); 
$Mes_es = str_replace("04","Abril",$Mes_es); 
$Mes_es = str_replace("05","Mayo",$Mes_es); 
$Mes_es = str_replace("06","Junio",$Mes_es); 
$Mes_es = str_replace("07","Julio",$Mes_es); 
$Mes_es = str_replace("08","Agosto",$Mes_es); 
$Mes_es = str_replace("09","Septiembre",$Mes_es); 
$Mes_es = str_replace("10","Octubre",$Mes_es); 
$Mes_es = str_replace("11","Noviembre",$Mes_es); 
$Mes_es = str_replace("12","Diciembre",$Mes_es);

$Mes = substr($dateS,4,2); 
$Mes = str_replace("01","Gener",$Mes); 
$Mes = str_replace("02","Febrer",$Mes); 
$Mes = str_replace("03","Març",$Mes); 
$Mes = str_replace("04","Abril",$Mes); 
$Mes = str_replace("05","Maig",$Mes); 
$Mes = str_replace("06","Juny",$Mes); 
$Mes = str_replace("07","Juliol",$Mes); 
$Mes = str_replace("08","Agost",$Mes); 
$Mes = str_replace("09","Setembre",$Mes); 
$Mes = str_replace("10","Octubre",$Mes); 
$Mes = str_replace("11","Novembre",$Mes); 
$Mes = str_replace("12","Desembre",$Mes);

$Anio = substr($dateS,0,4); 

$date =  $diaMes." de ".$Mes." de ".$Anio."";
$date_es = $diaMes." de ".$Mes_es." de ".$Anio."";
if($Mes=='Abril'||$Mes=='Agost'||$Mes=='Octubre'){
	$date = $diaMes." d'".$Mes." de ".$Anio."";	
}

//GENERATE  DIRECTORY//

if(!file_exists("$news$file")) mkdir("$news$file", 0777,true);

//GENERATE IMAGES & PDFs//
?>
<ul>
<?
if(is_uploaded_file($_FILES['image']['tmp_name'])){
	if(file_exists($image)){
		if(move_uploaded_file($_FILES['image']['tmp_name'], $image)) {echo '<li class="positive">La notícia ja tenia una imatge i aquesta s\'ha sustituït per una de nova</li>';}
		else{echo "<li class='negative'>La notícia ja tenia una imatge, aquesta continua estant ja que hi ha hagut un problema a la càrrega de la nova imatge.</li>";}
		$image_class = " ";
	}
	else{
		if(move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
			echo '<li class="positive">La imatge s\'ha pujat correctament</li>';
			$image_class = " ";
		}
		else{
			echo "<li class='negative'>Hi ha hagut un problema en la pujada de la imatge, torna-ho a intentar.</li>";
			$image_class = "style=\"display:none\" ";
		}
	}
}
else if(file_exists($image)){
	echo '<li class="positive">Encara que no s\'hagi carregat cap imatge, la notícia ja en té una.</li>';
	$image_class = " ";
}
else {
	echo '<li class="negative">No has seleccionat cap imatge</li>';
	$image_class = "style=\"display:none\" ";
}
//WE SHOW THE CURRENT IMAGE//
if(file_exists($image)){
	echo '<p>La imatge que hi ha actualment a la notícia és aquesta </p><img src="'.$image.'" class="img-form"/>';
}
?>
</ul>
<p>Informació detallada dels arxius penjats:</p>
<ul>

<?php
if (isset ($_POST["eliminar"])){
	$tot_eliminar = count($_POST["eliminar"]);
	for ($i = 0; $i < $tot_eliminar; $i++){
		$eliminar[$i]=$docs.$_POST["eliminar"][$i];
		$ext_txt=explode(".",$eliminar[$i]);
		$eliminar_txt[$i]=$ext_txt[count($ext_txt)-2].'.txt';
		if(unlink($eliminar[$i])&& unlink($eliminar_txt[$i])){
			echo "<li class='positive'>S'ha eliminat correctament l'arxiu <i>".$eliminar[$i]."</i> ";
		}
		else{echo "<li class='negative'>Hi ha hagut algun problema i no s'ha pogut eliminar correctament l'arxiu <i>".$eliminar[$i]."</i> ";}
	}
}
if (isset ($_FILES["archivos"])) {
	$tot = count($_FILES["archivos"]["name"]);
	for ($i = 0; $i < $tot; $i++){
		$pdfs="";
        $tmp_name = $_FILES["archivos"]["tmp_name"][$i];
        $name = $_FILES["archivos"]["name"][$i];
		$ext = explode(".", $_FILES["archivos"]["name"][$i]);
		$archivo_title = stripslashes($_POST['archivo_title'][$i]);
		if($archivo_title ==NULL){$archivo_title =$_FILES["archivos"]["name"][$i];}
		$destino = $docs.$file."_".$i.".".$ext[count($ext)-1];
		$destino_txt= $docs.$file."_".$i.".txt";
		$check[$i]='';
		if(file_exists($destino)){
			$rand =rand();
			$destino = $docs.$file."_".$i.$rand.".".$ext[count($ext)-1];
			$destino_txt = $docs.$file."_".$i.$rand.".txt";
		}
		if(is_uploaded_file($_FILES["archivos"]["tmp_name"][$i])){
			if(move_uploaded_file($_FILES["archivos"]["tmp_name"][$i],$destino)){
				echo "<li class='positive'>S'ha penjat correctament <i>".$archivo_title."</i> ";
				$create = $destino;
				$fp=fopen($destino_txt,"w+");
				if(fwrite($fp,$archivo_title)){echo  "i a més s'ha penjat el seu títol </li>";}
				else{echo  "però no s'ha penjat el seu títol </li>";}
				fclose($fp);
			}
			else{
				echo "<li class='negative'>Hi ha hagut un problema en la pujada de <i>".$archivo_title."</i>, torna-ho a intentar.</li>";
			}
		}
		else{
			echo "<li class='negative'>No s'ha seleccionat cap fitxer per al <i>PDF número ".$i."</i></li>"; $display[$i] = "style=\"display:none\" ";
		}
	}
} 

?>
</ul>
<p>Els documents que actualment hi ha penjants son:</p>
<ul>
<?
//WE SHOW THE CURRENT DOCUMENTS//
	$filef= glob($docs.$file.'_*');
	for ($i = 0; $i < count($filef); $i++) {
		if(end(explode('.', $filef[$i]))!=='txt'){
			$expf = explode('.',$filef[$i]);
			$title_namef = $expf[count($expf)-2].'.txt';
			$title_filef= fopen($title_namef,'r');
			$titlef= fread($title_filef,filesize($title_namef));
			echo '<li><a href="'.$filef[$i].'" target="_blank">'.$titlef.'</a></li>';
		}
	}
	if(count($filef)==0){echo "<li class='negative'>No hi ha cap arxiu penjat a la web</li>";}
     
?>
</ul>
<?
//GENERATE INDEX.HTML//
$index="
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
		<span class='img_span' style='background:url(../../".$image.") no-repeat 0 top; background-size:cover'></span>
	</div>

	<p><? include 'content.html' ;?></p>

	<ul>
	<? 
	\$file= glob('../../".$docs.$file."_*');
	for (\$i = 0; \$i < count(\$file); \$i++) {
		if(end(explode('.', \$file[\$i]))!=='txt'){
			\$exp = explode('.',\$file[\$i]);
			\$title_name = '../..'.\$exp[count(\$exp)-2].'.txt';
			\$title_file= fopen(\$title_name,'r');
			\$title= fread(\$title_file,filesize(\$title_name));
			\$title = utf8_encode(\$title);
			echo '<li class=\'docs\'><a href=\"'.\$file[\$i].'\" target=\"_blank\">'.\$title.'</a></li>';
		}
	}
	?>
	</ul>

</div>

</body>
</html>
";
$change='
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
	<input style="display:none" name="file" id="file" value="'.$file.'">
        <label>El teu nom</label> <input name="author" id="author" value="<? include (\'../'.$news.$file.'/author.html\')?>">
        <fieldset>
        	<label>Posa un títol</label><input name="title" id="title" value="<? include (\'../'.$news.$file.'/title.html\')?>">
        	<label>Escriu el cos</label><textarea name="content" id="content"><? include (\'../'.$news.$file.'/content.html\')?></textarea>
        </fieldset>
        
        <label>Enllaç o vídeo</label> <textarea name="link" id="link"></textarea>
      
	  	<?
		if(file_exists(\'../'.$image.'\')){
			echo \'<p>Ja existeix una imatge per aquesta notícia, si la vols canviar, pots carregar-la a continuació, però aquesta es borrarà.<p> <img class="img-form" src="../'.$image.'" />\';
		}
		?>
        <label>Imatge</label><input name="image" id="image" type="file">
   <p>Arxius ja existents. Si actives el "checkbox" i envies el formulari, l\'arxiu s\'eliminarà</p>
   <?
   \$file= glob("../'.$docs.$file.'_*");
	for (\$i = 0; \$i < count(\$file); \$i++) {
		if(end(explode(".", \$file[\$i]))!=="txt"){
			\$exp = explode(".",\$file[\$i]);
			\$title_name = "..".\$exp[count(\$exp)-2].".txt";
			\$title_file= fopen(\$title_name,"r");
			\$title= fread(\$title_file,filesize(\$title_name));
			\$title = utf8_encode(\$title);
			echo "<li><a href=\'".\$file[\$i]."\' target=\'_blank\'>".\$title."</a><input name=\'eliminar[]\' type=\'checkbox\' value=\'".end(explode("'.$docs.'",\$file[\$i]))."\'</li>";
		}
	}
	if(count(\$file)==0){echo "<li class=\'negative\'>No hi ha cap arxiu penjat a la web</li>";}
   ?>
   
   <label>Arxius per pujar amb nom (petit comentari):</label>
   <div id="adjuntos">
   	<div class="archivo">
       <input type="file" name="archivos[]" />
       <input name="archivo_title[]" class="input_file"/>
   	</div>
   </div>
   <a href="#" onClick="addCampo()">Pujar un altre arxiu</a>

    <button class="button color blue" type="submit" name="enviar">Enviar</button>
    </form>
</body>
</html>
';
$change = stripslashes($change);
?>
<p>Més informació (aquests elements sempre han de mostrar-se en verd):</p>
		<ul>
<?

//GENERATE CHANGE FILE//
		$fp=fopen("$change_folder$file.php","w+");
		if(fwrite($fp,$change)){echo "<li class='positive'>S'ha penjat el formulari editable de la notícia <a class='button' href='news-change/".$file.".php'>Editar noticia</a></li>";}
			else{echo "<li class='negative'> NO s'ha penjat el formulari editable de la notícia</li>";}
		fclose($fp);

//GENERATE FILES CATALA//
		$fp=fopen("$news$file/title.html","w+");
		if(fwrite($fp,$title)){echo  "<li class='positive'>S'ha penjat el títol</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat el títol</li>";}
		fclose($fp);
		$fp=fopen("$news$file/author.html","w+");
		if(fwrite($fp,$author)){echo  "<li class='positive'>S'ha penjat l'autor</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat l'autor</li>";}
		fclose($fp);
		$fp=fopen("$news$file/date.html","w+");
		if(fwrite($fp,$date)){echo  "<li class='positive'>S'ha penjat la data</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat la data</li>";}
		fclose($fp);
		$fp=fopen("$news$file/date_num.html","w+");
		if(fwrite($fp,$date_num)){echo  "<li class='positive'>S'ha penjat la data numèrica</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat la data numèrica</li>";}
		fclose($fp);
		$fp=fopen("$news$file/content.html","w+");
		if(fwrite($fp,$content)){echo  "<li class='positive'>S'ha penjat el cos</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat el cos</li>";}
		fclose($fp);
		$fp=fopen("list.txt","a+");
		fwrite($fp,','.$file);	
		fclose($fp);
		$fp=fopen("$news$file/href.html","w+");
		fwrite($fp,$href);	
		fclose($fp);
		$fp=fopen("$news$file/image_class.html","w+");
		fwrite($fp,$image_class);	
		fclose($fp);
		$fp=fopen("$news$file/index.php","w+");
		if(fwrite($fp,$index)){echo  "<li class='positive'>S'ha penjat la notícia</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat la notícia</li>";}
		fclose($fp);
}
?>
        
		</ul>
        <div class="parent"><a class="button color blue" href="form.php">Anar al formulari inicial</a></div>
		</div><!--end .box-->
	
	</div><!--end #content-->
	</div><!--end #container-->
</body>
</html>
