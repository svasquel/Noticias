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
$file=date("U");
$file= 9999999999-$file;

//GENERAL VARS//
$image = "pics/".$file.".jpg"; //GENERAL IMAGE NAME
$docs = "docs/"; //DOCUMENTS FOLDER
$news = "news/"; //DOCUMENTS FOLDER
$news = "news-change/"; //CHANGE FOLDER



//VARIABLES ESPECÍFICAS//
if (isset($_POST['title'])){
$author = stripslashes($_POST['author']);
$title = stripslashes($_POST['title']);
$content = stripslashes($_POST['content']);

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

$href = $file."/index.php";

//DATE FORMAT//
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

mkdir("$news$file", 0777,true);

//GENERATE IMAGES & PDFs//
?>
<p>Si has adjuntat imatge per a la notícia, aquest element se't mostrarà en verd:</p>
<ul>
<?
if(is_uploaded_file($_FILES['image']['tmp_name'])){
	if(move_uploaded_file($_FILES['image']['tmp_name'], $image)) {echo '<li class="positive">La imatge s\'ha pujat correctament</li>'; $image_class = " ";}
	else{echo "<li class='negative'>Hi ha hagut un problema en la pujada de la imatge, torna-ho a intentar.</li>";}
}
else {echo '<li class="negative">No has seleccionat cap imatge</li>'; $image_class = "style=\"display:none\" ";}
?>
</ul>
<p>Informació detallada dels arxius penjats:</p>
<ul>

<?php 
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
		$check[$i]='';
		if(is_uploaded_file($_FILES["archivos"]["tmp_name"][$i])){
			if(move_uploaded_file($_FILES["archivos"]["tmp_name"][$i],$destino)){
				echo "<li class='positive'>S'ha penjat correctament <i>".$archivo_title."</i> ";
				$create = $destino;
				$fp=fopen($docs.$file."_".$i.".txt","w+");
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
<?
//GENERATE INDEX.HTML//
$index="
<!DOCTYPE html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Noticias -<? include 'title.html' ;?> </title>
</head>
<body>

<div>
	<h2><? include 'title.html' ;?></h2>
	<hr>

	<div>
		<span class='author'><? include 'author.html' ;?></span>
		<span class='date'><? include 'date.html' ;?></span>
	</div>

	<div <? include 'image_class.html' ;?>>
		<span style='background:url(../../".$image.") no-repeat 0 top; background-size:cover'></span>
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
			echo '<li><a href=\"'.\$file[\$i].'\" target=\"_blank\">'.\$title.'</a></li>';
		}
	}
	?>
	</ul>

</div>

</body>
</html>
";
$change="

";
?>
<p>Més informació (aquests elements sempre han de mostrar-se en verd):</p>
		<ul>
<?

//GENERATE CHANGE FILE//
		$fp=fopen("$change$file.php","w+");
		if(fwrite($fp,$change)){echo "<li class='positive'>S'ha penjat el formulari editable de la notícia</li>";}
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
        <a class="gestio-new" href="form.php">Enrere</a>
		</div><!--end .box-->
	
	</div><!--end #content-->
	</div><!--end #container-->
</body>
</html>
